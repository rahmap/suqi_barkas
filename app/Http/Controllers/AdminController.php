<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin'
        ];

        return view('admin.v_admin_index', $data);
    }

    public function updateProfile()
    {
        $data = [
            'title' => 'Update Profile',
            'admin' => Auth::guard('admin')->user()
        ];

        return view('admin.profile.v_admin_profile_edit', $data);
    }

    public function updateProfilePost(Request $request)
    {

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:admins,email,'.$admin['id'],
            'password' => 'nullable|min:6|max:30|confirmed'
        ]);
        $insert = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password)
        ];
        if($admin->fill($insert)->save()){
            Session::flash('message',
                sweetAlert('Success','Berhasil memperbaruhi Profile.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal memperbaruhi Profile.', 'error'));
        }

        return redirect()->back();
    }
}
