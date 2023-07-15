<?php

namespace App\Http\Controllers;

use App\Http\Resources\PairResources;
use Exception;
use App\Models\Pair;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            
            return response()->json([
                'status'=>'Done',
                'message'=>'La liste des pairs a été récuperer avec succes',
                'data'=>PairResources::collection(Pair::all()), // On retourne une collection de la ressources
            ]);
        } catch (Exception $error) {
            return response()->json(  
                $error
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validator = $request->validate([
                'id_sources'=>'required',
                'id_target'=>'required',
                'conversion_rates'=>'required',
            ]);

            // Declaration des variables que j'utiliserais dans les instensiation
            $id_sources = $validator['id_sources'];
            $id_target =   $validator['id_target'];
            $conversion_rates =   $validator['conversion_rates'];
            

            // Vérifier si la paire existe déjà
            $existingPair = Pair::where('id_sources', $id_sources)
            ->where('id_target', $id_target)
            ->first();

            if ($existingPair) {
            // La paire existe déjà
            return response()->json([
            'status' => 'Error',
            'message' => 'La paire existe déjà',
            ]);
            }

            // instensiation de la pair pour éviter les doublons
            $add_pairs = new Pair();
            $add_pairs->id_sources = $id_sources;
            $add_pairs->id_target =  $id_target;
            $add_pairs->conversion_rates =  $conversion_rates;
            $add_pairs->count = 0;
            $add_pairs->save();
            return response()->json([
                'status'=>'Done',
                'message'=>'Votre pair a été créer avec succes',
            ]);

        } catch (Exception $error) {
            return response()->json(  
                $error
            );
        }
         

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = $request->validate([
                'id_sources'=>'required',
                'id_target'=>'required',
                'conversion_rates'=>'required',
            ]);

            //on recherche l'id de l'element qu'on souhaite modifier
            $pair = Pair::findOrfail($id);
            $id_sources = $validator['id_sources'];
            $id_target =   $validator['id_target'];
            $conversion_rates =   $validator['conversion_rates'];

            
            //On recupere les element du formulaire et on met a jour les données.
            $pair->id_sources = $id_sources;
            $pair->id_target =  $id_target;
            $pair->conversion_rates =  $conversion_rates;
            $pair->update();
            return response()->json([
                'status'=>'Done',
                'message'=>'Votre pair a été modifier avec succes',
            ]);
        } catch (Exception $error) {
            return response()->json(  
                $error
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        try {
            $pair = Pair::findOrfail($id);
            $pair->delete();
            return response()->json([
                'status'=>'Done',
                'message'=>'Votre pair a été supprimer avec succes',
            ]);
        } catch (Exception $error) {
            return response()->json(  
                $error
            );
            
        }
        
    }
}
