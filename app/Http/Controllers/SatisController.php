<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatisController extends Controller
{
    public function index()
    {
        $grup = DB::select('SELECT * FROM VW_WEB_MUSTERI_STOK_GRUP WHERE HESAPKOD=? ORDER BY EVRAKYIL DESC, EVRAKAY DESC', [session('musteri.hesapkod')]);

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
}
