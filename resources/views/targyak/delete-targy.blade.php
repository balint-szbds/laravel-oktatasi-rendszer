@extends('layouts.app')

@section('title', 'Tárgy törlése')

@section('content')
    <h1 class="text-center my-4">Tárgy törlése</h1>

    @if (session()->has('result'))
        @if (session()->get('result') == true)
            <div class="alert alert-success text-center" role="alert">
                A tárgy sikeresen ki lett törölve!
            </div>
        @else
            <div class="alert alert-danger text-center" role="alert">
                A törlés nem sikerült
            </div>
        @endif
    @endif
@endsection
