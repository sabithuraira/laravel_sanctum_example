<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function index() {
        return [
            ['nama'=>'Kucing', 'habitat'=>"Darat"],
            ['nama'=>'Ikan', 'habitat'=>"Air"],
            ['nama'=>'Sapi', 'habitat'=>"Darat"],
        ];
    }
}
