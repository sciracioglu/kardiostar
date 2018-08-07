<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatisMiktarController extends Controller
{
    public function index()
    {
        $yillar = DB::select('SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC', [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {
            $analiz[$yil->EVRAKYIL] = DB::select('SELECT HESAPKOD,UNVAN,UNVAN2,EVRAKYIL,MALKOD,MALAD,BIRIM,OCAK_MIKTAR,SUBAT_MIKTAR,MART_MIKTAR,
                                    NISAN_MIKTAR,MAYIS_MIKTAR,HAZIRAN_MIKTAR,TEMMUZ_MIKTAR,AGUSTOS_MIKTAR,EYLUL_MIKTAR,EKIM_MIKTAR,KASIM_MIKTAR,
                                    ARALIK_MIKTAR,TOPLAM_MIKTAR 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_MIKTAR
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?', [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }

        return view('satis_analiz_miktar', compact('yillar', 'analiz'));
    }
}
