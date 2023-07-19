<?php

use App\Http\Controllers\ConvertionController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PairController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route qui permet au client pour avoir acces au fonctionnalité de l'api
Route::get('/test',function(){
    return response()->json([
        'status'=>'Done',
        'message'=>'Le server que vous utilisez fonctionne parfaitement',
    ]);
});

// Route qui va retourner la list des pairs.
Route::get('/list_pairs',[PairController::class,'index']);

//Route pour ajouter une pair
Route::post('/add_pairs',[PairController::class,'store']);

// Route pour récuperer les informations d'une pair
Route::get('/get_pair/{id}',[PairController::class,'show']);

//Route pour modifier une pair.
Route::post('/udpate_pairs/{id}',[PairController::class,'update']);

//Route pour supprimer une pair.
Route::delete('/delete_pairs/{id}',[PairController::class,'destroy']);

// Route pour le login
Route::post('/login',[UserController::class,'login']);

// Route pour le logout
Route::get('/logout',[UserController::class,'logout']);

// Route pour recuperer les monnaies
Route::get('/list_currency',[CurrencyController::class,'index']);

//Route pour ajouter une Monnaie
Route::post('/add_money',[CurrencyController::class,'store']);


// Route pour récuperer les informations d'une monnaie
Route::get('/get_money/{id}',[CurrencyController::class,'show']);

// //Route pour modifier une pair.
Route::post('/udpate_money/{id}',[CurrencyController::class,'update']);

//Route pour supprimer une Monnaie.
Route::delete('/delete_money/{id}',[CurrencyController::class,'destroy']);

//Route qui nous permettra d'afficher le resultat de la conversion
Route::post('/convert_amount/{id}',[ConvertionController::class,'convert']);

// Route qui me permet de recuperer l'id d'une pair.
Route::post('/getpair_id',[ConvertionController::class,'getPairId']);


