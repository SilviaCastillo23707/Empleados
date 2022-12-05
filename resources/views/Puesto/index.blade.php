@extends('layouts.app')
@section('content')

<div class="container-fluid pt-2">
  <div class="row">
    <div class="col-8 p-5">
      <h2>Puestos de "{{$departamento->nombre}}"</h2>
    </div>
    <div class="col-sm-4 text-right p-5">


      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#agregarPuestoModal">Agregar
        puesto</button>
    </div>
    <div class="col">
      <table id="tabla" class="table table-striped table-bordered" style="width:100%">
        <caption></caption>

        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Salario</th>
            <th scope="col">Modificar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($puestos as $puesto)
          <tr>
            <td>
              {{$puesto->id}}
            </td>
            <td>{{$puesto->nombre}}</td>
            <td>${{$puesto->salario}}</td>
            <td>
              <button type="button" class="btn btn-warning" data-toggle="modal"
                data-target="#modificarPuestoModal{{$puesto->id}}">Modificar</button>


              <!-- Modal -->
              <div class="modal fade" id="modificarPuestoModal{{$puesto->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modificarPuestoModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelModal">Modificar puesto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="RegisterValidation" action="/modificarPuesto" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="idPuesto" value="{{$puesto->id}}">
                        <input type="hidden" name="idDepartamento" value="{{$departamento->id}}">

                        <div class="row">
                          <div class="col">
                            <div class="form-group has-label">
                              <label>
                                Nombre
                                *
                              </label>
                              <input class="form-control" name="nombre"  type="text" value="{{$puesto->nombre}}"
                                required="true" />
                            </div>
                            @if($errors->has('nombre'))
                            <span class="help-block text-danger">
                              {{ $errors->first('nombre') }}
                            </span>
                            @endif
                          </div>
                          
                         

                        </div>

                        <div class="row">
                         
                          <div class="col">
                            <div class="form-group has-label">
                              <label>
                                Salario *
                              </label>
                              <input class="form-control" name="salario"  type="number" value="{{$puesto->salario}}"
                              required="true" />
                              @if($errors->has('salario'))
                              <span class="help-block text-danger">
                                {{ $errors->first('salario') }}
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
              <form method="POST" onsubmit="return confirm('Estas seguro que quieres eliminar a {{$puesto->nombre}}')"
                action="/eliminarPuesto">
                {{csrf_field()}}
                <input type="hidden" name="idDepartamento" value="{{$departamento->id}}">

                <input type="hidden" name="id" value="{{$puesto->id}}">
                <button type="submit" class="btn btn-danger">Eliminar
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
<div class="modal fade" id="agregarPuestoModal" tabindex="-1" role="dialog" aria-labelledby="agregarPuestoModal"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModal">Agregar puesto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="RegisterValidation" action="/agregarPuesto" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="idDepartamento" value="{{$departamento->id}}">

          <div class="row">
            <div class="col">
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
            

          </div>

          <div class="row">
          
            <div class="col">
              <div class="form-group has-label">
                <label>
                  Salario *
                </label>
                <input class="form-control" name="salario" value="{{old('salario')}}"
                  required="true" type="number" />

                @if($errors->has('salario'))
                <span class="help-block text-danger">
                  {{ $errors->first('salario') }}
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