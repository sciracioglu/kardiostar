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
        // $data['doktorlar']       =
        $evrak_no         = DB::select('EXEC [dbo].[spArgSipGetEvrakNo]');
        $data['evrak_no'] = $evrak_no[0]->EVRAKNO;
        return view('siparis', $data);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'satis_sekli'   => 'required',
            'hastane'       => 'required',
            'hasta'         => 'required',
            'serino'        => 'required',
            'evrak_no'      => 'required'
        ]);
        $this->evrakBaslikKaydet($data);
        $this->kalemKaydet($data);
    }

    private function evrakBaslikKaydet($data)
    {
        DB::insert('EXEC [dbo].[SpArgSipInsEvrBas] ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ', [
            session('musteri.hesapkod'),
            $data['satis_sekli'],
            $data['hastane'],
            (request()->has('doktor') && request('doktor') != null) ? request('doktor') : '',
            $data['hasta'],
            (request()->has('kimlikno') && request('kimlikno') != null) ? request('kimlikno') : '',
            (request()->has('protokol') && request('protokol') != null) ? request('protokol') : '',
            (request()->has('aciklama') && request('aciklama') != null) ? request('aciklama') : '',
            session('username'),
            $data['evrak_no']
        ]);
    }

    private function kalemKaydet($data)
    {
        DB::select('EXEC [dbo].[spArgSipInsStkHar] ?, ?, ?', [
            $data['evrak_no'],
            $data['serino'],
            session('username')
        ]);
    }
}
