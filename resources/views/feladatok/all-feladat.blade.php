<?php 
    use App\Targy; 
    use App\Feladat;
    use App\UserModel;
?>

@extends('layouts.app')

@section('title', 'Feladataim')

@section('content')
    <?php   
        $targyak = UserModel::find(Auth::user()->id)->studies_in;
        $now = new DateTime("now", new DateTimeZone('Europe/Budapest'));
        $nowtime = $now->getTimestamp();
        $nowstring = $now->format('Y.m.d H:i:s');
        function intcmp($a,$b) {
            if((int)$a == (int)$b)return 0;
            if((int)$a  < (int)$b)return 1;
            if((int)$a  > (int)$b)return -1;
        }
    ?>
    <h1 class="text-center header my-3">Aktuális feladataim</h1>
    <div>Most <?=$nowstring?> van</div>
    
    @foreach ($targyak as $targy)
    
    <?php 
        $feladatok = Targy::find($targy->id)->assignments;
    ?>
    <div class="list-group">
    <?php
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
        <?php if ($showStudent): ?>
        <div style=<?=$style?> class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                <a href="{{ route('feladat-reszletek',['id' => $feladat->id]) }}">{{ $feladat->nev }}</a>
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
    @endforeach

@endsection
