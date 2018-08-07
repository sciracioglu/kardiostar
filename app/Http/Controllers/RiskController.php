<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RiskController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bakiye_bakiye = DB::select("SELECT GUNCELBAKIYE, GECIKENBAKIYEORTVADE, DOVIZGECIKENBAKIYE,DOVIZBAKIYE AS BAKIYE,
		(CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI],
		 BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $ust_bakiye = DB::select("SELECT DOVIZBAKIYE AS BAKIYE, (CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI], BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] 
								FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $tip        = DB::select("SELECT KOD,r.ACIKLAMA FROM dbo.REFKRT r WHERE r.TABLOAD='PRMRIT' AND r.ALANAD='RISKTIP' ORDER BY r.KOD");
        $bakiye_tip = [];
        foreach ($tip as $t) {
            $bakiye_tip[$t->KOD] = $t->ACIKLAMA;
        }

        $bakiye = DB::select("EXEC dbo.SPAPP_RISK @SABLONNO = 0, @SIRKETNO = '002', @HESAPKOD = ?, @GOSTERIMTIP = 0, @DOVIZTIP = 0", [
            session('musteri.hesapkod')
        ]);
        return view('risk', compact('bakiye', 'bakiye_tip', 'ust_bakiye', 'bakiye_bakiye'));
    }
}
