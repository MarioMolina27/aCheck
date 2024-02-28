<?php
namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Usuari;
use App\Classes\Utilities;
use Illuminate\Http\Request;
use App\Models\CriteriAvaluacio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{

    public function signUp(Request $request)
    {
        $request->validate([
            'nom_usuari' => 'required|unique:usuaris',
            'contrasenya' => 'required',
            'correu' => 'required|email|unique:usuaris',
            'nom' => 'required',
            'cognom' => 'required',
            'tipus_usuaris_id' => 'required|exists:tipus_usuaris,id',
        ]);

        $usuari = Usuari::create([
            'nom_usuari' => $request->nom_usuari,
            'contrasenya' => Hash::make($request->contrasenya),
            'correu' => $request->correu,
            'nom' => $request->nom,
            'cognom' => $request->cognom,
            'actiu' => 1,
            'tipus_usuaris_id' => $request->tipus_usuaris_id,
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'usuari' => $usuari,
        ], 201);
    }
   
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'correu' => 'required|email',
            'contrasenya' => 'required',
            'remember_me' => 'boolean'
        ]);

        $correu = $request->correu;
        $password = $request->contrasenya;

        $usuari = Usuari::where('correu', $correu)->first();

        if ($usuari != null) {
            if (Hash::check($password, $usuari->contrasenya)) {
                Auth::login($usuari);
            }
            else
            {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }
        }
        else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $usuari->createToken('appToken');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}