<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //Fonction qui va permettre a l'administrateur de se connecter
    public function login(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        //Variable pour récuperer le email et le mot de passe
        $credentials = $request->only(['email','password',]);
        if (Auth::attempt($credentials)) {
            $authUser = Auth::user();
            if ($authUser->role=='admin') {
                return response()->json([
                    'status'=>'Done',
                    'message'=>'Vous etes connecter en tant qu\'administrateur',
                ]);
            }
        } else{
            return response()->json([
                'status'=>'Done',
                'message'=>'Impossible de vous connecter',
            ]);
      
        }
    }



    // Fonction pour déconnecter l'administrateur par ID
    public function logout(Request $request)
    {
        $userId = 1; // ID de l'utilisateur administrateur

        $user = User::find($userId);

        if ($user && $user->role == 'admin') {
            Auth::logoutOtherDevices($request->password);//Déconnexion de l'utilisateur des autres appareils en utilisant le mot de passe fourni dans la requête

            return response()->json([
                'status' => 'Done',
                'message' => 'Vous avez été déconnecté en tant qu\'administrateur.',
            ]);
        }

    
    }



}




