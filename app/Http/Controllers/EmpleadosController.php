<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;//Para editar la foto

class EmpleadosController extends Controller
{
    public function index(){

        /*Para paginar es en http/providers AppServiceProvider (laravel 8 y 9 )
            estando hay insertamos la url use Illuminate\Pagination\Paginator;
            despues en el metodo boot ponemos Paginator::useBootstrap(); 
            despues en el la plantilla que quieres que se veo ponemos con blade {{$variable->links()}}*/

        $registro = Empleados::paginate(2); //paginate es para que aparescan por paginas 
        return view('empleados.index',compact('registro'));
        
    }

    public function create(){ 
        return view('empleados.create');
    }

    public function store(Request $request){ //store es para ingresar o insertar datos nuevos
        //validacion o pasamos a un request aparte en este caso se hace la validacion aqui
        
        $validation = [
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|mimes:jpeg,png,jpg',
        ];
        //Guardamos en la variable lo que es reqerido y aparecera el mensaje
        //el mensaje es 'El :attribute (Nombre,Apellido etc.) es requerido'
        $Mensaje = ["required" => "El :attribute es requerido"];
        //despues lo validamos pasandole los datos del formulario, validacion y mensaje
        $this->validate($request,$validation,$Mensaje);

        //par que el Token no lo reconosca se puede hacer de esta forma
        //$empleado=request()->except(['_token','_method']);
        
        $empleado = new Empleados();
        $empleado -> Nombre = $request->Nombre;
        $empleado -> Apellidos = $request->Apellidos;
        $empleado -> Correo = $request->Correo;
        //PARA LA FOTOGRAFIA SE RECOLECTA CON UN IF poniendo el nombre del campo de la FOTO 
        if($request->hasFile('Foto')){
        //Buscamps el campo Foto = Recolectamos el camp Foto y lo almacenamos en la carpeta Uploads y que es publica
        //esta carpeta esta en storage/app/public/uploads 
            $empleado['Foto'] = $request->file('Foto')->store('uploads','public');

        }

        $empleado ->save();
        
        return redirect(route('CRUD.index'))->with('Mensaje','Empleado Agregado con éxito');
        //return $empleado->all();
    
    }

    public function edit($id){ //pagina para ver el registro que se editara
        $empleado = Empleados::find($id);
        return view('empleados.edit',compact('empleado'));
    }

    public function update(Request $request,$id){ //actualizamos el registro visualizado
        //validamos la informcaion de los campos
        $validation = [
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email',
            
        ];
        //decimos si exite ya existe una foto que la valide agregandola a la variable
        if($request->hasFile('Foto')){
            $validation += [ 'Foto' => 'required|100000|mimes:jpeg,png,jpg'];
        }
        //despues que mande el mensaje en caso de que no tenga el tipo de formato la foto
        //y que los demas campos esten vacios
        $Mensaje = ["required" => "El :attribute es requerido"];
         //despues lo validamos pasandole los datos del formulario, validacion y mensaje
         $this->validate($request,$validation,$Mensaje);

        //Guardamos en una variable lo que no queremos que se vea o se envie 
        //en este caso es el token y el method
        $empleado=request()->except(['_token','_method']);

        //denuevo mandamos a pedir la foto
        if($request->hasFile('Foto')){
            //Hacemos una consulta para la foto por le id y lo guardamos en una variable x
            $empleados = Empleados::findOrFail($id);
            //Eliminamos la foto del campo Foto por el id indicado
            Storage::delete('public/'.$empleados->Foto);
            //insertamos la nueva foto como si se creara un nuevo empleado
                $empleado['Foto'] = $request->file('Foto')->store('uploads','public');
    
            }
        //le pedimos que actualice la informacion completa en el mismo id
        //donde id de la la informacion anteiror es = al id mandado a este metodo
        //actualizame la inforacion
        Empleados::where('id','=',$id)->update($empleado);
        //return redirect(route('CRUD.editar',compact('id'))); //retorna al mismo registro 
        return redirect(route('CRUD.index'))->with('Mensaje','El Registro fue Editado con éxito!');
    }

    public function destroy(Empleados $id){

        //Si se elimina la foto del ID indicado, Elimina to el registro de ese id
        //Esto es asi para que se elimine la foto
        if (Storage::delete('public/'.$id->Foto)) {
            $id->delete();
        }

        //importante, siempre que se quiera redireccionar es asi 
        return redirect(route('CRUD.index'))->with('Mensaje','El registro se elimino con éxito');
    }
} 
