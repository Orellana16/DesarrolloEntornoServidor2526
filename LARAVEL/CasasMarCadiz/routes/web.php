<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendedorController;
use App\Models\Vendedor;
use App\Models\Comprador;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/hola', function () {
    return "Hola Mundo <br> Muajajaja";
});


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren Login y Verificación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Tu ruta raíz principal ahora es el listado de vendedores
    Route::get('/', [VendedorController::class, 'index'])->name('listadoVendedores');
    
    // Rutas del Controlador de Vendedores
    Route::get('/mostrar/{id}', [VendedorController::class, 'show'])->name('mostrarVendedor');
    Route::get('/vendedores/{id}/eliminar', [VendedorController::class, 'destroy'])->name('eliminarVendedor');
    Route::get('/vendedores/crear', [VendedorController::class, 'create'])->name('crearVendedor');
    Route::post('/vendedores', [VendedorController::class, 'store'])->name('guardarVendedor');
    Route::get('/vendedores/{id}/editar', [VendedorController::class, 'edit'])->name('editarVendedor');
    Route::put('/vendedores/{id}', [VendedorController::class, 'update'])->name('actualizarVendedor');

    // --- Tus rutas de Consultas y Lógica ---
    Route::get('/vendedores', function () {
        return Vendedor::all();
    });

    Route::get('/vendedor/cantidad', function () {
        return Vendedor::count();
    });

    Route::get('/vendedor/sueldo-alto', function () {
        return Vendedor::where('sueldo_base', '>', '50000')->get();
    });

    Route::get('/vendedor/sueldo-between', function () {
        return Vendedor::whereBetween('sueldo_base', [30000, 70000])->get();
    });

    Route::get('/vendedor/max-sueldo', function () {
        return Vendedor::max('sueldo_base');
    });

    Route::get('/vendedor/{id}', function ($id) {
        return Vendedor::findOrFail($id);
    });

    // Rutas de Compradores y Paginación
    Route::get('/compradores-paginado', function () {
        return Comprador::paginate(5, "*", "", 4);
    });

    Route::get("/crear-comprador", function () {
        return Comprador::create([
            'nombre' => 'Adri',
            'nif' => '23232323j',
            'fecha_nac' => '2001-02-29',
            'sexo' => 'M',
        ]);
    });

    Route::get("/borrar-vendedor/{id}", function ($id) {
        $vendedor = Vendedor::findOrFail($id);
        return $vendedor->delete();
    });

    // --- Rutas de Perfil (Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard opcional (puedes borrarlo si prefieres usar solo la raíz)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';