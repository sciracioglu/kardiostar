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
        if ($request->has('seri_no')) {
            $bilgi = DB::select('exec [dbo].[ArgWebGetSeriNo] ?', [$request('serino')]);

            return $bilgi;
        }
    }

    public function create()
    {
        $data['hastahaneler']    = Hastahaneler::all();
        $data['satis_sekilleri'] = SatisSekilleri::all();

        return view('siparis', $data);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
