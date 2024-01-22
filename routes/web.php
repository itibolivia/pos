<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;

use App\Http\Controllers\NotaController;
use App\Http\Controllers\DetalleNotaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\VentaController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function() {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('admins', AdminController::class);

    Route::get('/seguimiento', CalendarController::class)->name('seguimiento');

    Route::get('precios/{id}', [CompraController::class, 'precios'])->name('precios');

    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('compras', CompraController::class);

    Route::resource('notas', NotaController::class);
    Route::resource('cajas', CajaController::class);

    Route::post('/detallenota', [DetalleNotaController::class, 'guardar'])->name('detallenota');
    Route::get('/carrito/{id}', [DetalleNotaController::class, 'carrito'])->name('carrito');

    Route::resource('ventas', VentaController::class);
});
