<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::all(); 
        return response()->json($artikels,200);
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
            'judul'=>'required|max:100',
            'deskripsi'=>'required|max:255',
            'gambar'=>'required|max:255',
            'pengurus_panti_id'=>'exists:pengurus_pantis,id',
        ], [
            'judul.required' => 'Data judul wajib diisi',
            'deskripsi.required' => 'Data deskripsi wajib diisi',
            'gambar.required' => 'Data gambar wajib diisi',
            'pengurus_panti_id.required' => 'exist',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $request->gambar,
                'pengurus_panti_id' => $request->pengurus_panti_id,
            ];
            Artikel::create($data);

            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return response()->json($artikel,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'judul'=>'required|max:100',
            'deskripsi'=>'required|max:255',
            'gambar'=>'required|max:255',
            'pengurus_panti'=>'exists:pengurus_pantis,id',
        ]);

        $artikel->update($data);
        return response()->json($artikel,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return response()->json($artikel,200);
    }
}
