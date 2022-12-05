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

class EmpleadoController extends Controller
{
    //Función que manda a la tabla de los empleados en el sistema
    public function index()
    {
        $empleados = Empleado::all();
        $puestos = Puesto::all();
       
        return view('Empleado/index')
        ->with('puestos', $puestos)
        ->with('empleados', $empleados);
    }
    //Función para eliminar empleados
    public function eliminar(Request $request){
        $empleado=Empleado::find($request->id);
        $empleado->delete();
        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El empleado fue eliminado correctamente');

        return redirect('/');
    }
    //Función para agregar empleados
    public function agregar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'apellidoPaterno' => ['required', 'string'],
                'sexo' => ['required'],
                'telefono' => ['required'],
                'sexo' => ['required'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'fechaNacimiento' => ['required'],
                'fechaContratacion' => ['required'],
                'idPuesto' => ['required'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
                }

        $empleado=new Empleado;
        $empleado->nombre = $request->nombre ;
        $empleado->apellidoPaterno = $request->apellidoPaterno ;
        if($request->apellidoMaterno)
            $empleado->apellidoMaterno = $request->apellidoMaterno ;
        $empleado->sexo = $request->sexo ;
        $empleado->telefono = $request->telefono ;
        $empleado->correo = $request->correo ;
        $empleado->fechaNacimiento = $request->fechaNacimiento ;
        $empleado->fechaContratacion = $request->fechaContratacion ;
        $empleado->idPuesto = $request->idPuesto ;
        $empleado->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El empleado fue insertado correctamente');

        return redirect('/');

    }
    //Función para modificar empleados
    public function modificar(Request $request){
        $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string'],
                'apellidoPaterno' => ['required', 'string'],
                'sexo' => ['required'],
                'telefono' => ['required'],
                'sexo' => ['required'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'fechaNacimiento' => ['required'],
                'fechaContratacion' => ['required'],
                'idPuesto' => ['required'],

            ]);
            
            if ($validator->fails()) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('mensaje', '¡Hubo un error! Favor de revisar los campos');
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
                }

        $empleado=Empleado::find($request->idEmpleado);
        $empleado->nombre = $request->nombre ;
        $empleado->apellidoPaterno = $request->apellidoPaterno ;
        if($request->apellidoMaterno)
            $empleado->apellidoMaterno = $request->apellidoMaterno ;
        $empleado->sexo = $request->sexo ;
        $empleado->telefono = $request->telefono ;
        $empleado->correo = $request->correo ;
        $empleado->fechaNacimiento = $request->fechaNacimiento ;
        $empleado->fechaContratacion = $request->fechaContratacion ;
        $empleado->idPuesto = $request->idPuesto ;
        $empleado->save();


        Session::flash('alert-class', 'alert-success');
        Session::flash('mensaje', 'El empleado fue modificado correctamente');

        return redirect('/');

    }
}
