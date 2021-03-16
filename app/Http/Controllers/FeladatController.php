<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use App\Feladat;
use App\Targy;
use App\Megoldas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

class FeladatController extends Controller
{
    use ValidatesRequests;
    public function indexAdd($id) {
        return view('feladatok.add-feladat')->with('id', $id);
    }

    public function reszletek($id){
        $feladat = Feladat::find($id);
        return view('feladatok.reszletek-feladat')->with('feladat', $feladat);
    }

    public function store(Request $request, $id) {
        $validated = $request->validate([
            'nev' => 'required|min:5',
            'leiras' => 'required',
            'pont' => 'integer'
        ]);

        $feladat = new Feladat;
        $feladat->nev = $request->input('nev');
        $feladat->leiras = $request->input('leiras');
        $feladat->pont = $request->input('pont');
        $feladat->hatarido_tol = $request->input('tol');
        $feladat->hatarido_ig = $request->input('ig');
        $feladat->targyId = $id;
        $result = $feladat->save();

        $targy = Targy::find($id);
        return view('targyak.reszletek-targy')->with('targy', $targy);
    }

    public function indexEdit($id) {
        $feladat = Feladat::find($id);
        return view('feladatok.edit-feladat')->with('feladat', $feladat);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nev' => 'required|min:5',
            'leiras' => 'required',
            'pont' => 'integer'
        ]);

        $feladat = Feladat::find($id);

        $feladat->leiras = $request->input('leiras'); 
        $feladat->hatarido_tol = $request->input('tol');
        $feladat->hatarido_ig = $request->input('ig');
        $feladat->update();
        $feladat->update($validated);

        return view('feladatok.reszletek-feladat')->with('feladat', $feladat);
    }

    public function list(){
        return view('feladatok.all-feladat');
    }

    public function indexSolve($id) {
        return view('feladatok.solve-feladat')->with('id', $id);
    }

    public function storeSolution(Request $request, $feladatid, $diakid) {
        $validated = $request->validate([
            'hallgato_megjegyzes' => 'required'
        ]);

        $megoldas = new Megoldas;
        $megoldas->hallgato_megjegyzes = $request->input('hallgato_megjegyzes');
        if ($request->file('attachment')!=null){
            $megoldas->path = $request->file('attachment')->store('attachments');
        }
        else
        {
            $megoldas->path = "None";
        }
        $megoldas->feladatid = $feladatid;
        $megoldas->diakid = $diakid;
        $result = $megoldas->save();

        $feladat = Feladat::find($feladatid);
        return view('feladatok.reszletek-feladat')->with('feladat', $feladat);
    }

    public function indexDownload($id){
        return Storage::download(Megoldas::find($id)->path);
    }

    public function indexGrade($id){
        return view('feladatok.grade-megoldas')->with('id', $id);
    }

    public function updateSolution(Request $request, $id) {
        $validated = $request->validate([
            'ertekeles' => 'required'
        ]);

        $solution = Megoldas::find($id);
        $solution->tanar_megjegyzes = $request->input('tanar_megjegyzes', null); 
        $solution->update();
        $solution->update($validated);

        $feladat = Feladat::find($solution->feladatid);
        return view('feladatok.reszletek-feladat')->with('feladat', $feladat);
    }

}
