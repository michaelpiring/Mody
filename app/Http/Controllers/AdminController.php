<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Admin',
                'data'    => $data
            ], 201);
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan data Admin',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data['password_admin'] = bcrypt($data['password_admin']);
            $data['status_admin'] = 'aktif';
            $create_admin = Admin::create($data);
            if($create_admin){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Registrasi Admin',
                    'data'    => $data 
                ], 201);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Admin',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        if($admin){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Admin',
                'data'    => $admin
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Admin',
            ], 409);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if($admin){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_admin'],$admin['password_admin'])){
                    $admin->update([
                        'nama_admin' => $data['nama_admin'],
                        'nik_admin' => $data['nik_admin'],
                        'alamat_admin' => $data['alamat_admin'],
                        'tgl_lahir_admin' => $data['tgl_lahir_admin'],
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah Data Admin'
                    ],201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Salah Verifikasi Password, cb ulang password lamamu'
                    ],403);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak Valid!', 
                ],409);
            }
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if($admin['status_admin']!='nonaktif'){
            $admin->update([
                'status_admin' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Admin Menjadi Non Aktif',
                'data'    => $admin
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Me-Nonaktifkan Admin',
        ], 409);
    }

    public function aktivasiAdmin(Admin $admin)
    {
        if($admin['status_admin']!='aktif'){
            $admin->update([
                'status_admin' => 'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Aktivasi Admin',
                'data'    => $admin
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Aktivasi Admin!',
        ], 409);
    }
}
