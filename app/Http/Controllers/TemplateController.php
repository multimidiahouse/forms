<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::select('id', 'title', 'created_at')->get();
        return view('template.index', compact('templates'));
    }

    public function create()
    {
        return view('template.create');
    }

    public function store(Request $request)
    {
        try
        {
            $template = Template::find($request->id);
            if($template)
            {
                $template->title = $request->title;
                $template->html = $request->html;
                $template->updated_at = date('Y-m-d H:i:s');
                $template->save();
            }
            else
            {
                $input = $request->all();
                Template::create($input);
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
        $template = Template::find($id);
        return view('template.edit', compact('template'));
    }
}
