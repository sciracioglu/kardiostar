<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MusteriController extends Controller
{
    public function index()
    {
        $musteri = DB::select('exec spArgWebGetCari ?', [
            session('username')
        ]);

        $liste   = [];
        foreach ($musteri as $m) {
            $liste[$m->HESAPKOD] = $m->HESAPKOD . ' - ' . $m->UNVAN . ' ' . $m->UNVAN2;
        }

        return view('anasayfa', compact('liste'));
    }

    public function store()
    {
        if (request()->has('musteri')) {
            $musteri = DB::select('SELECT * FROM dbo.CARKRT WHERE HESAPKOD = ?', [
                request('musteri')
            ]);

            if ($musteri) {
                session()->put('musteri.hesapkod', request('musteri'));
                session()->put('musteri.unvan', $musteri[0]->UNVAN . ' ' . $musteri[0]->UNVAN2);
                return view('musteri', compact('musteri'));
            }
        }
    }
     /**
     * @return \Illuminate\View\View
     */
    public function cari()
    {


        $cari = DB::select("EXEC [dbo].[spArgWebCariEkstre] ?", [session('musteri.hesapkod')]);;

        return view('cari', compact('cari', 'format'));
    }
    /**
     * @return \Illuminate\View\View
     */
    public function risk()
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

        $tip = DB::select("SELECT KOD,r.ACIKLAMA FROM dbo.REFKRT r WHERE r.TABLOAD='PRMRIT' AND r.ALANAD='RISKTIP' ORDER BY r.KOD");
        $bakiye_tip = [];
        foreach ($tip as $t) {
            $bakiye_tip[$t->KOD] = $t->ACIKLAMA;
        }

        $bakiye = DB::select("EXEC dbo.SPAPP_RISK @SABLONNO = 0, @SIRKETNO = '002', @HESAPKOD = ?, @GOSTERIMTIP = 0, @DOVIZTIP = 0", [
            session('musteri.hesapkod')
        ]);
        return view('risk', compact('bakiye', 'bakiye_tip', 'ust_bakiye', 'bakiye_bakiye'));

    }
    public function bakiye_detay(){
        $geciken =  DB::select("EXEC [dbo].[SP_ARG_BAKIYE_DETAY] ?", [session('musteri.hesapkod')]);
        
        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach($kod as $k){
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('detay', compact('geciken', 'evr_tip'));
    }


    public function geciken_bakiye(){
        $geciken =  DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK] ?", [session('musteri.hesapkod')]);
		$detay = DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK_DETAY] ?", [session('musteri.hesapkod')]);
        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach($kod as $k){
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('geciken', compact('geciken','detay', 'evr_tip'));
    }

   

    public function satis()
    {

        $grup = DB::select("SELECT * FROM VW_WEB_MUSTERI_STOK_GRUP WHERE HESAPKOD=? ORDER BY EVRAKYIL DESC, EVRAKAY DESC", [session('musteri.hesapkod')]);

        $detay = [];
        foreach ($grup as $g) {
            $detay[$g->EVRAKYIL][$g->EVRAKAY] = DB::select("SELECT EVRAKTIPI, EVRAKNO, EVRAKTARIH, MALKOD, MALAD, MIKTAR, FIYAT, FIYATDOVIZCINS, FIYATDOVIZKUR, DOVIZTUTAR,
								DOVIZISKONTO, DOVIZKDV, _DOVIZNETTUTAR, _DOVIZTOPLAM FROM dbo.VW_WEB_MUSTERI_STOK_1
                                WHERE (HESAPKOD = ?) AND EVRAKYIL = ? AND EVRAKAY = ? AND EVRAKTIPI != 'Satışdan İade Faturası' ORDER BY EVRAKTARIH DESC", [
                session('musteri.hesapkod'),
                $g->EVRAKYIL,
                $g->EVRAKAY
            ]);
        }


        return view('satis', compact('grup', 'detay'));
    }


    public function satis_analiz()
    {

        $yillar = DB::select("SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC", [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {

            $analiz[$yil->EVRAKYIL] = DB::select("SELECT CARKRT_UNVAN ,EVRAKYIL ,HESAPKOD ,MALKOD ,STKKRT_MALAD ,Ocak_Net_Satis ,Subat_Net_Satis ,Mart_Net_Satis ,
                                    Nisan_Net_Satis ,Mayis_Net_Satis ,Haziran_Net_Satis ,Temmuz_Net_Satis ,Agustos_Net_Satis ,Eylul_Net_Satis ,
                                    Ekim_Net_Satis ,Kasim_Net_Satis ,Aralik_Net_Satis ,Toplam_Net_Satis 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?", [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }


        return view('satis_analiz', compact('yillar', 'analiz'));
    }



    public function satis_analiz_miktar()
    {

        $yillar = DB::select("SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC", [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {

            $analiz[$yil->EVRAKYIL] = DB::select("SELECT HESAPKOD,UNVAN,UNVAN2,EVRAKYIL,MALKOD,MALAD,BIRIM,OCAK_MIKTAR,SUBAT_MIKTAR,MART_MIKTAR,
                                    NISAN_MIKTAR,MAYIS_MIKTAR,HAZIRAN_MIKTAR,TEMMUZ_MIKTAR,AGUSTOS_MIKTAR,EYLUL_MIKTAR,EKIM_MIKTAR,KASIM_MIKTAR,
                                    ARALIK_MIKTAR,TOPLAM_MIKTAR 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_MIKTAR
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?", [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }


        return view('satis_analiz_miktar', compact('yillar', 'analiz'));
    }


}
