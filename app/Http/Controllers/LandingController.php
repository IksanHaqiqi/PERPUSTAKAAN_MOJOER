<?php

namespace App\Http\Controllers;

use App\Models\Lemari;

class LandingController extends Controller
{
    /**
     * Display public landing page with all books.
    */ public function index()
    {
        $lemaris = Lemari::where('stock', '>', 0)->get(); // hanya buku dengan stok
        return view('layout.landing', compact('lemaris'));
    }
}
