<?php

namespace App\Http\Controllers;


use App\User;

use App\Http\Requests\UsersRequest;

use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {   
        $ava = null;
        if ($request->hasFile('ava')) {
            $ava = uniqid(). "_" .$request->ava->getClientOriginalName();
            $request->file('ava')->storeAs('public', $ava);
        }

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password'=> $request->get('password'),
            'ava'=> $ava,
            'gender'=> $request->get('gender'),
            'address'=> $request->get('address'),
            'phone'=> $request->get('phone'),
            'birthday'=> $request->get('birthday'),
        ]);
        $users->save();
        return redirect('/users')->with('notice', __('notice.success.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('ava')) {
            $ava = uniqid(). "_" .$request->ava->getClientOriginalName();
            $request->file('ava')->storeAs('public', $ava);
            $image = User::find($id)->ava;
            Storage::delete('public/'.$image);    
            $data['ava'] = $ava;
        }
        $user = User::find($id);
        $user->update($data);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->gender = $request->get('gender');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->birthday = $request->get('birthday');
        $user->save();

        return redirect('/users')->with('success', 'Users updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if ($user->trashed()) {
            if ($user->id %2 ==0)
            $user->forceDelete();
        }
        return redirect('/users')->with('success', 'Users deleted!');
    }
}
