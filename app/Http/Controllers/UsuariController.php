<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cicle;
use App\Models\Usuari;
use App\Classes\Utilities;
use App\Models\TipusUsuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $query = Usuari::query();
        $tipus_usuaris = TipusUsuari::all();

        if ($request->has('nombre') && $request->has('tipo')) 
        {
            $nombre = $request->input('nombre');
            $tipo = $request->input('tipo');

            if ($tipo === 'all') 
            {
                $query->where('usuaris.nom', 'like', '%' . $nombre . '%');
            } 
            else 
            {
                $query->where('usuaris.nom', 'like', '%' . $nombre . '%')
                    ->where('tipus_usuaris_id', $tipo);
            }
        }

        $usuaris = $query->paginate(7)->withQueryString();;

        $request->flash();

        return view('usuaris.administradors.index', compact('usuaris', 'tipus_usuaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipus_usuaris = TipusUsuari::where('actiu', true)->get();
        $cicles = Cicle::where('actiu', true)->get();

        $cicle = Cicle::find($cicles[0]->id);
        $modules = $cicle->moduls;

        return view('usuaris.administradors.create', compact('tipus_usuaris', 'cicles', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('password') == $request->input('password2')) {
            try {
                DB::beginTransaction();

                $usuari = new Usuari();
                $usuari->nom_usuari = $request->input('username');
                $usuari->correu = $request->input('email');
                $usuari->contrasenya = bcrypt($request->input('password'));
                $usuari->nom = $request->input('name');
                $usuari->cognom = $request->input('surname');
                $usuari->tipus_usuaris_id = intval($request->input('tipusUsuari'));
                $usuari->actiu = $request->input('actiu') == 'on' ? 1 : 0;

                $moduls = $request->input('moduls');

                $usuari->save();

                if ($moduls != null) {
                    foreach ($moduls as $modul) {
                        $usuari->moduls()->attach($modul);
                    }
                }

                DB::commit();
            } catch (QueryException $ex) {
                DB::rollBack();

                $errorCode = Utilities::errorMessage($ex);
                $request->session()->flash('error', $errorCode);
                return redirect()->action([UsuariController::class, 'create'])->withInput();
            }
        } else {
            $request->session()->flash('error', 'Les contrasenyes no coincideixen');
            return redirect()->action([UsuariController::class, 'create'])->withInput();
        }

        $request->session()->flash('mensaje', 'Usuari creat correctament');
        return redirect()->route('usuaris.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuari $usuari)
    {
        $tipus_usuaris = TipusUsuari::where('actiu', true)->get();
        $cicles = Cicle::where('actiu', true)->get();
        $modulsMatriculats = $usuari->moduls;

        //One User only have modules from one cicle in the database that i am using
        if($usuari->moduls->count() == 0)
        {
            $cicleUsuari = Cicle::find($cicles[0]->id);
            $modules = $cicleUsuari->moduls;
        }
        else
        {
            $modul = $usuari->moduls[0];
            $cicleUsuari = Cicle::find($modul->cicles_id);
            $modules = $cicleUsuari->moduls;
        }

        return view('usuaris.administradors.create', compact('usuari', 'tipus_usuaris', 'cicles','modules', 'cicleUsuari', 'modulsMatriculats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {
        try {
            DB::beginTransaction();

            $usuari->nom_usuari = $request->input('username');
            $usuari->correu = $request->input('email');
            $usuari->nom = $request->input('name');
            $usuari->cognom = $request->input('surname');
            $usuari->tipus_usuaris_id = intval($request->input('tipusUsuari'));
            $usuari->actiu = $request->input('actiu') == 'on' ? 1 : 0;

            $moduls = $request->input('moduls');

            $usuari->save();

            if ($moduls != null) {
                $usuari->moduls()->detach();
                foreach ($moduls as $modul) {
                    $usuari->moduls()->attach($modul);
                }
            }

            DB::commit();

            $request->session()->flash('mensaje', 'Usuari modificat correctament');
            return redirect()->route('usuaris.index');
        } catch (QueryException $ex) {
            DB::rollBack();

            $errorCode = Utilities::errorMessage($ex);
            $request->session()->flash('error', $errorCode);
            return redirect()->route('usuaris.edit', ['usuari' => $usuari->id])->withInput();
        }
    
}

    public function editPassword(Usuari $usuari){

        return view('usuaris.administradors.password', compact('usuari'));
    }

    public function updatePassword(Request $request, Usuari $usuari)
    {
        if ($request->input('confirm_password') == $request->input('new_password')) {
            if(password_verify($request->input('old_password'), $usuari->contrasenya)){
                try {
                    $usuari->contrasenya = bcrypt($request->input('password'));
                    $usuari->save();
                } catch (QueryException $ex) {
                    $errorCode = Utilities::errorMessage($ex);
                    $request->session()->flash('error', $errorCode);
                    return redirect()->route('usuaris.editPassword', ['usuari' => $usuari->id])->withInput();
                }
            } else {
                $request->session()->flash('error', 'La contrasenya antiga no és correcta');
                return redirect()->route('usuaris.editPassword', ['usuari' => $usuari->id])->withInput();
            }
        } else {
            $request->session()->flash('error', 'Les contrasenyes no coincideixen');
            return redirect()->route('usuaris.editPassword', ['usuari' => $usuari->id])->withInput();
        }

        $request->session()->flash('mensaje', 'Contrasenya modificada correctament');
        return redirect()->route('usuaris.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Usuari $usuari)
    {
        try 
        {
            $usuari->delete();  
            $request-> session()->flash('mensaje', 'Usuari eliminat correctament');
        } 
        catch (QueryException $ex) 
        {
            $mensaje = Utilities::errorMessage($ex) . ' - L\'usuari es posara en inactiu';
            $usuari->actiu = 0;
            $usuari->save();
            $request-> session()->flash('error', $mensaje);
            return redirect()->route('usuaris.index');
        }
        
        return redirect()->route('usuaris.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $usuari = Usuari::where('correu', $username)->first();

        if ($usuari != null) {
            if (Hash::check($password, $usuari->contrasenya)) {
                Auth::login($usuari);
                $tokenResult = $usuari->createToken('appToken');

                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                
                $value = $tokenResult->accessToken;
                $minutes = 60; 
                $cookie = Cookie::make('access_token', $value, $minutes);
                
                return redirect()->route('index')->withCookie($cookie);
            }
            else {
                throw ValidationException::withMessages([
                    'password' => ['La contrasenya es incorrecte.'],
                ]);
            
            }
        }

        throw ValidationException::withMessages([
            'username' => ['L\'usuari no existeix.'],
        ]);
    }

    public function autoavaluacio(Request $request)
    {
        $cookie = request()->cookie('access_token');
        return view('usuaris.alumnes.autoavaluacio');
    }
}
