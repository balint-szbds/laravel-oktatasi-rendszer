@extends('layouts.app')

@section('title', 'Tárgy szerkesztése')

@section('content')
<h1 class="text-center my-4">Meglévő tárgy szerkesztése</h1>

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

<form action="{{ route('update-targy', ['id' => $targy->id]) }}" method="post" class="card py-2 px-4">
    @csrf
    <div class="form-group">
        <label for="nev">Név</label>
        <input name="nev" type="text" class="form-control" value="{{ $targy->nev }}" >
    </div>
    <div class="form-group">
        <label for="leiras">Leírás</label>
        <input name="leiras" type="text" class="form-control" value="{{ $targy->leiras }}" >
    </div>
    <div class="form-group">
        <label for="kod">Neptun kód</label>
        <input name="kod" type="text" class="form-control" value="{{ $targy->kod }}" >
    </div>
    <div class="form-group">
        <label for="kredit">Kreditérték</label>
        <input name="kredit" type="text" class="form-control" value="{{ $targy->kredit }}" >
    </div>

    <div class="text-center my-4">
        <button type="submit" class="btn btn-lg btn-primary">Módosít</button>
    </div>

</form>
@endsection
