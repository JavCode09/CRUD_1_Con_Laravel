
@extends('layouts.app')<!--Herdesamos de la plantilla creada  app de la carpeta layout se creo con la 
                        terminal a la hora de crear el login -->

@section('content_layout_app')<!--Agregamos la plantilla con bootstrap del login-->

    <div class="container"> <!--Inportante saber que se agrego el div que tenia toda la plantilla
                             de app con bootstrap para que tubiera el diseño
                            el div hay que cerrarlo-->

        <!--Este if es para que aparesca un mensaje mandado por los
        Metodos de los controladores, puede ser de Insertar, Editar, Eliminar etc..
        Si la veriable Mensaje tiene alfo imprimelo-->
            @if (Session::has('Mensaje'))
                
            <div class="alert alert-success">
                {{Session::get('Mensaje')}}
            </div>
        @endif

        <a href="{{route('CRUD.create')}}" class="btn btn-success">Nuevo Empleado</a>
        <br><br>
        <table class="table table-light table-hover">

            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($registro as $registros)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$registros->Nombre}}</td><!--Para unir Nobre y Apellidos solo agregamos en un solo campo
                        la informacion ejemplo: abrimos llaves de blade y ponemos $registro->Nombre cerramos llave y agregamos el Apellido
                        LAa segunda forma es agregarle un punto y poner $registros->Apellido Marterno.$registros->Apellido Paterno-->
                        <td>{{$registros->Apellidos}}</td>
                        <td>{{$registros->Correo}}</td>
                        <td>
                            <!--asset guarda la ubicacion de la carpeta storage y concatenamos
                            un slash y despues la ruta del la foto pero  hay que utilizar tambien 
                            el siguiente comando php artisan storage:link esto genera un enlace a las fotografias
                            para linkearlo

                            para que se vea en la pagina de editar requerimos de poner el link en la vista indicada
                            se pone toda la linea desde img hasta el final
                            -->
                            <img src="{{ asset('storage').'/'.$registros->Foto}}" alt="" width="150" class="img-thumbnail img-fluid">
                            
                        
                        </td>
                        <td>
                            
                            <a href="{{route('CRUD.editar',$registros->id)}}" class="btn btn-warning">Editar</a>
                            |
                            <form action="{{route('CRUD.destroy',$registros->id)}}" method="POST" style="display: inline">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('¿Borrar?')" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!--Para paginar es en http/providers AppServiceProvider (laravel 8 y 9 )
            estando hay insertamos la url use Illuminate\Pagination\Paginator;
            despues en el metodo boot ponemos Paginator::useBootstrap();-->
        {{$registro->links()}}
        
    </div>
@endsection 