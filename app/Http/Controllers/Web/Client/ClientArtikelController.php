<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientArtikelController extends Controller
{
    public function index()
    {
        return view('client.artikel.index');
    }

    public function show()
    {
        return view('client.artikel.show');
    }
}
