<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GecikenBakiyeController extends Controller
{
    public function index()
    {
        $geciken =  DB::select('EXEC [dbo].[SP_ARG_GECIKEN_BAK] ?', [session('musteri.hesapkod')]);
        $detay   = DB::select('EXEC [dbo].[SP_ARG_GECIKEN_BAK_DETAY] ?', [session('musteri.hesapkod')]);
        $kod     = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach ($kod as $k) {
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('geciken', compact('geciken', 'detay', 'evr_tip'));
    }
}
