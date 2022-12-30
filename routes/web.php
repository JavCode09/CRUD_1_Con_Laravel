<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;//agregamos la ruta del controlador a utilizar

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); //en wellcome lo cambiamos por el login de auth despues de 
                               //implementar los comandos en terminal
});

//hacemos un grupo para las rutas de un solo controlador
Route::controller(EmpleadosController::class)->group(function(){
                                                    //middleware es para que no de acceso a menos que este logeado (sesion abierta)
    Route::get('CRUD/index','index')->name('CRUD.index')->middleware('auth'); //index 
    Route::get('CRUD/create','create')->name('CRUD.create');//crear
    Route::post('CRUD/store','store')->name('CRUD.store');//Mnadar informamacion al metodo store
    Route::delete('CRUD/{id}','destroy')->name('CRUD.destroy');//Eliminar registro
    Route::get('CRUD/{id}/edit','edit')->name('CRUD.editar');//pagina para ver la informacion por id
    Route::put('CRUD/{id}','update')->name('CRUD.update'); //Envio de informacion para actualizar el empleado
    
});


//desactivamos del login el registro y el link de recuperacion de contraseña
Auth::routes(['reset'=>false]);

//para que se direccione el login al index de nuestro crud podemos ponerle a la ruta
//en lugar de HomeController el controlador que estamos ocupando en este caso es EmpleadosController y listo.

//Route::get('/home', [App\Http\Controllers\EmpleadosController::class, 'index'])->name('home');

//La otra opcion para laravel 9 es en http Providers y en RouteServiceProvider hay cambiamos la ruta /home 
//a la que queremos que direcciones el login. 
//si te vas a controller/puth/loginController/veras que el redirecTo manda a Providers)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Nota 
/*Para laravel 8 e inferior es directo en controllers/puth/loginController y se cambia la ruta*/
