    
 <!--Si la variable tiene crear Pon Agregar Empleado si no Editar empleado esto va con {} por que es blade
$Modo=='crear' ? 'Agregar Empleado (Nuevo)':'Editar Empleado'-->   
 
<!--En cada input le decimos en el value que si exite algo en la variable empleados  que lo imprima o lo muestre
 en caso de que este vacio no aparesca nada (bacio)-->

 <!--En la clase de cada input vamos a ponerle si el campo esta vacio lo identifique poniendole invalid
     en blade $errors tiene un error en Nombre pon is-invalid si no pon vacio
     (esto es para todos los inputs-->
    <label for="Nombre" class="form-label">Nombre: </label>
    <input type="text" name="Nombre" class="form-control {{$errors->has('Nombre')? 'is-invalid':''}}" 
           placeholder="Escribe tu nombre"  
           value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre')}}">
           <!--Aqui va el enunciado en caso de que este invalido el input-->
            {!! $errors->first('Nombre','<div class="invalid-feedback"> :message </div>') !!}

    <br>

    <label for="Apellidos" class="form-label">Apellidos: </label>
    <input type="text" name="Apellidos" class="form-control {{$errors->has('Apellidos')?'is-invalid':''}}" 
           placeholder="Escribe tus Apellidos" 
           value="{{ isset($empleado->Apellidos) ? $empleado->Apellidos : old('Apellidos')}}">
           <!--Aqui va el enunciado en caso de que este invalido el input-->
           {!! $errors->first('Apellidos','<div class="invalid-feedback"> :message </div>') !!}

    <br> 

    <label for="Correo" class="form-label">Correo: </label>
    <input type="text" name="Correo" class="form-control {{$errors->has('Correo')?'is-invalid':''}}" 
           placeholder="Escribe tu Correo" 
           value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo')}}">
           <!--Aqui va el enunciado en caso de que este invalido el input-->
           {!! $errors->first('Correo','<div class="invalid-feedback"> :message </div>') !!}
    
    <br>

    <label for="Foto" class="form-label">Foto: </label>
    @if (isset ($empleado->Foto))
        <br>
        <img src="{{ asset('storage').'/'.$empleado->Foto}}"  width="300" class="img-thumbnail img-fluid">
        <br>
    @endif
    
    <input type="file" name="Foto" class="{{$errors->has('Foto')?'is-invalid':''}}">
    <!--Aqui va el enunciado en caso de que este invalido el input-->
    {!! $errors->first('Foto','<div class="invalid-feedback"> :message </div>') !!}

    <br><br>

   <input type="submit" class="btn btn-success" value="{{$Modo=='crear' ? 'Agregar':'Actualizar'}}">
   <a href="{{route('CRUD.index')}}" class="btn btn-primary"> <== Regresar</a>