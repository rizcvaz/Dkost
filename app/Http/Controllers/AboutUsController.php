<?php

namespace App\Http\Controllers;

class AboutUsController extends Controller
{
    // Method untuk menampilkan halaman "Tentang Kami"
    public function index()
    {
        return view('about-us.index');
    }
}
