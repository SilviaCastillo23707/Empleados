<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Dependiente;
use App\Models\Departamento;
use App\Models\Puesto;
use Carbon\Carbon;
use Session;
use Validator;

class DependienteController extends Controller
{
    //Función que manda a la tabla de los dependientes de empleados en el sistema
    public function index($id)
    {
        $dependientes = Dependiente::where('idEmpleado', $id)->get();
        $empleado = Empleado::find($id);
       
        return view('Dependiente/index')
        ->with('empleado', $empleado)
        ->with('dependientes', $dependientes);
    }
    //Función para eliminar dependientes
    public function eliminar(Request $request){
        $dependiente=Dependiente::find($request->id);
        $dependiente->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El dependiente fue eliminado correctamente');

        return redirect('/dependiente/'. $request->idEmpleado);
    }
    //Función para agregar dependientes
    public function agregar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'apellidoPaterno' => ['required', 'string'],
                'sexo' => ['required'],
                'telefono' => ['required'],
                'sexo' => ['required'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'fechaNacimiento' => ['required'],
                'idEmpleado' => ['required'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/dependiente/'. $request->idEmpleado)
                    ->withInput()
                    ->withErrors($validator);
                }

        $dependiente=new Dependiente;
        $dependiente->nombre = $request->nombre ;
        $dependiente->apellidoPaterno = $request->apellidoPaterno ;
        if($request->apellidoMaterno)
            $dependiente->apellidoMaterno = $request->apellidoMaterno ;
        $dependiente->sexo = $request->sexo ;
        $dependiente->telefono = $request->telefono ;
        $dependiente->correo = $request->correo ;
        $dependiente->fechaNacimiento = $request->fechaNacimiento ;
        $dependiente->idEmpleado = $request->idEmpleado ;
        $dependiente->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El dependiente fue insertado correctamente');

        return redirect('/dependiente/'. $request->idEmpleado);

    }
    //Función para modificar dependientes
    public function modificar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'apellidoPaterno' => ['required', 'string'],
                'sexo' => ['required'],
                'telefono' => ['required'],
                'sexo' => ['required'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'fechaNacimiento' => ['required'],
                'idEmpleado' => ['required'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/dependiente/'. $request->idEmpleado)
                    ->withInput()
                    ->withErrors($validator);
                }

        $dependiente=Dependiente::find($request->idDependiente);
        $dependiente->nombre = $request->nombre ;
        $dependiente->apellidoPaterno = $request->apellidoPaterno ;
        if($request->apellidoMaterno)
            $dependiente->apellidoMaterno = $request->apellidoMaterno ;
        $dependiente->sexo = $request->sexo ;
        $dependiente->telefono = $request->telefono ;
        $dependiente->correo = $request->correo ;
        $dependiente->fechaNacimiento = $request->fechaNacimiento ;
        $dependiente->idEmpleado = $request->idEmpleado ;
        $dependiente->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El dependiente fue modificado correctamente');

        return redirect('/dependiente/'. $request->idEmpleado);

    }
}
