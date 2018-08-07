<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CekSenetController extends Controller
{
    public function index()
    {
        $cekSenet = DB::select('EXEC [dbo].[spArgWebGetCekSenet2] ?', [session('musteri.hesapkod')]);
        foreach ($cekSenet as $cek) {
            $detay[$cek->ISLEMTIPI] = DB::select('EXEC [dbo].[spArgWebGetCekSenet_Hrk] ?, ?', [session('musteri.hesapkod'), $cek->ISLEMTIPI]);
        }

        return view('cek_senet', compact('cekSenet', 'detay'));
    }
}
