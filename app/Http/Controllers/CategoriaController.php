<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function getCategoria(){
        //trae todos los datos de Categorias definidas en el modelo
        $categorias = Categoria::all();

        $data = [
            'code' => 200,
            'status' => 'success',
            'Categorias' => $categorias
        ];

        //return response()->json(Categoria::all(), 200);
        return response()->json($data, $data['code']);
    }

    public function getCategoriaId($id){
        $categoria = Categoria::find($id);
        if (is_object($categoria)){
            $data = [
                'code' => '200',
                'status' => 'success',
                'Categoria' => $categoria
            ];
        }else{
            $data = [
                'code' => '404',
                'status' => 'error',
                'mensaje' => 'No se encontro la categoria'
            ];
        }

       return response()->json($data, $data['code']);

    }

    public function addCategoria(Request $request){
        //Crear una categoria sin validacion
        //$categoria = categoria::create($request->all());
       
        //Crear una Categoria Validando que exista el nombre
        
        //1 - Recoger los datos enviados
        //$json = $request->input('json', null);
        $parametros_array = $request->all();
        //$parametros_array = json_decode($json, true);

        // 2- Validamos los datos
        // Verificamos que no venga vacio el array
        if (!empty($parametros_array)){
            //validamos el nombre
            $validacion = \Validator::make($parametros_array,[
                'cat_nombre' => 'required',
                'cat_detalle' => 'required'
            ]);

            //Guardamos la categoria sino hay fallos

            if($validacion->fails()){
                $data = [
                    'code' => '404',
                    'status' => 'error',
                    'mensaje' => 'Hubo un error en los datos enviados, favor verificar'
                ];
            }else{
                $nueva_categoria = new Categoria();
                $nueva_categoria->cat_nombre = $parametros_array['cat_nombre'];
                $nueva_categoria->cat_detalle = $parametros_array['cat_detalle'];
                $nueva_categoria->save();

                $data = [
                    'code' => '200',
                    'status' => 'success',
                    'Nueva categoria' => $nueva_categoria
                ];

            }
        }else{
            $data = [
                'code' => '404',
                'status' => 'error',
                'mensaje' => 'Favor verificar datos enviados <<Datos Vacios>>'
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function updateCategoria($id, Request $request){
        //Buscamos el id si existe procedemos
        $categoria = Categoria::find($id);

        if (!is_object($categoria)){
            $data = [
                'code' => '404',
                'status' => 'error',
                'mensaje' => 'No se encontro la categoria para Actualizar'
            ];

        }else{
            //se puede actualizar todo de una ves
            //$categoria->update($request->all());

            //validamos que llegue un dato correto
            $parametros_array = $request->all();
            
            if (!empty($parametros_array)){
                 //validamos el nombre
                    $validacion = \Validator::make($parametros_array,[
                        'cat_nombre' => 'required',
                        'cat_detalle' => 'required'
                    ]);

                    //verificamos que no halla fallos
                    if($validacion->fails()){
                        $data = [
                            'code' => '404',
                            'status' => 'error',
                            'mensaje' => 'Hubo un error en los datos enviados, favor verificar'
                        ];
                    }else{
                       //Quitar lo que no quiera actualizar
                        unset($parametros_array['id']);
                        
                        //Actualizar el registro en categoria
                        $categoria_vieja = $categoria;
                        $categoria = Categoria::where('id', $id)->update($parametros_array);
                        
                        $data = [
                                'code' => 200,
                                'status' => 'success',
                                'categoria anterior' => $categoria_vieja,
                                'categoria actualizada' => $parametros_array
                            ];

                    }



            }else{
                $data = [
                    'code' => '404',
                    'status' => 'error',
                    'mensaje' => 'Favor verificar datos enviados <<Datos Vacios>>'
                ];
            }
    
            
        }
        
        return response()->json($data, $data['code']);
    }
}
