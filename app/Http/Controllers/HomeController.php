<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dataAnak(){
        return view('admin.anak-asuh.data-anak');
    }

    public function prestasiAnak(){
        return view('admin.anak-asuh.prestasi-anak');
    }

    public function kesehatanAnak(){
        return view('admin.anak-asuh.kesehatan-anak');
    }

    public function pendidikanAnak(){
        return view('admin.anak-asuh.pendidikan-anak');
    }

    public function artikel(){
        return view('admin.artikel.data-artikel');
    }

    public function pengurusPanti(){
        return view('admin.pengurus-panti.data-pengurus');
    }

    public function programPanti(){
        return view('admin.program-panti.data-program');
    }

    public function jenisProgram(){
        return view('admin.program-panti.jenis-program');
    }

    public function dataDonasi(){
        return view('admin.donasi.donasi');
    }
}
