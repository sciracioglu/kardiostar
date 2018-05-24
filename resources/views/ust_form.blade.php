<div class='row'>
    <div class='col-sm-12 col-md-4'>
        <div class="form-group">
            <label for="satis_sekli">Satış Şekli</label>
            <select class="form-control" id="satis_sekli" v-model='form.satis_sekli' >
                    <option v-for='sekil in satis_sekilleri' :value='sekil.KOD'>@{{ sekil.ACIKLAMA }}</option>
                    
            </select>
            <small id="sevkuyari" class="form-text text-muted">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <label for="hastane">Hastane</label>
            <select class="form-control" id="hastane" v-model='form.hastane' >
                    <option v-for='hastane in hastaneler' :value='hastane.KOD'>@{{ hastane.ACIKLAMA }}</option>
            </select>
            <small id="sevkuyari" class="form-text text-muted">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
         <div class="form-group">
            <label for="doktor">Görüşülen Doktor</label>
            <select class="form-control" id="doktor" v-model='form.doktor'>
            </select>
            <small id="sevkuyari" class="form-text text-muted">Bu alan bos birakilamaz</small>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-12 col-md-4'>
        <div class="form-group">
            <label for="hasta_adsoyad">Hasta Adı Soyadı</label>
            <input type='text' class='form-control' id='hasta_adsoyad' v-model='form.hasta' />
        </div>
    </div>
    <div class='col-6 col-md-4'>
         <div class="form-group">
            <label for="kimlikno">Hasta T.C. Kimlik No</label>
            <input type='text' class='form-control' id='kimlikno' v-model='form.kimlikno' />
        </div>
    </div>
    <div class='col-6 col-md-4'>
         <div class="form-group">
            <label for="protokolno">Hasta Protokol No</label>
            <input type='text' class='form-control' id='protokolno' v-model='form.protokol' />
        </div>
    </div>
</div>
<div class="form-group">
    <label for="aciklama">Açıklama</label>
    <input type='text' class='form-control' id='aciklama' v-model='form.aciklama' />
</div>
<hr>