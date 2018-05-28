<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hastahaneler;
use App\SatisSekilleri;
use Illuminate\Support\Facades\DB;

class SiparisController extends Controller
{
    public function index()
    {
        if (request()->has('serino')) {
            $bilgi = DB::select('exec [dbo].[ArgWebGetSeriNo] ?, ?', [session('musteri.hesapkod'), request('serino')]);
            return $bilgi;
        }
    }

    public function create()
    {
        $data['hastahaneler']    = Hastahaneler::all();
        $data['satis_sekilleri'] = SatisSekilleri::all();
        $data['doktorlar']       =
        session()->forget('evrak_baslik');
        return view('siparis', $data);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'satis_sekli'   => 'required',
            'hastane'       => 'required',
            'hasta'         => 'required',
            'serino'        => 'required'
        ]);
        if (!session()->has('evrak_baslik')) {
            $evrak_baslik = DB::select('EXEC [dbo].[SpArgSipInsEvrBas] ?, ?, ?, ?, ?, ?, ?, ?, ? ', [
                session('musteri.hesapkod'),
                $data['satis_sekli'],
                $data['hastane'],
                request('doktor'),
                $data['hasta'],
                request('kimlikno'),
                request('protokol'),
                request('aciklama'),
                session('username')
                ]);

            session()->put('evrak_baslik', $evrak_baslik[0]->EVRAKNO);
        }

        $kalem = DB::select('[dbo].[spArgSipInsStkHar] ?, ?, ?', [
                        session('evrak_baslik'),
                        $data['serino'],
                        session('username')
                    ]);
    }
}
