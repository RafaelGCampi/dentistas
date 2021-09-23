<?php

namespace App\Http\Controllers;

use App\Models\Dentistas;
use App\Models\Especialidades;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DentistasController extends Controller
{

    public function index()
    {
        return view('dentistas.list');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required|string',
            'email'=>'required|email',
            'cro'=>'required|numeric',
            'cro_uf'=>'required'
        ]);
        try{
            DB::beginTransaction();

            //dd($request->id);
            if($request->id==null){
                $dentistas = Dentistas::create([
                    'nome'=>$request->nome,
                    'email'=>$request->email,
                    'cro'=>$request->cro,
                    'cro_uf'=>$request->cro_uf,
                ]);
            }
            else{
                $dentistas= Dentistas::find($request->id);
                $dentistas->nome =$request->nome;
                $dentistas->email =$request->email;
                $dentistas->cro =$request->cro;
                $dentistas->cro_uf =$request->cro_uf;
                $dentistas->save();
            }



            if($request->especialidades!=null){
                $dentistas->especialidades()->detach();
                foreach($request->especialidades as $especialidade)
                {
                    $dentistas->especialidades()->attach($especialidade);
                }
            }

            DB::commit();
            return response()->json(['status'=>true,'message'=>$dentistas]);
        }
        catch(Exception $exception){
            DB::rollback();
            return response()->json(['status'=>false,'erro'=>$exception->getMessage()],402);
        }
    }

    public function show()
    {
        return view('dentistas.componentes.formulario');
    }


    public function edit(Dentistas $dentistas)
    {
        $dentistasGet = Dentistas::with('especialidades')->find($dentistas->id);

        return response($dentistasGet);
    }

    public function destroy(Dentistas $dentistas)
    {
        try{
            DB::beginTransaction();
            $dentistas->delete();
            DB::commit();
            return response()->json(['status'=>true,'message'=>'Delado com sucesso.']);
        }
        catch(Exception $exception){
            DB::rollback();
            return response()->json(['status'=>false,'message'=>$exception->getMessage()],402);
        }
    }

    public function list()
    {
        $dentistas = Dentistas::limit(5)->get();
        return response($dentistas);
    }

    public function search(Request $request)
    {
        $dentistas = Dentistas::query();

        if($request->nome_filter!=null){
            $dentistas->where('nome','like',$request->nome_filter.'%');
        }
        if($request->cro_filter!=null){
            $dentistas->where('cro','like',$request->cro_filter.'%');

        }
        if($request->especialidade_filter!=0){
            $dentistas->whereHas('especialidades',function($q) use($request){
              $q->where('id',$request->especialidade_filter);
            });
        }

        return response($dentistas->limit(5)->get());
    }

    public function filter(){

    }
}
