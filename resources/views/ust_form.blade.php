<div class='row'>
    <div class='col-sm-12 col-md-4'>
        <div class="form-group">
            <label for="satis_sekli">Satış Şekli</label>
            <select class="form-control" id="satis_sekli" v-model='form.satis_sekli' >
                    <option v-for='sekil in satis_sekilleri' :value='sekil.KOD'>@{{ sekil.ACIKLAMA }}</option>
                    
            </select>
            <small id="sevkuyari" class="form-text text-danger" v-if="form.errors.has('satis_sekli')">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <label for="hastane">Hastane</label>
            <select class="form-control" id="hastane" v-model='form.hastane' >
                    <option v-for='hastane in hastaneler' :value='hastane.KOD'>@{{ hastane.ACIKLAMA }}</option>
            </select>
            <small id="sevkuyari" class="form-text text-danger" v-if="form.errors.has('hastane')">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
         <div class="form-group">
            <label for="doktor">Görüşülen Doktor</label>
            <input type="text" class="form-control" id="doktor" v-model='form.doktor' placeholder="Doktor" />
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-12 col-md-4'>
        <div class="form-group">
            <input type='text' class='form-control' id='hasta_adsoyad' placeholder="Hasta Adı Soyadı" v-model='form.hasta' />
        </div>
        <small class="form-text text-danger" v-if="form.errors.has('hasta')">Bu alan bos birakilamaz</small>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <input type='text' class='form-control' id='kimlikno' placeholder="Hasta T.C. Kimlik No" v-model='form.kimlikno' />
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <input type='text' class='form-control' id='protokolno' placeholder="Hasta Protokol No" v-model='form.protokol' />
        </div>
    </div>
</div>
<div class='row'>
    <div class='col'>
        <div class="form-group">
            <input type='text' class='form-control' placeholder="Açıklama" id='aciklama' v-model='form.aciklama' />
        </div>
    </div>
</div>