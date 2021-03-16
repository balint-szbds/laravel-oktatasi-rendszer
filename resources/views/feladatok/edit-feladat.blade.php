@extends('layouts.app')

@section('title', 'Feladat szerkesztése')

@section('content')
<h1 class="text-center my-4">Meglévő feladat szerkesztése</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <p>A validáció során az alábbi hibák történtek:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('update-feladat', ['id' => $feladat->id]) }}" method="post" class="card py-2 px-4">
    @csrf
    <div class="form-group">
        <label for="nev">Név</label>
        <input name="nev" type="text" class="form-control" value="{{ $feladat->nev }}" >
    </div>
    <div class="form-group">
        <label for="leiras">Leírás</label>
        <input name="leiras" type="text" class="form-control" value="{{ $feladat->leiras }}" >
    </div>
    <div class="form-group">
        <label for="pont">Pontérték</label>
        <input name="pont" type="text" class="form-control" value="{{ $feladat->pont }}" >
    </div>
    <div class="form-group">
        <label for="tol">Határidő -től (ÉÉÉÉ.HH.NN ÓÓ:PP:MM)</label>
        <input name="tol" type="text" class="form-control" value="{{ $feladat->hatarido_tol }}" >
    </div>
    <div class="form-group">
        <label for="ig">Határidő -ig (ÉÉÉÉ.HH.NN ÓÓ:PP:MM)</label>
        <input name="ig" type="text" class="form-control" value="{{ $feladat->hatarido_ig }}" >
    </div>

    <div class="text-center my-4">
        <button type="submit" class="btn btn-lg btn-primary">Módosít</button>
    </div>

</form>
@endsection
