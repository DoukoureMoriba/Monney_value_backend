<?php

namespace App\Http\Controllers;

use App\Models\Pair;
use Exception;
use Illuminate\Http\Request;

class ConvertionController extends Controller
{
    public function convert(Request $request, $id)
    {
        try {
            $request->validate([
                'amount' => 'required',
            ]);
            // Nous cherchons l'id de la pair en question a convertir
            $pair = Pair::findOrfail($id);


            $conversion_rates = $pair->conversion_rates;
            $value_amount = $request->amount;
            $count = $pair->count;//On recupere la valeur du compteur de la pair
            $amount = '';

            // On effectue une opération de value_amount * conversion_rates
            $amount = $value_amount * $conversion_rates;

            // On incrémente le compteur de la pair {id} sélectionnée
            $count++;
            $pair->count = $count;//On actualise mla valeur du compteur de la pair

            // Enregistrez la mise à jour dans la base de données
            $pair->save();
            return response()->json([
                'status' => 'Done',
                'message' => 'Conversion effectuer avec succes',
                'data' => $amount,
            ]);
        } catch (Exception $error) {
            return response()->json(
                $error
            );
        }
    }

    public function getPairId(Request $request){

        try {
            $request->validate([
                'id_sources' => 'required',
                'id_target' => 'required',
            ]);

             // Récupérer les valeurs d'id_sources et id_target depuis la requête
        $id_sources = $request->id_sources;
        $id_target = $request->id_target;

        // Recherchons l'enregistrement dans la base de données
        $pair = Pair::where('id_sources', $id_sources)
            ->where('id_target', $id_target)
            ->first();

        // Vérification si l'enregistrement a été trouvé
        if ($pair) {
            // L'enregistrement a été trouvé on accede à ses propriétés
            // par exemple, $pair->id_sources, $pair->id_target, $pair->conversion_rates, etc.
            return response()->json([
                'status' => 'Done',
                'message' => 'Enregistrement trouvé avec succès',
                'data' => $pair->id,
            ]);
        } else {
            // Aucun enregistrement trouvé
            return response()->json([
                'status' => 'Error',
                'message' => 'Aucun enregistrement trouvé pour les id_sources et id_target donnés.',
            ]);
        }

        } catch (Exception $error) {
            return response()->json(
                $error
            );
        }
    }
}
