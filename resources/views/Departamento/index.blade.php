@extends('layouts.app')
@section('content')

<div class="container-fluid pt-2">
  <div class="row">
    <div class="col-8 p-5">
      <h2>Departamentos</h2>
    </div>
    <div class="col-4 text-right p-5">


      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#agregarDepartamentoModal">Agregar
        departamento</button>
    </div>
    <div class="col">
      <table id="tabla" class="table table-striped table-bordered" style="width:100%">
        <caption></caption>

        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Dirección</th>
            <th scope="col">Puestos</th>
            <th scope="col">Modificar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($departamentos as $departamento)
          <tr>
            <td>
              {{$departamento->id}}
            </td>
            <td>{{$departamento->nombre}}</td>
            <td>{{$departamento->direccion}}</td>
            <td>
              <a href="/puesto/{{$departamento->id}}" type="button" class="btn btn-info" >Puestos</a>
              </td>
            <td>
              <button type="button" class="btn btn-warning" data-toggle="modal"
                data-target="#modificarDepartamentoModal{{$departamento->id}}">Modificar</button>


              <!-- Modal -->
              <div class="modal fade" id="modificarDepartamentoModal{{$departamento->id}}" tabindex="-1" role="dialog"
                aria-labelledby="modificarDepartamentoModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelModal">Modificar departamento</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="RegisterValidation" action="/modificarDepartamento" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="idDepartamento" value="{{$departamento->id}}">

                        <div class="row">
                          <div class="col">
                            <div class="form-group has-label">
                              <label>
                                Nombre
                                *
                              </label>
                              <input class="form-control" name="nombre"  type="text" value="{{$departamento->nombre}}"
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
                                Dirección *
                              </label>
                              <input class="form-control" name="direccion"  type="text" value="{{$departamento->direccion}}"
                              required="true" />
                              @if($errors->has('direccion'))
                              <span class="help-block text-danger">
                                {{ $errors->first('direccion') }}
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
              <form method="POST" onsubmit="return confirm('Estas seguro que quieres eliminar a {{$departamento->nombre}}')"
                action="/eliminarDepartamento">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$departamento->id}}">
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
<div class="modal fade" id="agregarDepartamentoModal" tabindex="-1" role="dialog" aria-labelledby="agregarDepartamentoModal"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModal">Agregar departamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="RegisterValidation" action="/agregarDepartamento" method="POST">
          {{csrf_field()}}
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
                  Dirección *
                </label>
                <input class="form-control" name="direccion" value="{{old('direccion')}}"
                  required="true" type="text" />

                @if($errors->has('direccion'))
                <span class="help-block text-danger">
                  {{ $errors->first('direccion') }}
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