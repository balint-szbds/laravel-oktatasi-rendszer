<?php 
    use App\Feladat; 
    use App\Megoldas; 
    use App\Targy;
?>

@extends('layouts.app')

@section('title', 'Feladat megoldása')

@section('content')
<?php $feladat = Feladat::find($id); ?>
    @if ($feladat == null)
        <div class="alert alert-danger text-center">
            A feladat nem található
        </div>
    @else
    <?php 
        $targynev = $feladat->in_targy->nev;
        $tanarnev = $feladat->in_targy->teacher->name;
        $tol = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_tol);
        $ig = DateTime::createFromFormat('Y.m.d. H:i:s', $feladat->hatarido_ig);
        $diakid = Auth::user()->id;
    ?>
    <h1 class="text-center header my-3">{{ $feladat->nev }} megoldása</h1>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <a>Tárgy neve: <?=$targynev?></a>
                        <br>
                        <a>Tanár neve: <?=$tanarnev?></a>
                        <br>
                        <a>Max pont: {{ $feladat->pont }}</a>
                        <br>
                        <br>
                        <details open><i>{{ $feladat->leiras }}</i></details>
                        </h5>
                        <a>Határidő: {{ $feladat->hatarido_tol }} -től</a>
                        <br>
                        <a>Határidő: {{ $feladat->hatarido_ig }} -ig</a>
                    </div>
    </div>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
        <h5 class="mb-1">
        <a></a>
        </h5>
        <form enctype="multipart/form-data" action="{{ route('store-megoldas', ['feladatid' => $id, 'diakid' => $diakid]) }}" method="post" class="card py-2 px-4">
            @csrf
            <div class="form-group">
                <label for="hallgato_megjegyzes">Feladat megoldása/megjegyzés hozzáadása</label>
                <textarea name="hallgato_megjegyzes"  type="text" class="form-control" cols="70" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Fájl csatolása:</label>
                <br>
                <input name="attachment" type="file">
            </div>
            <div class="text-center my-4">
                <button type="submit" class="btn btn-lg btn-primary">Megoldás beküldése</button>
            </div>
        </form>
    </div>
    @endif
@endsection