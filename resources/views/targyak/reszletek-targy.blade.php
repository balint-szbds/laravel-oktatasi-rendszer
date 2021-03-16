<?php use App\Targy; ?>

@extends('layouts.app')

@section('title', 'Tárgy részletei')

@section('content')
    @if ($targy == null)
        <div class="alert alert-danger text-center">
            A tárgy nem található
        </div>
    @else
    <h1 class="text-center header my-3">Tárgy részletei</h1>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <a>Név: {{ $targy->nev }}</a>
                        <br>
                        <a>Kód: {{ $targy->kod }}</a>
                        <br>
                        <a>Kreditérték: {{ $targy->kredit }}</a>
                        <br>
                        <br>
                        <a>Leírás: <i>{{ $targy->leiras }}</i></a>
                        </h5>
                        <a>Létrehozás dátuma: {{ $targy->created_at }}</a>
                        <br>
                        <a>Utolsó módosítás dátuma: {{ $targy->updated_at }}</a>
                        <?php if ($targy->tanarid == Auth::user()->id): ?>
                            <h5 class="mb-1">
                            <a href="{{ route('add-feladat',['id' => $targy->id]) }}" style="text-align:right"><i class="fas fa-edit text-success"></i>Új feladat kiírása</a>
                            </h5>
                        <?php endif; ?>
                    </div>
    </div>
    <?php if ($targy->tanarid == Auth::user()->id): ?>
    <div class="text-center my-4">
            <a href="{{ route('edit-targy', ['id' => $targy->id]) }}" role="button" class="btn btn-lg btn-primary">Tárgy módosítása</a>
    </div>
    <form action="{{ route('delete-targy-post', ['id' => $targy->id ]) }}" method="post">
        @csrf
        <button class="btn btn-lg btn-secondary"><i class="far fa-trash-alt text-danger"></i>Tárgy törlése</button>
    </form>
    <?php endif; ?>
    <h2 class="text-center header my-3">Tárgy feladatai</h2>
    <?php 
        $feladatok = Targy::find($targy->id)->assignments;
        
        $now = new DateTime("now", new DateTimeZone('Europe/Budapest'));
        $nowtime = $now->getTimestamp();
        $nowstring = $now->format('Y.m.d H:i:s');
    ?>
    <div class="list-group">
    <div>Most <?=$nowstring?> van</div>
    <?php
        function intcmp($a,$b) {
            if((int)$a == (int)$b)return 0;
            if((int)$a  < (int)$b)return 1;
            if((int)$a  > (int)$b)return -1;
        }

        $arr = [];
        foreach ($feladatok as $feladat):
            array_push($arr, $feladat);
        endforeach;
        usort($arr, fn($a, $b) => intcmp(DateTime::createFromFormat('Y.m.d. H:i:s', $a->hatarido_ig)->getTimestamp(), DateTime::createFromFormat('Y.m.d. H:i:s', $b->hatarido_ig)->getTimestamp()));
    ?>

    @foreach ($arr as $feladat)
        <?php 
            $style='background-color:white';
            $showStudent = false;
            $tol = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_tol);
            $ig = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_ig);

            $tolt = $tol->getTimestamp();
            $igt = $ig->getTimestamp();

            if ($igt < $nowtime){
                $style='background-color:red'; 

            }   
            else if ($tolt < $nowtime){
                $style='background-color:green';
                $showStudent = true;
            }
        ?>
        <?php if ($targy->tanarid == Auth::user()->id || $showStudent): ?>
        <div style=<?=$style?> class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                <?php if ($targy->tanarid == Auth::user()->id): ?>
                    <a href="{{ route('feladat-reszletek',['id' => $feladat->id]) }}">{{ $feladat->nev }}</a>
                <?php else: ?>
                    <a href="{{ route('megold-feladat',['id' => $feladat->id]) }}">{{ $feladat->nev }}</a>
                <?php endif; ?>
                <br>
                <a>Pont: {{ $feladat->pont }}</a>
                <br>
                <br>
                <a>Leírás: <i>{{ $feladat->leiras }}</i></a>
                </h5>
                <a>Határidő: {{ $feladat->hatarido_tol }} -től</a>
                <br>
                <a>Határidő: {{ $feladat->hatarido_ig }} -ig</a>
            </div>
        </div>
        <?php endif; ?>
    @endforeach
    </div>
    @endif

@endsection
