<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Validator;



class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasi = Donasi::get();

        $data = [
            'donasi' => $donasi->toArray(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'nominal' => 'required',
            'tanggal_lulus' => 'required',
            'pesan' => 'required',
            'bukti_bayar' => 'required',
            'donatur' => 'required',

        ], [
            'nama.required' => 'Data wajib diisi',
            'email.required' => 'Data wajib diisi',
            'nominal.required' => 'Data wajib diisi',
            'tanggal_lulus.required' => 'Data wajib diisi',
            'pesan.required' => 'Data wajib diisi',
            'pesan.required' => 'Data wajib diisi',
            'pesan.required' => 'Data wajib diisi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 400);
        } else {
            $gambarBukti = $request->file('bukti_lulus');
            $pathBukti = 'bukti-lulus/';
            $gambar_fileBukti = $gambarBukti->getClientOriginalName();
            $gambarBukti->move($pathBukti,$gambar_fileBukti);

            $data = [
                'anak_id' => $request->anak_id,
                'nama_jenjang' => $request->nama_jenjang,
                'nama_sekolah' => $request->nama_sekolah,
                'tanggal_lulus' => $request->tanggal_lulus,
                'bukti_lulus' => $gambar_fileBukti,
            ];

            Donasi::create($data);

            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Donasi::find($id);
        if (!$data) {
            return response()->json(['errors' => ['Data tidak ditemukan']]);
        }
        else {
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'anak_id' => 'required',
            'nama_jenjang' => 'required',
            'nama_sekolah' => 'required',
            'tanggal_lulus' => 'required',

        ], [
            'anak_id.required' => 'Data wajib diisi',
            'nama_jenjang.required' => 'Data wajib diisi',
            'nama_sekolah.required' => 'Data wajib diisi',
            'tanggal_lulus.required' => 'Data wajib diisi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 400);
        }

        $data = Donasi::find($id);

        if (!$data) {
            return response()->json(['errors' => ['Data tidak ditemukan']]);
        }

        $data->anak_id = $request->anak_id;
        $data->nama_jenjang = $request->nama_jenjang;
        $data->nama_sekolah = $request->nama_sekolah;
        $data->tanggal_lulus = $request->tanggal_lulus;

        if ($request->hasFile('bukti_lulus')) {
            $gambarBukti = $request->file('bukti_lulus');
            $pathBukti = 'bukti-lulus/';
            $gambar_fileBukti = $gambarBukti->getClientOriginalName();
            $gambarBukti->move($pathBukti,$gambar_fileBukti);

            $data->bukti_lulus = $gambar_fileBukti;
        }
        $data->save();

        return response()->json(['success' => "Berhasil memperbarui data"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Donasi::find($id)->delete();
        return response()->json(['success'=>'Data berhasil Dihapus']);
    }
}
