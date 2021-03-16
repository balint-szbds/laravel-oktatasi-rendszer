@extends('layouts.app')

@section('title', 'Profil')



@section('content')
    @guest
        <h1 class="text-center header my-3">You are not logged in!</h1>
    @else
    <?php $istanar = (Auth::user()->foglalkozas == "tanar"); ?>
    
        <h1 class="text-center header my-3">Az adataid</a>
        <h2 class="text-center header my-3">Név: {{ Auth::user()->name }}</a>
        <h2 class="text-center header my-3">E-mail cím: {{ Auth::user()->email }}</a>
        <?php if ($istanar): ?>
            <h2 class="text-center header my-3">Foglalkozás: Tanár</a>
        <?php else: ?>
            <h2 class="text-center header my-3">Foglalkozás: Diák</a>
        <?php endif; ?>
    @endguest
        

@endsection