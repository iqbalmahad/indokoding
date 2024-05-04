<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientKategoriController extends Controller
{
    public function index()
    {
        return view('client.kategori.index');
    }

    public function show()
    {
        return view('client.kategori.show');
    }
}
