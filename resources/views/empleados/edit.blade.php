
@extends('layouts.app')<!--Herdesamos de la plantilla creada  app de la carpeta layout se creo con la 
                            terminal a la hora de crear el login -->

@section('content_layout_app')
    

        <div class="container">
            <h3>Editar Empleado Con ID:{{$empleado->id.' '.$empleado->Nombre}}</h3>
                <form action="{{route('CRUD.update',$empleado->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('put')
                    <!--Incluimos la ruta paraeditar  (usamos el mismo formuario de crear)-->
                    @include('empleados.form',['Modo'=>'editar'])
                </form>
        </div>
    
@endsection 
<!---value=old('name',$curso->name)}}---->