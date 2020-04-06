<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUser;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        if (auth()->user()->admin)
            $campaigns = Campaign::all();
        else
            $campaigns = Campaign::whereIn('id', CampaignUser::where('user_id', auth()->id())->pluck('campaign_id'))->get();
        return view('lead.index', compact('campaigns'));
    }

    public function show($id)
    {
        if (auth()->user()->admin)
            $leads = Lead::where('campaign_id', $id)->get();
        else
            $leads = Lead::where('lead.campaign_id', $id)
                ->join('campaign_user', 'campaign_user.campaign_id', '=', 'lead.campaign_id')
                ->where('campaign_user.user_id', auth()->id())
                ->select('lead.*')
                ->get();
        return view('lead.show', compact('leads'));
    }

    public function store($slug)
    {
        try
        {
            $campaign = Campaign::where('slug', $slug)->first();
            $lead = new Lead();
            $lead->campaign_id = $campaign->id ?? 0;
            $lead->information = json_encode($_POST);
            $lead->save();

            if($campaign)
                return $campaign->response;
            else
                return '';
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try
        {
            Lead::destroy($id);
            return back()->withInput();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
