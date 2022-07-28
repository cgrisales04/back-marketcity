<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Funcion que ejecuta un SP
     * insertando el registro si este cumple
     * con las condiciones
     * @param ParametrosHTTP 
     */
    public function insertarUsuario(Request $request)
    {
        #Construimos las validaciones a cada uno de los campos recibidos en el POST
        $userValidator = Validator::make($request->all(), [
            'PRIMER_NOMBRE' => 'required',
            'SEGUNDO_NOMBRE',
            'PRIMER_APELLIDO' => 'required',
            'SEGUNDO_APELLIDO' => 'required',
            'IDENTIFICACION' => 'required|max:11',
            'TELEFONO_FIJO' => 'max:8',
            'TELEFONO_CELULAR' => 'max:12',
            'ID_GENERO_FK' => 'required',
            'ID_TIPO_IDENTIFICACION_FK' => 'required',
            'ID_TIPO_USUARIO_FK' => 'required',
        ]);

        #Si los campos estan llenos como corresponde
        if (!$userValidator->fails()) {
            #Ejecutamos el SP con sus respectivos parametros
            $result = DB::executeProcedure("SP_INSERTAR_USUARIO", [
                $request['PRIMER_NOMBRE'],
                $request['SEGUNDO_NOMBRE'],
                $request['PRIMER_APELLIDO'],
                $request['SEGUNDO_APELLIDO'],
                $request['IDENTIFICACION'],
                $request['TELEFONO_FIJO'],
                $request['TELEFONO_CELULAR'],
                $request['ID_GENERO_FK'],
                $request['ID_TIPO_IDENTIFICACION_FK'],
                $request['ID_TIPO_USUARIO_FK']
            ]);
            #Si el SP se ejecuto
            if ($result) {
                #Devolvemos una respuesta satisfactoria
                return response()->json([
                    'status' => 1,
                    'message' => "¡Se ha insertado el usuario con exito!"
                ]);
            }
            #Si hay inconvenientes con los campos 
        } else {
            #Mostramos los inconvenientes
            return response()->json([
                'status' => 0,
                'errors' => $userValidator->messages()
            ]);
        }
    }

    /**
     * Funcion que ejecuta un SP
     * editando el registro si este cumple
     * con las condiciones
     * @param ParametrosHTTP 
     */
    public function editarUsuario(Request $request)
    {
        $userValidator = Validator::make(
            $request->all(),
            [
                'ID_USUARIO' => 'required',
                'PRIMER_NOMBRE' => 'required',
                'SEGUNDO_NOMBRE',
                'PRIMER_APELLIDO' => 'required',
                'SEGUNDO_APELLIDO' => 'required',
                'IDENTIFICACION' => 'required|max:11',
                'TELEFONO_FIJO' => 'max:8',
                'TELEFONO_CELULAR' => 'max:12',
                'ID_GENERO_FK' => 'required',
                'ID_TIPO_IDENTIFICACION_FK' => 'required',
                'ID_TIPO_USUARIO_FK' => 'required',
            ]
        );
        #Si los campos estan llenos como corresponde
        if (!$userValidator->fails()) {
            #Buscamos el usuario que vamos a editar
            $searchUser = Usuario::where('ID_USUARIO', $request['ID_USUARIO'])->first();

            if ($searchUser) {
                #Ejecutamos el SP con sus respectivos parametros
                $result = DB::executeProcedure("SP_EDITAR_USUARIO", [
                    $request['ID_USUARIO'],
                    $request['PRIMER_NOMBRE'],
                    $request['SEGUNDO_NOMBRE'],
                    $request['PRIMER_APELLIDO'],
                    $request['SEGUNDO_APELLIDO'],
                    $request['IDENTIFICACION'],
                    $request['TELEFONO_FIJO'],
                    $request['TELEFONO_CELULAR'],
                    $request['ID_GENERO_FK'],
                    $request['ID_TIPO_IDENTIFICACION_FK'],
                    $request['ID_TIPO_USUARIO_FK']
                ]);
                #Si el SP se ejecuto
                if ($result) {
                    #Devolvemos una respuesta satisfactoria
                    return response()->json([
                        'status' => 1,
                        'message' => "¡Se ha actualizado el usuario con exito!"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Usuario aún no registrado en el sistema.'
                ]);
            }

            #Si hay inconvenientes con los campos 
        } else {
            #Mostramos los inconvenientes
            return response()->json([
                'status' => 0,
                'errors' => $userValidator->messages()
            ]);
        }
    }

    /**
     * Funcion que ejecuta un SP
     * eliminando el registro si este cumple
     * con las condiciones
     * @param ParametrosHTTP 
     */
    public function eliminarUsuario(Request $request)
    {
        $userValidator = Validator::make(
            $request->all(),
            [
                'ID_USUARIO' => 'required'
            ]
        );
        #Si los campos estan llenos como corresponde
        if (!$userValidator->fails()) {
            #Buscamos el usuario que vamos a eliminar
            $searchUser = Usuario::where('ID_USUARIO', $request['ID_USUARIO'])->first();

            if ($searchUser) {
                #Ejecutamos el SP con sus respectivos parametros
                $result = DB::executeProcedure("SP_ELIMINAR_USUARIO", [
                    $request['ID_USUARIO']
                ]);

                #Si el SP se ejecuto
                if ($result) {
                    #Devolvemos una respuesta satisfactoria
                    return response()->json([
                        'status' => 1,
                        'message' => "¡Se ha eliminado el usuario con exito!"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Usuario aún no registrado en el sistema.'
                ]);
            }

            #Si hay inconvenientes con los campos 
        } else {
            #Mostramos los inconvenientes
            return response()->json([
                'status' => 0,
                'errors' => $userValidator->messages()
            ]);
        }
    }


    /**
     * Funcion que obtiene un usuario
     * eliminando el registro si este cumple
     * con las condiciones
     * @param ParametrosHTTP 
     */
    public function obtenerUsuario(Request $request)
    {
        $userValidator = Validator::make(
            $request->all(),
            [
                'ID_USUARIO' => 'required'
            ]
        );
        #Si los campos estan llenos como corresponde
        if (!$userValidator->fails()) {
            #Buscamos el usuario que vamos a seleccionar
            $searchUser = Usuario::where('ID_USUARIO', $request['ID_USUARIO'])->first();

            if ($searchUser) {
                #Devolvemos una respuesta satisfactoria
                return response()->json([
                    'status' => 1,
                    'message' => "¡Se ha obtenido el usuario con exito!",
                    'usuario' => $searchUser
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Usuario aún no registrado en el sistema.'
                ]);
            }

            #Si hay inconvenientes con los campos 
        } else {
            #Mostramos los inconvenientes
            return response()->json([
                'status' => 0,
                'errors' => $userValidator->messages()
            ]);
        }
    }

    public function mostrarUsuarios()
    {
        $usuarios = Usuario::all();
        return response()->json([
            'status' => 1,
            'usuarios' => $usuarios
        ]);
    }
}
