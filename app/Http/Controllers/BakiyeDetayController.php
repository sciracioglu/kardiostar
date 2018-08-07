<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BakiyeDetayController extends Controller
{
    public function index()
    {
        $geciken =  DB::select('EXEC [dbo].[SP_ARG_BAKIYE_DETAY] ?', [session('musteri.hesapkod')]);

        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach ($kod as $k) {
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('detay', compact('geciken', 'evr_tip'));
    }
}
