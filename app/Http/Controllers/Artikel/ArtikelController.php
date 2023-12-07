<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $artikels = Artikel::with('users')->get();
        return response()->json($artikels->toArray(), 200);
=======
        $artikels = Artikel::paginate(5);
    
        // Customize the pagination response
        $paginationData = $artikels->toArray();
    
        return response()->json([
            'data' => $paginationData['data'],  // The paginated data
            'pagination' => [
                'total' => $paginationData['total'],
                'per_page' => $paginationData['per_page'],
                'current_page' => $paginationData['current_page'],
                'last_page' => $paginationData['last_page'],
                'from' => $paginationData['from'],
                'to' => $paginationData['to'],
            ],
        ], 200);
>>>>>>> 8c07bd1eb592a8983710f3ce93f8ca2bee2865e0
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
<<<<<<< HEAD
            'gambar'=>'required|max:255',
            'user_id'=>'required',
=======
            'gambar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pengurus_panti_id'=>'exists:pengurus_pantis,id',
>>>>>>> 8c07bd1eb592a8983710f3ce93f8ca2bee2865e0
        ], [
            'judul.required' => 'Data judul wajib diisi',
            'deskripsi.required' => 'Data deskripsi wajib diisi',
            'gambar.required' => 'Data gambar wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
<<<<<<< HEAD
            $gambarPath = $request->file('gambar')->store('uploads/artikel');
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarPath,
                'user_id' => $request->user_id,
=======
            // Upload image
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->storeAs('public/artikel', $gambar->hashName());
    
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambar->hashName(), // Use the file path, not hashName
                'pengurus_panti_id' => $request->pengurus_panti_id,
>>>>>>> 8c07bd1eb592a8983710f3ce93f8ca2bee2865e0
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
<<<<<<< HEAD
    {
        $data = $request->validate([
            'judul'=>'required|max:100',
            'deskripsi'=>'required|max:255',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus file lama sebelum menyimpan yang baru
            Storage::delete($artikel->gambar);

            // Simpan file yang baru
            $artikel->gambar = $request->file('gambar')->getClientOriginalName();
        }

        $artikel->update($data);
        return response()->json($artikel,201);
=======
{
    $data = $request->validate([
        'judul' => 'required|max:100',
        'deskripsi' => 'required|max:255',
        'pengurus_panti_id' => 'exists:pengurus_pantis,id',
    ]);

    // Check if a new image is provided
    if ($request->hasFile('gambar')) {
        // Upload the new image
        $gambar = $request->file('gambar');
        $gambarPath = $gambar->storeAs('public/artikel', $gambar->hashName());

        // Delete the old image
        Storage::delete($artikel->gambar);

        // Update the artikel with the new image file name
        $data['gambar'] = $gambar->hashName();
>>>>>>> 8c07bd1eb592a8983710f3ce93f8ca2bee2865e0
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
