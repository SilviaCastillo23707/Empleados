<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Dependiente;
use App\Models\Puesto;
use App\Models\Departamento;
use Carbon\Carbon;
use Session;
use Validator;

class PuestoController extends Controller
{
    //Función que manda a la tabla de los puestos en el sistema
    public function index($id)
    {
        $puestos = Puesto::where('idDepartamento', $id)->get();
        $departamento = Departamento::find($id);
       
        return view('Puesto/index')
        ->with('departamento', $departamento)
        ->with('puestos', $puestos);
    }
    //Función para eliminar puestos
    public function eliminar(Request $request){
        $puesto=Puesto::find($request->id);
        $puesto->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El puesto fue eliminado correctamente');

        return redirect('/puesto/'. $request->idDepartamento);
    }
    //Función para agregar puestos
    public function agregar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'salario' => ['required', 'string'],
            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/puesto/'. $request->idDepartamento)
                    ->withInput()
                    ->withErrors($validator);
                }

        $puesto=new Puesto;
        $puesto->nombre = $request->nombre ;
        $puesto->salario = $request->salario ;
        $puesto->idDepartamento = $request->idDepartamento ;
        $puesto->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El puesto fue insertado correctamente');

        return redirect('/puesto/'. $request->idDepartamento);

    }
    //Función para modificar puestos
    public function modificar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'salario' => ['required', 'string'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/puesto/'. $request->idDepartamento)
                    ->withInput()
                    ->withErrors($validator);
                }

        $puesto=Puesto::find($request->idPuesto);
        $puesto->nombre = $request->nombre ;
        $puesto->salario = $request->salario ;
        $puesto->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El puesto fue modificado correctamente');

        return redirect('/puesto/'. $request->idDepartamento);

    }
}
