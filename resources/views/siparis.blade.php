@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Sipariş
@endsection

@section('icerik')
    <form @submit.prevent="kaydet" @keydown="form.errors.clear($event.target.name)">
        @include('ust_form')
    <nav aria-label="breadcrumb" v-if='satislar.lenght > 0'>
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
                <input type="text" class="form-control" id='serino' @blur='bilgiAl' v-model='form.serino' placeholder="Seri No" aria-label="Seri No">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" @click='bilgiAl'><i class="fa fa-search"></i></button>
                </div>
                <small id="serino" class="form-text text-danger" v-if="form.errors.has('serino')">Bu alan bos birakilamaz</small>
            </div>
        </div>
    </div>
    <div class="row" v-if='mal_kodu'>
        <div class='col-4 '>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="malkod">Mal Kodu</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' id='malkod' v-model='mal_kodu' readonly /></div>
                </div>
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="malkod">Mal Ad</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' id='malad' v-model='mal_adi' readonly /></div>
                </div>
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="fiyat">Fiyat</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' id='fiyat' v-model='fiyat' readonly /></div>
                </div>
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="ubb">UBB Kodu</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' id='ubb' v-model='ubb' readonly /></div>
                </div>
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="skt">S.K. Tarihi</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' id='skt' v-model='skt' readonly /></div>
                </div>
            </div>
        </div>
        <div class='col-4'>
            <div class="form-group">
                <div class="row">
                    <div class="col-3"><strong><label for="lot">Lot No</label></strong></div>
                    <div class="col-9"><input type='text' class='form-control-plaintext' v-model='lot_no' id='lot' readonly /></div>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <button type="submit" class="btn btn-sm btn-block btn-primary">Kaydet</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>

var vue=new Vue({
    el:'#app',
    data:{
        satislar:[],
        satis_sekilleri:{!! $satis_sekilleri !!},
        hastaneler:{!! $hastahaneler !!},
        doktorlar:null,
        mal_kodu:null,
        mal_adi:null,
        fiyat:null,
        ubb:null,
        skt:null,
        lot_no:null,
        evrak_baslik:{!! session()->has('evrak_baslik') ? session('evrak_baslik') : "null" !!},
        form : new Form({
                satis_sekli:null,
                hastane:null,
                aciklama:null,
                doktor:null,
                hasta:null,
                kimlikno:null,
                protokol:null,
                serino:null,
                evrak_no:'{{ $evrak_no }}',
            }),
    },
    methods:{
        kaydet(){ 
            self = this;
            axios.post('/siparis',this.form);
           
        },
        bilgiAl(){
            if(this.form.serino){
                self = this;
                axios.get('/siparis?serino='+this.form.serino)
                    .then(function(response){
                        self.fiyat = response.data[0].FIYAT;
                        self.ubb = response.data[0].BARKOD1;
                        self.skt = response.data[0].SKT;
                        self.lot_no = response.data[0].LOTNO;
                        self.mal_kodu = response.data[0].MALKOD;
                        self.mal_adi = response.data[0].MALAD;
                    });
            }
        },
    },
})

</script>
@endsection