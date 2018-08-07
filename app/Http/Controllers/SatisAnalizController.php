<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatisAnalizController extends Controller
{
    public function index()
    {
        $yillar = DB::select('SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC', [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {
            $analiz[$yil->EVRAKYIL] = DB::select('SELECT CARKRT_UNVAN ,EVRAKYIL ,HESAPKOD ,MALKOD ,STKKRT_MALAD ,Ocak_Net_Satis ,Subat_Net_Satis ,Mart_Net_Satis ,
                                    Nisan_Net_Satis ,Mayis_Net_Satis ,Haziran_Net_Satis ,Temmuz_Net_Satis ,Agustos_Net_Satis ,Eylul_Net_Satis ,
                                    Ekim_Net_Satis ,Kasim_Net_Satis ,Aralik_Net_Satis ,Toplam_Net_Satis 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?', [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }

        return view('satis_analiz', compact('yillar', 'analiz'));
    }
}
