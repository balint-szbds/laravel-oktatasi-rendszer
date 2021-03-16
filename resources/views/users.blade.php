
<?php use App\UserModel; ?>

@extends('layouts.app')

@section('title', 'Főoldal')



@section('content')
    @guest
        <h1 class="text-center header my-3">Felhasználók</h1>
        <div class="list-group">
            @foreach ($lists as $list)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <a>{{ $list->name }} -</a>
                        <?php if ($list->foglalkozas == "tanar"): ?>
                            <a>Tanár</a>
                        <?php else: ?>
                            <a>Diák</a>
                        <?php endif; ?>
                        </h5>
                    </div>
                </div>
            @endforeach
            <h6>Tanárok száma: {{$lists->groupBy('foglalkozas')->map->count()->values()->last()}}</h6>
            <h6>Diákok száma: {{$lists->groupBy('foglalkozas')->map->count()->values()->first()}}</h6>
            
        </div>
    @else
    <?php $istanar = (Auth::user()->foglalkozas == "tanar"); ?>
    <?php if ($istanar): ?>
    <p>Tanár mód</p>
    <?php else: ?>
    <p>Diák mód</p>
    <?php endif; ?>
        <h1 class="text-center header my-3">Üdv, {{ Auth::user()->name }}!</a>
        <?php if ($istanar): ?>
            <h2 class="text-center header my-3">Saját tárgyaim</h2>
            @foreach ($targyak as $targy)
            <?php if ($targy->tanarid == Auth::user()->id): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <a href="{{ route('reszletek',['id' => $targy->id]) }}">{{ $targy->nev }}</a>
                        <a>- {{ $targy->kod }} - Kreditérték: {{ $targy->kredit }}</a>
                        <br>
                        <br>
                        <a><i>{{ $targy->leiras }}</i></a>
                        </h5>
                        <?php if($targy->publikalt): ?>
                            <a href="{{ route('publikal',['id' => $targy->id]) }}" style="text-align:right"><i class="fas fa-edit text-danger"></i>Publikálás visszavonása</a>
                        <?php else: ?>
                            <a href="{{ route('publikal',['id' => $targy->id]) }}" style="text-align:right"><i class="fas fa-edit text-success"></i>Publikál</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            @endforeach
        <?php else: ?>
            <h2 class="text-center header my-3">Felvett tárgyaim</h2>
            <?php $targyak = UserModel::find(Auth::user()->id)->studies_in ?>
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
                    </div>
                </div>
            <?php endif; ?>
            @endforeach
        <?php endif; ?>
        
    @endguest
        

@endsection

