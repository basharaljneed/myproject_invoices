<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomersReports;
use App\Http\Controllers\Home;
use App\Http\Controllers\InvoicesArchifController;
use App\Http\Controllers\InvoicesAttachmentController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesReports;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Models\InvoicesDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

   return view('welcome');
    return view('auth.login');
});
//Auth::routes();
//Route::get('/{page}', 'AdminController@index');
Route::get('/index', [AdminController::class,'index']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Home::class, 'index'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/invoices',InvoicesController::class);
Route::resource('/sections',SectionController::class);
Route::resource('/products',ProductController::class);
Route::resource('/InvoiceAttachments',InvoicesAttachmentController::class);
//Route::resource('/InvoicesArchif',InvoicesArchifController::class);

Route::get('/section/{id}', [InvoicesController::class,'getproducts']);
Route::get('/invoicedet/{nd}',[InvoicesDetailsController::class,'showdet']);
Route::get('/invoiceedt/{dt}',[InvoicesController::class,'showed']);
Route::get('/View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'View_file']);
Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'download']);
Route::delete('Details_ddtt', [InvoicesDetailsController::class,'ddtt'])->name('Details_ddtt');
Route::get('/Status_show/{sd}',[InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{sed}',[InvoicesController::class,'edit'])->name('Status_Update');
//Route::delete('forcedestroy', [InvoicesController::class,'forcedestroy'])->name('forcedestroy');

Route::delete('InvoicesArchifedit', [InvoicesArchifController::class,'edit'])->name('InvoicesArchifedit');
Route::patch('InvoicesArchifshow', [InvoicesArchifController::class,'show'])->name('InvoicesArchifshow');



Route::get('/print_show/{ps}',[InvoicesController::class,'print_show'])->name('print_show');
Route::get('/invoices_paid',[InvoicesController::class,'invoices_paid'])->name('invoices_paid');
Route::get('/invoices_unpaid',[InvoicesController::class,'invoices_unpaid'])->name('invoices_unpaid');
Route::get('/invoices_partpaid',[InvoicesController::class,'invoices_partpaid'])->name('invoices_partpaid');
Route::get('/invoices_archif',[InvoicesController::class,'invoices_archif'])->name('invoices_archif');
Route::get('invoices_reports',[InvoicesReports::class,'index'])->name('invoices_reports');
Route::post('Search_invoices',[InvoicesReports::class,'Search_invoices'])->name('Search_invoices');

Route::get('CustomersReports',[CustomersReports::class,'index'])->name('CustomersReports');
Route::post('CustomersReports',[CustomersReports::class,'Search_Customers'])->name('CustomersReports');


Route::get('/markread', [InvoicesController::class,'markread'])->name('markread');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    });










require __DIR__.'/auth.php';
