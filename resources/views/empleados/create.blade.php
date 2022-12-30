
@extends('layouts.app')<!--Herdesamos de la plantilla creada  app de la carpeta layout se creo con la 
                        terminal a la hora de crear el login -->

@section('content_layout_app')

<!--Si se ecnuentra un error $errors es (una variable destinada de laravel)
    dentro de un div se pondra un foreach que guarde todos los errores  y los guarde en $error
    para que los imprima  con un etiqueta li-->
@if (count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


    <div class="container">
            <h3>Agregar Empleado</h3>
           

             <!--El encype es para que la foto se pueda enviar por el metodo POST-->
            <form action="{{route('CRUD.store')}}"  method="POST" enctype="multipart/form-data">

                @csrf <!--Para el metodo POST-->
                <!--Le pasamos Una variable llamada Modo y que tiene crear-->
                @include('empleados.form',['Modo'=>'crear']);
                
            </form>

    </div>  
@endsection