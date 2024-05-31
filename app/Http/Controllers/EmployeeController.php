<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::where('role', '!=', 'customer')->get();
        return view ('toko.pegawai.pegawai_index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko.pegawai.pegawai_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'required|in:admin,warehouse,owner',
            'username'  => 'required|string|alpha_num|max:255',
            'email'     => 'required|string|email|max:255',
            'phone'     => 'required|string|numeric|digits_between:9,14',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'      => $request->name,
            'role'      => $request->role,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password)
        ]);

        return redirect('/employees')->with('message', 'Data Pegawai '.$request->name.' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view ('toko.pegawai.pegawai_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'required|in:admin,warehouse,owner',
            'username'  => 'required|string|alpha_num|max:255',
            'email'     => 'required|string|email|max:255',
            'phone'     => 'required|string|numeric|digits_between:9,14',
        ]);

        User::find($user->id)->update([
            'name'      => $request->name,
            'role'      => $request->role,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
        ]);
        
        if ($request->password != NULL) {
            # code...
            $request->validate([
                'password'  => 'required|string|min:8|confirmed',
            ]);
            User::find($user->id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/employees')->with('message', 'Data '.$user->name.' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/employees')->with('message', 'Kategori '.$user->nama.' Berhasil Dihapus');
    }
}
