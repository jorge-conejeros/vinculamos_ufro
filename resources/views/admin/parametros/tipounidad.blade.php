{{--
TEMPLATE PARA VISTA PARAMETROS:

(Seleccionar, ctrl + F2 y cregistroar por el nombre deseado)
______________________________________________________________________________________________
NOMBRE DEL PARAMETRO (plural, primera letra mayuscula): Tipo de Unidades
NOMBRE DEL PARAMETRO (singular): TipoUnidad
______________________________________________________________________________________________
NOMBRE DE LA RUTA (ej: admin.listar.NOMBRE, en plural): tipounidad
______________________________________________________________________________________________
ARREGLAR SINTAXIS (Seleccionar toda la linea y arreglar tras el ctrl + F2):
______________________________________________
Nuevo Tipo de Unidad
Nombre del Tipo de Unidad
El Tipo de Unidad dejará de existir
Tipo de Unidad actualizado
Tipo de Unidad creado exitosamente
El Tipo de Unidad fue eliminado
El Tipo de Unidad no se encuentra registrado
______________________________________________
______________________________________________________________________________________________
NOMBRE DEL PREFIJO DE LA TABLA (ej: NOMBRE_codigo, recuerda agregar el "_"): tuni_
______________________________________________________________________________________________
______________________________________________________________________________________________

RECUERDA AGREGAR A PANEL CON SU RESPECTIVA RUTA (href) Y ARREGLAR EL CONTROLLER

--}}


@extends('admin.panel')

@section('contenido')
    <section class="section" style="font-size: 115%;">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            @if (
                                $errors->has('nombre')
                                )
                            <div class="alert alert-warning alert-dismissible show fade mb-4 text-center">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    @if ($errors->has('nombre'))
                                        <strong>{{ $errors->first('nombre') }}</strong><br>
                                    @endif

                                </div>
                            </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('error') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                            @if (Session::has('exito'))
                                <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('exito') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3"></div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Listado de tipo de unidades</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalCrearregistro"><i class="fas fa-plus"></i> Nuevo Tipo de Unidad</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1" style="font-size: 110%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            {{-- <th> idcampo1  </th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 0; ?>
                                        @foreach ($REGISTROS as $registro)
                                            <?php $contador = $contador + 1; ?>
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>{{ $registro->tuni_nombre }}</td>
                                                {{-- <td> {{ $registro->tuni_idcampo1 }} </td> --}}
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-warning"
                                                        onclick="editarRegistro({{ $registro->tuni_codigo }})" data-toggle="tooltip"
                                                        data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-danger"
                                                        onclick="eliminarRegistro({{ $registro->tuni_codigo }})"
                                                        data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($REGISTROS as $registro)
        <div class="modal fade" id="modaleditarRegistro-{{ $registro->tuni_codigo }}" tabindex="-1" role="dialog"
            aria-labelledby="modaleditarRegistro" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaleditarRegistroto">Editar tipo de unidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.actualizar.tipounidad', $registro->tuni_codigo) }} " method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label>Nombre del Tipo de Unidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ $registro->tuni_nombre }}" autocomplete="off">
                                    @if ($errors->has('nombre'))
                                        <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                            style="width:100%">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- CAMPO TEMPLATE PARA COPIAR Y PEGAR (es en texto, asi que cambiar segun necesidad) --}}
                            {{--
                            <div class="form-group">
                                <label>CAMPO1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-pen-nib"></i> ICONO
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="idcampo1" name="idcampo1"
                                        value="{{ $registro->tuni_idcampo1 }}" autocomplete="off">
                                    @if ($errors->has('nombre'))
                                        <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                            style="width:100%">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            EN CASO DE NECESITAR UN SELECT DE OTRA TABLA
                            _________________________________________________________
                            PREFIJO DE LA COLUMNA JOIN (agregar "_"): prefijojoin_
                            _________________________________________________________

                            <select class="form-control" id="select_join" name="select_join">
                                    @foreach ($REGISTROS2 as $dato)
                                        <option value="{{ $dato->prefijojoin_codigo }}" {{ $registro->prefijojoin_codigo == $dato->prefijojoin_codigo ? 'selected' : '' }}>
                                            {{ $dato->prefijojoin_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary waves-effect">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="modalCrearregistro" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Nuevo Tipo de Unidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.crear.tipounidad') }} " method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nombre del Tipo de Unidad</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i>  {{-- ICONO --}}
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="" autocomplete="off" value="{{ old('care_nombre') }}">
                                @if ($errors->has('nombre'))
                                    <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                        style="width:100%">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- CAMPO TEMPLATE PARA COPIAR Y PEGAR (es en texto, asi que cambiar segun necesidad) --}}
                        {{--
                        <div class="form-group">
                            <label>CAMPO1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i>  ICONO
                                    </div>
                                </div>
                                <input type="text" class="form-control @error('idcampo1') is-invalid @enderror" id="idcampo1" name="idcampo1"
                                    placeholder="" autocomplete="off" value="{{ old('idcampo1') }}">
                                @error('idcampo1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        EN CASO DE NECESITAR UN SELECT DE OTRA TABLA (va en vez del input)
                        _________________________________________________________
                        PREFIJO DE LA COLUMNA JOIN (agregar "_"): prefijojoin_
                        _________________________________________________________
                        <select class="form-control" id="select_join" name="select_join">
                                @foreach ($REGISTROS2 as $dato)
                                    <option value="{{ $dato->prefijojoin_codigo }}" {{ $registro->prefijojoin_codigo == $dato->prefijojoin_codigo ? 'selected' : '' }}>
                                        {{ $dato->prefijojoin_nombre }}
                                    </option>
                                @endforeach
                            </select>
                        --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminaRegistro" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.eliminar.tipounidad') }} " method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminar">Eliminar TipoUnidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                        <h6 class="mt-2">El Tipo de Unidad dejará de existir dentro del sistema. <br> ¿Desea continuar de todos
                            modos?</h6>
                        <input type="hidden" id="tuni_codigo" name="tuni_codigo" value="">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function eliminarRegistro(tuni_codigo) {
            $('#tuni_codigo').val(tuni_codigo);
            $('#modalEliminaRegistro').modal('show');
        }

        function editarRegistro(tuni_codigo) {
            $('#modaleditarRegistro-' + tuni_codigo).modal('show');
        }
    </script>
@endsection
