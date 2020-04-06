<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Template;
use App\Models\CampaignUser;
use App\User;

class CampaignController extends Controller
{
	public function index()
	{
	    $users = User::where('admin', false)->where('active', true)->pluck('name', 'id');
		$campaigns = Campaign::all();
		$campaignusers = [];
		foreach($campaigns as $campaign)
        {
            foreach(CampaignUser::where('campaign_id', $campaign->id)->get() as $campaignuser)
            {
                $user = User::find($campaignuser->user_id);
                $campaignusers[$campaign->id][] = (object) ['name' => $user->name, 'email' => $user->email];
            }
        }

		return view('campaign.index', compact('campaigns', 'campaignusers', 'users'));
	}

	public function create()
	{
		$campaign = new Campaign();
		$campaign->title = 'Default';
		$campaign->slug = $this->generateSlug(32);
		$campaign->html = 'Copie e cole seu HTML';
        $campaign->response = 'Copie e cole seu HTML';

		$template = Template::orderby('created_at', 'desc')->first();
		if($template)
        {
            $campaign->html = str_replace('<form>', '<form action="'.env('APP_URL').'/save/'.$campaign->slug.'" method="post">', $template->html);
            $campaign->response = $template->response;
        }

		return view('campaign.create', compact('campaign'));
	}

    public function show($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        if($campaign)
            return $campaign->html;
        else
            return abort(404);
    }

	public function store(Request $request)
	{
		try
		{
			$campaign = Campaign::find($request->id);
			if($campaign)
            {
                $campaign->title = $request->title;
                $campaign->html = str_replace('<form>', '<form action="'.env('APP_URL').'/save/'.$campaign->slug.'" method="post">', $request->html);
                $campaign->response = $request->response;
                $campaign->updated_at = date('Y-m-d H:i:s');
                $campaign->save();
            }
			else
            {
                $input = $request->all();
                $input['html'] = str_replace('<form>', '<form action="'.env('APP_URL').'/save/'.$request->slug.'" method="post">', $request->html);
			    Campaign::create($input);
            }
			return back()->withInput();
		}
		catch(\Exception $e)
		{
			throw $e;
		}
	}

	public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view('campaign.edit', compact('campaign'));
    }

	public function destroy(Request $request)
    {
        try
        {
            $campaign = Campaign::find($request->id);
            $campaign->delete();
            return redirect(route('campaign.index'));
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function adduser(Request $request)
    {
        try
        {
            $input = $request->all();
            CampaignUser::firstOrCreate($input);
            return redirect(route('campaign.index'));
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function download($id)
    {
        $campaign = Campaign::find($id);
        $html = $campaign->html;
        $tmpName = tempnam(sys_get_temp_dir(), 'index');
        $file = fopen($tmpName, 'w');

        fwrite($file, $html);
        fclose($file);

        header('Content-Description: File Transfer');
        header('Content-Type: text/html');
        header('Content-Disposition: attachment; filename=index.html');
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
}
