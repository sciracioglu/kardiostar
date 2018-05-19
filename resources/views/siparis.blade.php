@extends('layouts.master')

@section('baslik')
    Hede Hodo  Turizm Insaat Perakende Ithalat Ihracat Ltd. Sti.
@endsection
@section('kucuk_baslik')
    Sipariş
@endsection

@section('icerik')
    @include('ust_form')
    <nav aria-label="breadcrumb" v-if='satislar'>
        <button type="button" class="close text-danger" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Seri No : </li>
            <li class="breadcrumb-item">Mal Kodu :</li>
            <li class="breadcrumb-item">Mal Adi :</li>
            <li class="breadcrumb-item">Fiyat :</li>
            <li class="breadcrumb-item">UBB :</li>
            <li class="breadcrumb-item">Lot No :</li>
        </ol>
    </nav>
    
    <div class='row'>
        <div class='col-12'>
            <div class="form-group">
                <label for="serino">Seri No</label>
                <input type='text' class='form-control' id='serino' v-model='form.serino' />
            </div>
        </div>
        <div class='col-4 '>
            <div class="form-group">
                <label for="malkod">Mal Kodu</label>
                <input type='text' class='form-control-plaintext' id='malkod' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="malad">Mal Adı</label>
                <input type='text' class='form-control-plaintext' id='malad' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="fiyat">Fiyat</label>
                <input type='text' class='form-control-plaintext' id='fiyat' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="ubb">UBB Kodu</label>
                <input type='text' class='form-control-plaintext' id='ubb' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="skt">S.K. Tarihi</label>
                <input type='text' class='form-control-plaintext' id='skt' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="lot">Lot No</label>
                <input type='text' class='form-control-plaintext' id='lot' readonly />
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <button type="button" class="btn btn-sm btn-block btn-primary">Kaydet</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>

var vue=new Vue({
    el:'#app',
    data:{
        satislar:null,
        satis_sekilleri:{!! $satis_sekilleri !!},
        hastaneler:{!! $hastahaneler !!},
        doktorlar:null,
        mal_kodu:null,
        mal_adi:null,
        fiyat:null,
        ubb:null,
        skt:null,
        lot_no:null,
        form : new Form({
               satis_sekli:null,
                hastane:null,
                doktorl:null,
                hasta:null,
                kimlikno:null,
                protokol:null,
                serino:null
            }),
    },
})

</script>
@endsection