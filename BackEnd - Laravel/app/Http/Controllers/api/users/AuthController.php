<?php

namespace App\Http\Controllers\api\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login','register']]);
    }


    public function register(Request $request){

        $request->validate([
            'document_id' => ['required'],
            'documento'=> ['required'],
            'nombres'=> ['required'],
            'primer_apellido'=> ['required'],
            'segundo_apellido' => ['required'],
            'email'=> ['required','email'],
            'telefono'=> ['required'],
            'password'=> ['required','confirmed','min:8'],
            'gender_id'=> ['required'],
            'role_id'=> ['required']
        ]);

        $state = User::create([
            'document_id' => $request->document_id,
            'documento' => $request->documento,
            'nombres' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => $request->password,
            'gender_id' => $request->gender_id,
            'role_id' => $request->role_id
        ]);

        if($state){

            return response()->json([
                'state' => 200,
                'msg' => 'Usuario registrado'
            ]);

        }else{

            return response()->json([
                'state' => 401,
                'msg' => 'No es posible registrar el usuario'
            ]);

        }

    }

    public function login(Request $request){

        $request->validate([
            'email' => ['required','email'],
            'password' => ['required','min:8']
        ]);

        $user = User::where('email',$request->email)->first();

        if(isset($user->id)){

            if(Hash::check($user->password,$request->password)){

                $token = $user->createToken('auth_token')->plainTextToken;
                Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                return response()->json([
                    'status' => 200,
                    'msg' => 'Logeo completo',
                    'Authorization' => 'Bearer ' . $token,
                    'access_token' => $token
                ]);

            }else{
                return response()->json([
                    'status' => 401,
                    'msg' => 'La contraseña no es correcta'
                ]);
            }

        }else{

            return response()->json([
                'state' => 401,
                'msg' => 'El email no se encuentra registrado'
            ]);

        }


    }

    public function profile(){

        return response()->json([
            'state' => 200,
            'data' => auth()->user()
        ]);

    }

    public function logout(){

        $state = auth::user()->tokens()->delete();

        if($state){
            return response()->json([
                'status' => 200,
                'msg' => 'Sesion cerrada con exito'
            ]);
    
        }else{
            return response()->json([
                'status' => 401,
                'msg' => 'Actualmente no es posible cerrar la sesion'
            ]);
    
        }

    }

}
