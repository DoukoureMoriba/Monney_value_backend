<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'Done',
            'message' => 'La liste des monnaies a été récuperer',
            'data' => Currency::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'code_currency' => 'required',
            ]);

            // Declaration de variables que j'utiliserais dans les instensiation
            $code_currency = $validator['code_currency'];

            // Vérifier si la Monnaie existe déjà
            $existingCurrency = Currency::where('code_currency', $code_currency)
                ->first();

            if ($existingCurrency) {
                // La monnaie existe déjà
                return response()->json([
                    'status' => 'Error',
                    'message' => 'La Monnaie existe déjà',
                ]);
            }

            $add_money = new Currency();
            $add_money->code_currency = $code_currency;
            $add_money->save();
            return response()->json([
                'status' => 'Done',
                'message' => 'Votre monnaie a été créer avec succes',
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
        try {
            $currency = Currency::findOrfail($id);
            return response()->json([
                'status' => 'Done',
                'message' => 'Les infos de la monnaie ont été récuperer avce succes',
                'data' => $currency,
            ]);
        } catch (Exception $error) {
            return response()->json(
                $error
            );
        }
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
                'code_currency' => 'required',
            ]);

            $currency = Currency::findOrFail($id);
            $code_currency = $validator['code_currency'];

            $currency->code_currency = $code_currency;
            $currency->update();
            return response()->json([
                'status' => 'Done',
                'message' => 'Monnaie modifiée avec succès',
            ]);
        } catch (Exception $error) {
            return response()->json($error);
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
            $currency = Currency::findOrfail($id);
            $currency->delete();
            return response()->json([
                'status' => 'Done',
                'message' => 'Votre Monnaie a été supprimer avec succes',
            ]);
        } catch (Exception $error) {
            return response()->json(
                $error
            );
        }
    }
}
