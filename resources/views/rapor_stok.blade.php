@extends('layouts.master')
@section('baslik')
    {{ session('musteri.unvan') }}
@endsection

@section('kucuk_baslik')
    Stok Durum Raporu
@endsection

@section('icerik')
<table class="table table-condenced table-hover">
    <thead>
        <tr>
            <th>Mal Kod</th>
            <th>Mal Ad</th>
            <th class="text-right">Stok Miktar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($raporlar as $rapor)
        <tr>
            <td>{{ $rapor->MALKOD }}</td>
            <td>{{ $rapor->STKKRT_MALAD.' '.$rapor->STKKRT_MALAD2 }}</td>
            <td class="text-right">{{ $rapor->STOKMIKTAR }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
var vue = new Vue({
    el:'#app',
    data:{
        raporlar: {!! $raporlar !!},
    }
})

</script>
@endsection