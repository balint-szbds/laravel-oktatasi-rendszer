<?php use App\UserModel; ?>

@extends('layouts.app')

@section('title', 'Tárgy felvétele')



@section('content')
       <h1 class="text-center header my-3">Nyílvános tárgyak</a>
            @foreach ($targyak as $targy)
            <?php if ($targy->publikalt): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <a href="{{ route('reszletek',['id' => $targy->id]) }}">{{ $targy->nev }}</a>
                        <a>- {{ $targy->kod }} - Kreditérték: {{ $targy->kredit }}</a>
                        <br>
                        <br>
                        <a><i>{{ $targy->leiras }}</i></a>
                        </h5>
                        <a href="{{ route('apply-targy',['id' => $targy->id]) }}" style="text-align:right"><i class="fas fa-edit text-success"></i>Jelentkezés tárgyra</a>

                    </div>
                </div>
            <?php endif; ?>
            @endforeach
        

@endsection

