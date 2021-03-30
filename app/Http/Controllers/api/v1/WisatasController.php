<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use Illuminate\Support\Facades\Validator;

class WisatasController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obyek'    => 'required',
            'lokasi_obyek'  => 'required',
            'akomodasi'     => 'required',
            'keterangan'    => 'required',
        ],

        [
            'nama_obyek.required'   => 'Masukkan Nama Obyek !',
            'lokasi_obyek.required' => 'Masukkan Lokasi Obyek !',
            'akomodasi.required'    => 'Masukkan Akomodasi !',
            'keterangan.required'   => 'Masukkan Keterangan !',
        ]
        );

        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Silahkan isi bidang yang kosong',
                'data'      => $validator->errors()
            ],401);
        }else{

            $wisata = Wisata::create([
                'nama_obyek'    =>  $request->input('nama_obyek'),
                'lokasi_obyek'  =>  $request->input('lokasi_obyek'),
                'akomodasi'     =>  $request->input('akomodasi'),
                'keterangan'    =>  $request->input('keterangan')
            ]);

            if ($wisata){
                return response()->json([
                    'success'   => true,
                    'message'   => 'Wisata berhasil disimpan',
                ], 200);
            }else{
                return response()->json([
                    'success'   => false,
                    'message'   => 'Wisata gagal disimpan',
                ], 401);
            }
        }
    }

    public function index()
    {
        $wisatas = Wisata::latest()->get();
        return response([
            'success'   => true,
            'message'   => 'List Semua Wisatas',
            'data'      => $wisatas
        ], 200);
    }

    public function show($id){
        $wisata = Wisata::whereId($id)->first();

        if($wisata){
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Wisata',
                'data'      => $wisata
            ], 200);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Wisata tidak ditemukan',
                'data'      => ''
            ], 401);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_obyek'    => 'required',
            'lokasi_obyek'  => 'required',
            'akomodasi'     => 'required',
            'keterangan'    => 'required',
        ],
            [
                'nama_obyek.required'  => 'Masukka nama wisata',
                'lokasi_obyek.required' => 'Masukkan lokasi wisata',
                'akomodasi.required'    => 'Masukkan akomodasi',
                'keterangan.required'   => 'Masukkan keterangan',
            ]
            );

            if($validator->fails()){
                return response()->json([
                    'success'   => false,
                    'message'   => 'Jangan ada yang kosong',
                    'data'      => $validator->errors()   
                ], 401);
            }else{
                $wisata = Wisata::whereId($request->input('id'))->update([
                    'nama_obyek'     => $request->input('nama_obyek'),
                    'lokasi_obyek'   => $request->input('lokasi_obyek'),
                    'akomodasi'      => $request->input('akomodasi'),
                    'keterangan'     => $request->input('keterangan'),
                ]);

                if($wisata){
                    return response()->json([
                        'success'   => true,
                        'message'   => 'Wisata berhasil diupdate',
                    ], 200);
                }else{
                    return response()->json([
                        'success'   => false,
                        'message'   => 'Wisata gagal diupdate',
                    ], 401);
                }
            }
    }

    public function destroy($id){
        $wisata = Wisata::findOrFail($id);
        $wisata->delete();

        if ($wisata) {
            return response()->json([
                'success' => true,
                'message' => 'Wisata Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Wisata Gagal Dihapus!',
            ], 400);
        }

    }
}
