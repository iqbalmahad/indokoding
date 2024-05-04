@extends('client.template.main')
@section('content')
<section >
    <div class="jumbotron">
        <div class="container">
            <p class="lead">nama kategori</p>
        </div>
    </div>        
</section>
<!-- start list artikel -->
<div class="container">
    <div id="card-artikel" class="row">
        @include('client.components.artikel_card_kecil')
        @include('client.components.artikel_card_kecil')
        @include('client.components.artikel_card_kecil')
        @include('client.components.artikel_card_kecil')
        @include('client.components.artikel_card_kecil')
        @include('client.components.artikel_card_kecil')
    </div>
</div>
@endsection