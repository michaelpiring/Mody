<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Nasabah\CreateNasabahRequest;
use App\Http\Requests\Nasabah\UpdateNasabahRequest;
use App\Models\Nasabah;
use App\Models\Dompet;

use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Nasabah::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Nasabah',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
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
    public function store(CreateNasabahRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data['password_nasabah'] = bcrypt($data['password_nasabah']);
            $data['status_nasabah'] = 'aktif';
            $create_dompet = Dompet::create([
                                'saldo_dompet' =>  0,
                            ]);
            if($create_dompet){
                $data_dompet = Dompet::latest('created_at')->first();
                $data['id_dompet'] = $data_dompet['id_dompet'];
                $create_nasabah = Nasabah::create($data);
                if($create_nasabah){
                   return response()->json([
                   'success' => true,
                   'message' => 'Berhasil Registrasi Nasabah',
                   'data'    => $data 
                ], 201);
            }
                }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Nasabah',
            ], 404);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nasabah $nasabah)
    {
        if($nasabah){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Nasabah',
                'data'    => $nasabah
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Nasabah',
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
    public function update(UpdateNasabahRequest $request, Nasabah $nasabah)
    {
        if($nasabah){
            $data = $request->validated();
            if($data){
                
                if(Hash::check($data['password_nasabah'],$nasabah['password_nasabah'])){
                    $result = $nasabah->update([
                        'nama_nasabah'            => $data['nama_nasabah'],
                        'tgl_lahir_nasabah'         => $data['tgl_lahir_nasabah'],
                        'alamat_nasabah'          => $data['alamat_nasabah'],
                        'no_telepon_nasabah'        => $data['no_telepon_nasabah'],

                    ]);
                    if($result){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengganti Biodata Nasabah',
                        ], 201);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password tidak sesuai',
                    ], 401);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                ], 409);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        if($nasabah['status_nasabah']!='nonaktif'){
            $nasabah->update([
                'status_nasabah' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Non-aktif Nasabah',
                'data'    => $nasabah
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Me-Nonaktifkan Nasabah!',
        ], 409);
    }

    public function aktivasiNasabah(Nasabah $nasabah)
    {
        if($nasabah['status_nasabah']!='aktif'){
            $nasabah->update([
                'status_nasabah' => 'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Aktivasi Nasabah',
                'data'    => $nasabah
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Aktivasi Nasabah!',
        ], 409);
    }
}
