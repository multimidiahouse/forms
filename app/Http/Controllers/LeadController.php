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
        $campaign = Campaign::find($id);
        if (auth()->user()->admin)
            $leads = Lead::where('campaign_id', $id)->get();
        else
            $leads = Lead::where('lead.campaign_id', $id)
                ->join('campaign_user', 'campaign_user.campaign_id', '=', 'lead.campaign_id')
                ->where('campaign_user.user_id', auth()->id())
                ->select('lead.*')
                ->get();
        return view('lead.show', compact('leads', 'campaign'));
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

    public function download($campaign)
    {
        try
        {
            $tmpName = tempnam(storage_path('cache'), 'infos_'.date('Y_m_d_H_i_s'));
            $file = fopen($tmpName, 'w');

            $leads = Lead::where('campaign_id', $campaign)->get();
            $keys = [];
            foreach ($leads as $lead)
            {
                $informations = json_decode($lead->information, true);
                if(count($keys) == 0)
                {
                    foreach ($informations as $key => $value)
                        $keys[] = trim($key);
                    fwrite($file, implode(';', $keys) . PHP_EOL);
                }
                $values = [];
                foreach ($informations as $key => $value)
                    $values[] = trim($value);
                fwrite($file, implode(';', $values) . PHP_EOL);
            }
            fclose($file);
    
            header('Content-Description: File Transfer');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=infos_'.date('Y_m_d_H_i_s').'.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($tmpName));
    
            ob_clean();
            flush();
            readfile($tmpName);
    
            unlink($tmpName);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function destroyall($campaign)
    {
        try
        {
            Lead::where('campaign_id', $campaign)->delete();
            return back();
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
