<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelumDiverifikasiController extends Controller
{
   public function index(){
    return view('back.belum_diverifikasi.index');
   }
}
