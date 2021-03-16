<?php use App\Feladat;
      use App\Megoldas;
      use App\UserModel;
?>

@extends('layouts.app')

@section('title', 'Feladat részletei')

@section('content')
    @if ($feladat == null)
        <div class="alert alert-danger text-center">
            A feladat nem található
        </div>
    @else
    <h1 class="text-center header my-3">Feladat részletei</h1>
    <?php
        $tol = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_tol);
        $ig = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_ig);
    ?>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <?php if (Auth::user()->foglalkozas != 'tanar'): ?>
                            <a href="{{ route('megold-feladat',['id' => $feladat->id]) }}">{{ $feladat->nev }}</a>
                        <?php else: ?>
                            <a>{{ $feladat->nev }}</a>
                        <?php endif; ?>
                        <br>
                        <a>Leírás: <i>{{ $feladat->leiras }}</i></a>
                        <br>
                        <a>Pont: {{ $feladat->pont }}</a>
                        <br>
                        </h5>
                        <a>Határidő: {{ $feladat->hatarido_tol }} -től</a>
                        <br>
                        <a>Határidő: {{ $feladat->hatarido_ig }} -ig</a>
                    </div>
    </div>
    <?php if (Feladat::find($feladat->id)->in_targy->tanarid == Auth::user()->id): ?>
        <div class="text-center my-4">
                <a href="{{ route('edit-feladat', ['id' => $feladat->id]) }}" role="button" class="btn btn-lg btn-primary">Feladat módosítása</a>
        </div>
        <h2 class="text-center header my-3">Beküldött megoldások</h2>
        <?php 
            $sols = $feladat->solutions;
        ?>
        @foreach ( $sols as $solution)
        
        <?php 
            $ertekelve = $solution->ertekeles != null;
            $s="";
            if ($ertekelve): 
                $s = "green";
            endif; ?>

        <div style ="border-color: <?=$s?>" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <a>Beküldő: <i>{{ UserModel::find($solution->diakid)->name }} | {{ UserModel::find($solution->diakid)->email }}</i></a>
                <br>
                <a>Beküldés ideje: {{ $solution->created_at }}</a>
                <?php if ($ertekelve): ?>
                    <h3>Értékelés ideje: {{ $solution->updated_at }} | Pontszám: {{ $solution->ertekeles }}</h3>
                <?php endif; ?>
                <?php if ($solution->path !="None"): ?>
                    <div class="mb-2">
                        <a href="{{ route('megold-letolt', ['id' => $solution->id]) }}" role="button" class="btn btn-primary">Megoldás letöltése</a>
                    </div>
                <?php else: ?>
                    <div class="mb-2">
                        <a role="button" class="btn btn-secondary">Nincs feltöltött fájl</a>
                    </div>
                <?php endif; ?>
                <?php if (!$ertekelve): ?>
                    <a href="{{ route('megold-ertekel', ['id' => $solution->id]) }}" role="button" class="btn btn-success">Értékel</a>
                <?php else: ?>
                    <a role="button" class="btn btn-secondary">Értékelve</a>
                <?php endif; ?>
            </div>
        </div>
        @endforeach
    <?php else: ?>  
        <h2 class="text-center header my-3">Beküldött megoldásaim</h2>
        <?php 
            $sols = $feladat->solutions;
        ?>
        @foreach ( $sols as $solution)
        <?php 
            $ertekelve = $solution->ertekeles != null;
            $s="";
            if ($ertekelve): 
                $s = "green";
            endif; ?>

        <div style ="border-color: <?=$s?>" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <a>Beküldés ideje: {{ $solution->created_at }}</a>
                <?php if ($ertekelve): ?>
                    <h3>Értékelés ideje: {{ $solution->updated_at }} | Pontszám: {{ $solution->ertekeles }}</h3>
                <?php endif; ?>
                <?php if ($solution->path !="None"): ?>
                    <div class="mb-2">
                        <a href="{{ route('megold-letolt', ['id' => $solution->id]) }}" role="button" class="btn btn-primary">Megoldás letöltése</a>
                    </div>
                <?php else: ?>
                    <div class="mb-2">
                        <a role="button" class="btn btn-secondary">Nincs feltöltött fájl</a>
                    </div>
                <?php endif; ?>
                <?php if ($ertekelve): ?>
                    <a role="button" class="btn btn-secondary">Értékelve</a>
                <?php endif; ?>
            </div>
        </div>
        @endforeach
    <?php endif; ?>
    @endif

@endsection