<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Targy;
use App\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TargyController extends Controller
{
    use ValidatesRequests;
    public function indexAdd() {
        return view('targyak.add-targy');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nev' => 'required|min:3',
            'kod' => 'required|regex:/^IK-[a-zA-Z][a-zA-Z][a-zA-Z][0-9][0-9][0-9]\b/',
            'kredit' => 'required|integer|min:0',
        ]);


        $targy = new Targy;
        $targy->nev = $request->input('nev');
        $targy->leiras = $request->input('leiras');
        $targy->kod = $request->input('kod');
        $targy->kredit = $request->input('kredit');
        $targy->publikalt = 0;
        $targy->tanarid = Auth::user()->id;
        $result = $targy->save();


        return redirect()->route('home');
    }

    public function publikal($id) {
        $targy = Targy::find($id);
        if($targy->publikalt){
            $targy->publikalt=0;
        }
        else{
            $targy->publikalt=1;
        }
        $targy->update();

        return redirect()->route('home');
    }

    public function reszletek($id) {
        $targy = Targy::find($id);
        return view('targyak.reszletek-targy')->with('targy', $targy);
    }

    public function indexEdit($id) {
        $targy = Targy::find($id);
        return view('targyak.edit-targy')->with('targy', $targy);
    }

    
    
    public function update(Request $request, $id) {
        $validated_data = $request->validate([
            'nev' => 'required|min:3',
            'kod' => 'required|regex:/^IK-[a-zA-Z][a-zA-Z][a-zA-Z][0-9][0-9][0-9]\b/',
            'kredit' => 'required|integer|min:0',
        ]);
        $leiras = $request->input('leiras', null);
        $targy = Targy::find($id);
        $targy->leiras = $leiras;
        $targy->update();
        $targy->update($validated_data);

        return view('targyak.reszletek-targy')->with('targy', $targy);
    }
    
    public function indexDelete() {
        return view('targyak.delete-targy');
    }

    public function delete(Request $request, $id) {
        $targy = Targy::find($id);
        $name = null;
        $result = false;

        if ($targy != null) {
            $name = $targy->name;
            $result = $targy->delete();
        }

        return redirect()->route('delete-targy')
                    ->with('result', $result)
                    ->with('name', $name);
    }

    public function listAll(){
        $targyak = Targy::all();
        return view('targyak.all-targy')->with('targyak', $targyak);
    }

    public function indexApply($id){
        $targy = Targy::find($id);
        $targy->students()->attach(UserModel::find(Auth::user()->id));
        return redirect()->route('home');
    }
    
}
