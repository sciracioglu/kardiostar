<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hastahaneler;
use App\SatisSekilleri;

class SiparisController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $data['hastahaneler']      =Hastahaneler::all();
        $data['satis_sekilleri']   =[]; // SatisSekilleri::all();;

        return view('siparis', $data);
    }

    public function store(Request $request)
    {
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
