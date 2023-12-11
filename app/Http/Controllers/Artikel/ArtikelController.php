<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::with('users')->get();

        return response()->json([
            'data' => $artikels,
        ], 200);
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
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [
            'judul.required' => 'Data judul wajib diisi',
            'deskripsi.required' => 'Data deskripsi wajib diisi',
            'gambar.required' => 'Data gambar wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            // Upload image
            $gambar = $request->file('gambar');
            $path = 'artikel/';
            $gambar_file = $gambar->getClientOriginalName();
            $gambar->move($path,$gambar_file);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambar_file,
                'user_id' => $request->user_id,
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
        $artikelWithUser = $artikel->with('users')->first();
        return response()->json($artikelWithUser,200);
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
            'judul' => 'required|max:100',
            'deskripsi' => 'required|max:255',
            'pengurus_panti_id' => 'exists:pengurus_pantis,id',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path = 'artikel/';
            $gambar_file = $request->team_name . "_" . $gambar->getClientOriginalName();
            $gambar->move($path, $gambar_file);

            // Update the gambar field in the $data array
            $data['gambar'] = $gambar_file;
        }


        $artikel->update($data);

        return response()->json($artikel, 201);
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Artikel $artikel)
    {
        // Delete the associated image file
        Storage::delete($artikel->gambar);

        // Delete the Artikel
        $artikel->delete();

        return response()->json(['message' => 'Artikel deleted successfully'], 200);
    }

}
