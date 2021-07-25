<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{

    public function index()
    {
        $data = [
          'title' => 'List Admin',
          'admins' => Admin::where('role', 'admin')->get()
        ];

        return view('superadmin.v_superadmin_admin_list', $data);
    }


    public function create()
    {
        $data = [
          'title' => 'Tambahkan Admin'
        ];

        return view('superadmin.v_superadmin_admin_add', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|max:30|confirmed'
        ]);
        $insert = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ];

        if(Admin::create($insert)){
            Session::flash('message',
                sweetAlert('Success','Berhasil menambahkan Akun Admin.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal menambahkan Akun Admin.', 'error'));
        }
        return redirect()->route('admin.create');
    }

    public function show($id)
    {
        //
    }

    public function edit(Admin $admin)
    {
        $data = [
            'title' => 'Update Admin '.$admin->nama,
            'admin' => $admin
        ];

        return view('superadmin.v_superadmin_admin_edit', $data);
    }

    public function update(Admin $admin, Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'password' => 'nullable|min:6|max:30|confirmed'
        ]);
        if(isset($request->password) AND !empty($request->password)){
            $updatePassword = Hash::make($request->password);
        } else {
            $updatePassword = $admin->password;
        }
        $update = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower(trim($request->email)),
            'password' => $updatePassword
        ];

        if($admin->fill($update)->saveOrFail()){
            Session::flash('message',
                sweetAlert('Success','Berhasil mengupdate Akun Admin.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal mengupdate Akun Admin.', 'error'));
        }
        return redirect()->route('admin.edit', ['admin' => $admin->id]);
    }


    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->back()->with('message',
        sweetAlert('Success', 'Berhasil Mengahapus Admin','success'));
    }
}
