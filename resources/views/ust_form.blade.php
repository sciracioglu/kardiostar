<div class='row'>
    <div class='col-sm-12 col-md-4'>
        <div class="form-group">
            <label for="satis_sekli">Satış Şekli</label>
            <select class="form-control" id="satis_sekli" >
            </select>
            <small id="sevkuyari" class="form-text text-muted">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <label for="hastane">Hastane</label>
            <select class="form-control" id="hastane" >
            </select>
            <small id="sevkuyari" class="form-text text-muted">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
         <div class="form-group">
            <label for="doktor">Görüşülen Doktor</label>
            <select class="form-control" id="doktor" >
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
<hr>