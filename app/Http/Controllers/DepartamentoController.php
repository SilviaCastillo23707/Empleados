<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Dependiente;
use App\Models\Empleado;
use App\Models\Puesto;
use Carbon\Carbon;
use Session;
use Validator;

class DepartamentoController extends Controller
{
    //Función que manda a la tabla de los departamentos en el sistema
    public function index()
    {
        $departamentos = Departamento::all();
        $puestos = Puesto::all();
       
        return view('Departamento/index')
        ->with('puestos', $puestos)
        ->with('departamentos', $departamentos);
    }
    //Función para eliminar departamentos
    public function eliminar(Request $request){
        $departamento=Departamento::find($request->id);
        $departamento->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El departamento fue eliminado correctamente');

        return redirect('/departamento');
    }
    //Función para agregar departamentos
    public function agregar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'direccion' => ['required', 'string'],
            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/departamento')
                    ->withInput()
                    ->withErrors($validator);
                }

        $departamento=new Departamento;
        $departamento->nombre = $request->nombre ;
        $departamento->direccion = $request->direccion ;
        $departamento->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El departamento fue insertado correctamente');

        return redirect('/departamento');

    }
    //Función para modificar departamentos
    public function modificar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'direccion' => ['required', 'string'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/departamento')
                    ->withInput()
                    ->withErrors($validator);
                }

        $departamento=Departamento::find($request->idDepartamento);
        $departamento->nombre = $request->nombre ;
        $departamento->direccion = $request->direccion ;
        $departamento->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El departamento fue modificado correctamente');

        return redirect('/departamento');

    }
}
