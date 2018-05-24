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
            <div class="input-group mb-3">
                <input type="text" class="form-control" id='serino' v-model='form.serino' placeholder="Seri No" aria-label="Seri No" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class='col-4 '>
            <div class="form-group">
                <label for="malkod">Mal Kodu</label>
                <input type='text' class='form-control-plaintext' id='malkod' v-model='mal_kodu' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="malad">Mal Adı</label>
                <input type='text' class='form-control-plaintext' id='malad' v-model='mal_adi' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="fiyat">Fiyat</label>
                <input type='text' class='form-control-plaintext' id='fiyat' v-model='fiyat' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="ubb">UBB Kodu</label>
                <input type='text' class='form-control-plaintext' id='ubb' v-model='ubb' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="skt">S.K. Tarihi</label>
                <input type='text' class='form-control-plaintext' id='skt' v-model='skt' readonly />
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <label for="lot">Lot No</label>
                <input type='text' class='form-control-plaintext' v-model='lot_no' id='lot' readonly />
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <button type="button" class="btn btn-sm btn-block btn-primary" @click='kaydet'>Kaydet</button>
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
                aciklama:null,
                doktor:null,
                hasta:null,
                kimlikno:null,
                protokol:null,
                serino:null,
            }),
    },
    methods:{
        kaydet(){
            //this.form.post('/siparis');
            this.satislar.push(this.form);
        },
        bilgiAl(){
            if(this.form.serino){
                self = this;
                axios.get('/siparis?'+this.form.serino)
                    .then(function(response){
                        self.fiyat = response.fiyat;
                        self.ubb = response.ubb;
                        self.skt = response.skt;
                        self.lot_no = response.lot_no;
                        self.mal_kodu = response.mal_kodu;
                        self.mal_adi = response.mal_adi;
                    });
            }
        },
    },
})

</script>
@endsection