<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(){
        $petugas = User::where('role', 'petugas')
                    ->orderBy('nama_lengkap', 'asc')
                    ->get();
        return view('admin.master.petugas.petugas', compact('petugas'));
    }
    public function store(Request $request)
    {
        // VALIDASI SESUAI FIELD FORM
        $request->validate([
            'nama_lengkap'  => 'required|string|max:150',
            'nik'           => 'required',
            'jenis_kelamin' => 'required',
            'email'         => 'required|email|unique:users,email',
            'no_telp'       => 'required',
            'status'        => 'required',
            'alamat'        => 'required',
        ]);

        // SIMPAN USER
        User::create([
            'nama_lengkap'  => $request->nama_lengkap, // mapping
            'nik'           => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email'         => $request->email,
            'no_telp'       => $request->no_telp,
            'status'        => $request->status,
            'alamat'        => $request->alamat,
            'role'          => 'petugas',

            // PASSWORD DEFAULT
            'password'      => Hash::make('12345678'),
        ]);

        return back()->with('success', 'Petugas berhasil ditambahkan. Password default: 12345678');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_lengkap'  => 'required|string|max:150',
        'nik'           => 'required',
        'jenis_kelamin' => 'required',
        'email'         => 'required|email|unique:users,email',
        'no_telp'       => 'required',
        'status'        => 'required',
        'alamat'        => 'required',
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'nama_lengkap' => $request->nama_lengkap,
        'nik' => $request->nik,
        'jenis_kelamin' => $request->jenis_kelamin,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'status' => $request->status,
        'alamat' => $request->alamat,
    ]);

    return back()->with('success', 'Data petugas berhasil diupdate');
}

}