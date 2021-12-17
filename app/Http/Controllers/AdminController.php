<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::all();


        return view('admins.index',compact('admins'),[
            'i' => 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        $validate['password'] = Hash::make($validate['password']);
        
        User::create($validate);

        return redirect()->route('admins.index')->with('berhasil tambah', 'data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        if ($admin['is_admin'] == "admin") {
            return view('admins.edit',compact('admin'));
        }else {
            return redirect()->route('admins.index')->with('cant edit','only those who are admins whose data can be edited');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $valided = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'newpassword1' => 'required',
            'newpassword2' => 'required',
            'is_admin' => 'required'
        ]);
        
        

        if (Auth::user()->nama == $valided['nama']) {
            if ($valided['newpassword1'] == $valided['newpassword2']) {
                $valided['newpassword1'] = bcrypt($valided['newpassword1']);
                $admin->update([
                    'nama' => $valided['nama'],
                    'username' => $valided['username'],
                    'password' => $valided['newpassword1'],
                    'is_admin' => $valided['is_admin'],
                    'user_id' => NULL
                ]);
        
                return redirect()->route('admins.index')->with('berhasil edit','data changed successfully');
            }
            return back()->with('cant edit','Edit failed');
        }
        return redirect()->route('admins.index')->with('not user','You can only change your own data');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admins.index')->with('berhasil hapus', 'data deleted successfully');
    }
}
