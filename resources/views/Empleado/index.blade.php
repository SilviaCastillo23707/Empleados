@extends('layouts.app')
@section('content')

<div class="container-fluid pt-2">
  <div class="row ">
    <div class="col-8 p-5">
      <h2>Empleados</h2>
    </div>
    <div class="col-sm-4 text-right p-5">


      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#agregarEmpleadoModal">Agregar
        empleado</button>
    </div>
    <div class="col">
      <table id="tabla" class="table table-striped table-bordered" style="width:100%">
        <caption></caption>

        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Sexo</th>
            <th scope="col">Correo</th>
            <th scope="col">Telefono</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col">Puesto</th>
            <th scope="col">Fecha contratación</th>
            <th scope="col">Dependientes</th>
            <th scope="col">Modificar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($empleados as $empleado)
          <tr>
            <td>
              {{$empleado->id}}
            </td>
            <td>{{$empleado->nombre}} {{$empleado->apellidoPaterno}} {{$empleado->apellidoMaterno}}</td>
            <td>
              @if($empleado->sexo==1)
              Femenino
              @elseif($empleado->sexo==2)
              Masculino
              @else
              Indefinido
              @endif
            </td>
            <td>{{$empleado->correo}}</td>
            <td>{{$empleado->telefono}}</td>


            <td style="text-transform:capitalize">
              @php
              $date = Date::parse($empleado->fechaNacimiento);
              echo $date->format('l d F Y');
              @endphp
            </td>
            <td>{{$empleado->puesto->nombre}}</td>

            <td style="text-transform:capitalize">
              @php
              $date = Date::parse($empleado->fechaContratacion);
              echo $date->format('l d F Y');
              @endphp
            </td>
            <td>
              <a href="/dependiente/{{$empleado->id}}" type="button" class="btn btn-info" >Dependientes</a>
              </td>
            <td>
              <button type="button" class="btn btn-warning" data-toggle="modal"
                data-target="#modificarEmpleadoModal{{$empleado->id}}">Modificar</button>


              <!-- Modal -->
              <div class="modal fade" id="modificarEmpleadoModal{{$empleado->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modificarEmpleadoModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelModal">Modificar empleado</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="RegisterValidation" action="/modificarEmpleado" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="idEmpleado" value="{{$empleado->id}}">

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Nombre
                                *
                              </label>
                              <input class="form-control" name="nombre"  type="text" value="{{$empleado->nombre}}"
                                required="true" />
                            </div>
                            @if($errors->has('nombre'))
                            <span class="help-block text-danger">
                              {{ $errors->first('nombre') }}
                            </span>
                            @endif
                          </div>
                          <div class="col-3">
                            <div class="form-group has-label">
                              <label>
                                Apellido paterno
                                *
                              </label>
                              <input class="form-control" name="apellidoPaterno" value="{{$empleado->apellidoPaterno}}"
                                type="text" required="true" />
                            </div>
                            @if($errors->has('apellidoPaterno'))
                            <span class="help-block text-danger">
                              {{ $errors->first('apellidoPaterno') }}
                            </span>
                            @endif
                          </div>
                          <div class="col-3">
                            <div class="form-group has-label">
                              <label>
                                Apellido materno

                              </label>
                              <input class="form-control" name="apellidoMaterno" value="{{$empleado->apellidoMaterno}}"
                                type="text"  />
                            </div>
                            @if($errors->has('apellidoMaterno'))
                            <span class="help-block text-danger">
                              {{ $errors->first('apellidoMaterno') }}
                            </span>
                            @endif
                          </div>

                        </div>

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Correo
                                *
                              </label>
                              <input class="form-control" name="correo" type="email" value="{{$empleado->correo}}"
                                required="true" />
                            </div>
                            @if($errors->has('correo'))
                            <span class="help-block text-danger">
                              {{ $errors->first('correo') }}
                            </span>
                            @endif
                          </div>
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Telefono
                                *
                              </label>
                              <input class="form-control" name="telefono" type="number" value="{{$empleado->telefono}}"
                                required="true" />
                            </div>
                            @if($errors->has('telefono'))
                            <span class="help-block text-danger">
                              {{ $errors->first('telefono') }}
                            </span>
                            @endif
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Sexo *
                              </label>
                              <select class="form-control" name="sexo" required="true">
                                <option value="3" @if($empleado->sexo == 3) selected @endif>Indefinido</option>
                                <option value="1" @if($empleado->sexo == 1) selected @endif>Femenino</option>
                                <option value="2" @if($empleado->sexo == 2) selected @endif>Masculino</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Fecha de nacimiento *
                              </label>
                              <input class="form-control" name="fechaNacimiento" value="{{$empleado->fechaNacimiento}}"
                                required="true" type="date" />

                              @if($errors->has('fechaNacimiento'))
                              <span class="help-block text-danger">
                                {{ $errors->first('fechaNacimiento') }}
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Puesto *
                              </label>
                              <select class="form-control" name="idPuesto" required="true">
                                <option value="">--</option>

                                @foreach($puestos as $puesto)
                                <option value="{{$puesto->id}}">{{$puesto->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group has-label">
                              <label>
                                Fecha de contratación *
                              </label>
                              <input class="form-control" name="fechaContratacion"  value="{{$empleado->fechaContratacion}}"
                                required="true" type="date" />

                              @if($errors->has('fechaContratacion'))
                              <span class="help-block text-danger">
                                {{ $errors->first('fechaContratacion') }}
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-6"></div>
                          <div class="col-6">
                            <button type="submit" class="col btn btn-primary">Modificar</button>
                          </div>
                       
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="POST" onsubmit="return confirm('Estas seguro que quieres eliminar a {{$empleado->nombre}}')"
                action="/eliminarEmpleado">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$empleado->id}}">
                <button type="submit" class="btn btn-danger" >Eliminar
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="agregarEmpleadoModal"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModal">Agregar empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="RegisterValidation" action="/agregarEmpleado" method="POST">
          {{csrf_field()}}
          <div class="row">
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Nombre
                  *
                </label>
                <input class="form-control" name="nombre" value="{{old('nombre')}}" type="text" required="true" />
              </div>
              @if($errors->has('nombre'))
              <span class="help-block text-danger">
                {{ $errors->first('nombre') }}
              </span>
              @endif
            </div>
            <div class="col-3">
              <div class="form-group has-label">
                <label>
                  Apellido paterno
                  *
                </label>
                <input class="form-control" name="apellidoPaterno" value="{{old('apellidoPaterno')}}" type="text"
                  required="true" />
              </div>
              @if($errors->has('apellidoPaterno'))
              <span class="help-block text-danger">
                {{ $errors->first('apellidoPaterno') }}
              </span>
              @endif
            </div>
            <div class="col-3">
              <div class="form-group has-label">
                <label>
                  Apellido materno

                </label>
                <input class="form-control" name="apellidoMaterno" value="{{old('apellidoMaterno')}}" type="text"
                  />
              </div>
              @if($errors->has('apellidoMaterno'))
              <span class="help-block text-danger">
                {{ $errors->first('apellidoMaterno') }}
              </span>
              @endif
            </div>

          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Correo
                  *
                </label>
                <input class="form-control" name="correo" value="{{old('correo')}}" type="email" required="true" />
              </div>
              @if($errors->has('correo'))
              <span class="help-block text-danger">
                {{ $errors->first('correo') }}
              </span>
              @endif
            </div>
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Telefono
                  *
                </label>
                <input class="form-control" name="telefono" value="{{old('telefono')}}" type="number" required="true" />
              </div>
              @if($errors->has('telefono'))
              <span class="help-block text-danger">
                {{ $errors->first('telefono') }}
              </span>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Sexo *
                </label>
                <select class="form-control" name="sexo" required="true">
                  <option value="3">Indefinido</option>
                  <option value="1">Femenino</option>
                  <option value="2">Masculino</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Fecha de nacimiento *
                </label>
                <input class="form-control" name="fechaNacimiento" value="{{old('fechaNacimiento')}}" required="true"
                  type="date" />

                @if($errors->has('fechaNacimiento'))
                <span class="help-block text-danger">
                  {{ $errors->first('fechaNacimiento') }}
                </span>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Puesto *
                </label>
                <select class="form-control" name="idPuesto" required="true">
                  <option value="">--</option>

                  @foreach($puestos as $puesto)
                  <option value="{{$puesto->id}}">{{$puesto->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group has-label">
                <label>
                  Fecha de contratación *
                </label>
                <input class="form-control" name="fechaContratacion" value="{{old('fechaContratacion')}}"
                  required="true" type="date" />

                @if($errors->has('fechaContratacion'))
                <span class="help-block text-danger">
                  {{ $errors->first('fechaContratacion') }}
                </span>
                @endif
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-6"></div>

            <div class="col-6">
              <button type="submit" class="col btn btn-primary">Agregar</button>
            </div>
           
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
        $('#tabla').DataTable({
            responsive: true
      });
    });


</script>
@endsection