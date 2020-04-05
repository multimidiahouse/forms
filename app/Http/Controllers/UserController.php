<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        try
        {
            $user = User::find($request->id);
            if($user)
            {
                $user->name = $request->name;
                $user->email = $request->email;
                if(isset($request->password)) $user->password = bcrypt($request->password);
                $user->active = isset($request->active);
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();
            }
            else
            {
                $input = $request->all();
                $input['password'] = bcrypt($request->password);
                user::create($input);
            }
            return redirect(route('user.index'));
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
}
