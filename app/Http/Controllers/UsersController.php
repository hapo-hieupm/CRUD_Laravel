<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UsersRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Session;

use App\Enums\Gender;

use BenSampo\Enum\Rules\EnumValue;

class UsersController extends Controller
{
    public function index()
    {   
        $users = User::paginate(config('pagination.pagination'));
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UsersRequest $request)
    {   
        $allRequest  = $request->all();
        if($request->hasFile('ava')) {
            $path = Storage::putFile('ava', $request->file('ava'));
            $destinationPath = 'public/images/';
            $image = $request->file('ava');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('ava')->storeAs($destinationPath, $imageName);
            $allRequest['ava'] = $imageName;
        }
        User::create($allRequest);
        return redirect('/users')->with('notice', __('notice.success.store'));
    }

    
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));   
    }

    public function update(UsersRequest $request, $id)
    {
        $user = $request->all();
        if ($request->hasFile('ava')) {
            $file = $request->ava;
            $ava = uniqid() . "_" . $file->getClientOriginalName();
            $oldAva = User::find($id)->ava;
            Storage::delete('public/images/' . $oldAva);
            $request->file('ava')->storeAs('public/images/', $ava);
            $user['ava'] = $ava;
        }
        User::findOrFail($id)->update($user);
        return redirect('/users')->with('notice', __('notice.success.update'));
    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if ($user->trashed()) {
            if ($user->id %2 ==0)
            $user->forceDelete();
        }
        return redirect('/users')->with('notice', __('notice.success.delete'));
    }
}
