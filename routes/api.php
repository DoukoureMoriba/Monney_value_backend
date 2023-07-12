<?php

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

//Route pour ajouter une modifier une pair.
Route::post('/udpate_pairs/{id}',[PairController::class,'update']);

//Route pour supprimer une pair.
Route::delete('/delete_pairs/{id}',[PairController::class,'destroy']);

// Route pour le login
Route::post('/login',[UserController::class,'login']);



// Route pour le logout
Route::post('/logout',[UserController::class,'logout']);