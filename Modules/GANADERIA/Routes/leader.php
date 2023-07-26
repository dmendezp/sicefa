<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\animal\AnimalController;

/* Route::middleware(['lang'])->group(function(){ */
  Route::prefix('ganaderia')->group(function() {
    Route::get('/admin/leader/index', [AnimalController::class, 'index'])->name('ganaderia.admin.leader.index'); // La primera vista al ingresar al aprendiz lider
    /* Para poder ver la lista de animales y hacer los respectivos cruds */
    Route::get('/admin/animal/register', [AnimalController::class, 'register'])->name('ganaderia.admin.leader.register.index'); // Para poder ver el datatable de los animales
    /* Para poder agregar un animal */
    Route::get('/admin/animal/add', [AnimalController::class, 'add'])->name('ganaderia.admin.leader.register.add'); // La vista para poder agregar un animal
    Route::post('/admin/animal/add', [AnimalController::class, 'addpost'])->name('ganaderia.admin.leader.addpost'); // La ruta del controlador para poder guardar un animal
    /* Para poder editar un animal */
    Route::get('/admin/animal/edit/{id}', [AnimalController::class, 'edit'])->name('ganaderia.admin.leader.register.edit'); // La vista para poder editar el animal
    Route::post('/admin/animal/edit/', [AnimalController::class, 'editpost'])->name('ganaderia.admin.leader.editpost');  // Lar uta del controlador para poder edtar un animal
    /* Para poder eliminar un animal */
    Route::get('/admin/animal/delete/{id}', [AnimalController::class, 'destroy'])->name('ganaderia.admin.leader.register.delete'); // La ruta para poder eliminar el registro de un animal
    /* Para poder consultar al animal con el codigo */
    Route::get('/admin/animal/search/{mother}',[AnimalController::class, 'searchcrud'])->name('ganaderia.admin.leader.search'); // Para poder buscar el animal al momento de agregar
    /* Para poder consultar los animales por el codigo */
    Route::get('/admin/animal/search', [AnimalController::class, 'search'])->name('ganaderia.admin.leader.search'); // Para poder el animales por el codigo
    /* Para poder ver la lista de razas y hacer los respectivos cruds */
    Route::get('/admin/animal/race/index',[AnimalController::class, 'indexRace'])->name('ganaderia.admin.leader.race.index');
    /* Para poder agregar una raza */
    Route::get('/admin/animal/race/add',[AnimalController::class, 'addRace'])->name('ganaderia.admin.leader.race.add');
    Route::post('/admin/animal/race/add',[AnimalController::class, 'addpostRace'])->name('ganaderia.admin.race.addpost');
    /* Para poder editar una raza */
    Route::get('/admin/animal/race/edit/{id}', [AnimalController::class, 'editRace'])->name('ganaderia.admin.leader.race.edit');
    Route::post('/admin/animal/race/edit/', [AnimalController::class, 'editpostRace'])->name('ganaderia.admin.race.editpost');
    /* Para poder eliminar una raza */
    Route::get('/admin/animal/race/delete/{id}', [AnimalController::class, 'destroyRace'])->name('ganaderia.admin.leader.race.delete');
  });
/* }); */
  /*
  ganaderia.admin.leader
  */