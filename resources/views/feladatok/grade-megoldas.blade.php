<?php 
    use App\Feladat; 
    use App\Megoldas; 
    use App\Targy;
?>

@extends('layouts.app')

@section('title', 'Megoldás értékelése')

@section('content')
<?php $solution = Megoldas::find($id); ?>
    @if ($solution == null)
        <div class="alert alert-danger text-center">
            A megoldás nem található
        </div>
    @else
    <?php 
        $feladat = Feladat::find($solution->feladatid);
        $leiras = $feladat->leiras;
        $maxpont = $feladat->pont;
    ?>
    <h1 class="text-center header my-3">{{ $solution->diak->name }} megoldása</h1>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                        <details><i><?=$leiras?></i></details>
                        <br>
                        <a>Megoldás szövege: {{ $solution->hallgato_megjegyzes }}</a>
                        <br>
                        <form action="{{ route('update-megold', ['id' => $id]) }}" method="post" class="card py-2 px-4">
                            @csrf
                            <div class="form-group">
                                <label for="ertekeles">Értékelés</label>
                                <input type="number" id="ertekeles" name="ertekeles" min="0" max=<?=$maxpont?>>
                            </div>
                            <div class="form-group">
                                <label for="tanar_megjegyzes">Megjegyzés hozzáadása</label>
                                <textarea name="tanar_megjegyzes"  type="text" class="form-control" cols="70" rows="5"></textarea>
                            </div>
                            <div class="text-center my-4">
                                <button type="submit" class="btn btn-lg btn-primary">Értékelés beküldése</button>
                            </div>
                        </form>
                        <?php if ($solution->path !="None"): ?>
                            <div class="mb-2">
                                <a href="{{ route('megold-letolt', ['id' => $solution->id]) }}" role="button" class="btn btn-primary">Megoldás letöltése</a>
                            </div>
                        <?php else: ?>
                            <div class="mb-2">
                                <a role="button" class="btn btn-secondary">Nincs feltöltött fájl</a>
                            </div>
                        <?php endif; ?>
                    </div>
    </div>

    @endif
@endsection