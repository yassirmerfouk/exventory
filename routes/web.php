<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Tag\TagController;
use App\Models\Product;
use App\Models\Tag;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Field\FieldController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Role\RoleController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::pattern('id', '[0-9]+');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/', [HomeController::class, 'index']);

    Route::get('/home/categories', [CategoryController::class, 'index'])->name('categories')->middleware('permission:category_show');
    Route::get('/home/categories/add', [CategoryController::class, 'categoryAddPage'])->name('categoryAddPage')->middleware('permission:category_add');
    Route::post('/home/categories', [CategoryController::class, 'addcategory'])->name('categoryAdd')->middleware('permission:category_add');
    Route::get('home/category/{id}/edit', [CategoryController::class, 'categoryUpdatePage'])->name('categoryUpadatePage')->middleware('permission:category_update');
    Route::put('/home/category/{id}', [CategoryController::class, 'updateCategory'])->name('categoryUpdate')->middleware('permission:category_update');
    Route::delete('/home/category/{id}', [CategoryController::class, 'deleteCategory'])->name('categoryDelete')->middleware('permission:category_delete');

    // Products routes :
    Route::get('/home/products', [ProductController::class, 'index'])->name('products')->middleware('permission:product_show');
    Route::get('/home/products/add', [ProductController::class, 'ProductAddPage'])->name('productAddPage')->middleware('permission:product_add');
    Route::post('/home/products', [ProductController::class, 'addProduct'])->name('productAdd')->middleware('permission:product_add');
    Route::get('/home/product/{id}/edit', [ProductController::class, 'productUpdatePage'])->name('productUpdatePage')->middleware('permission:product_update');
    Route::put('/home/product/{id}', [ProductController::class, 'updateProduct'])->name('productUpdate')->middleware('permission:product_update');
    Route::delete('/home/products/{id}', [ProductController::class, 'deleteProduct'])->name('productDelete')->middleware('permission:product_delete');
    // products pages :
    Route::get('/home/product/{id}', [ProductController::class, 'productPage'])->name('productPage')->middleware('permission:product_access');

    // Tags routes :
    Route::get('home/tags', [TagController::class, 'index'])->name('tags')->middleware('permission:tag_show');
    Route::get('/home/tags/add', [TagController::class, 'tagAddPage'])->name('tagAddPage')->middleware('permission:tag_add');
    Route::post('/home/tags', [TagController::class, 'addTag'])->name('tagAdd')->middleware('permission:tag_add');
    Route::get('/home/tag/{id}/edit', [TagController::class, 'tagUpdatePage'])->name('tagUpdatePage')->middleware('permission:tag_update');
    Route::put('/home/tag/{id}', [TagController::class, 'updateTag'])->name('tagUpdate')->middleware('permission:tag_update');
    Route::delete('/home/tag/{id}', [TagController::class, 'deleteTag'])->name('tagDelete')->middleware('permission:tag_delete');


    // Stocks routes :
    Route::get('/home/stocks', [StockController::class, 'index'])->name('stocks')->middleware('permission:stock_show');
    Route::get('/home/stocks/add', [StockController::class, 'stockAddPage'])->name('stockAddPage')->middleware('permission:stock_add');
    Route::post('/home/stocks', [StockController::class, 'addStock'])->name('stockAdd')->middleware('permission:stock_add');
    Route::get('/home/stock/{id}/edit', [StockController::class, 'stockUpdatePage'])->name('stockUpdatePage')->middleware('permission:stock_update');
    Route::put('/home/stock/{id}', [StockController::class, 'updateStock'])->name('stockUpdate')->middleware('permission:stock_update');
    Route::delete('/home/stock/{id}', [StockController::class, 'deleteStock'])->name('stockDelete')->middleware('permission:stock_delete');

    // Project fields routes :
    Route::get('/home/fields', [FieldController::class, 'index'])->name('fields')->middleware('permission:field_show');
    Route::get('/home/fields/add', [FieldController::class, 'fieldAddPage'])->name('fieldAddPage')->middleware('permission:field_add');
    Route::post('/home/fields', [FieldController::class, 'addField'])->name('fieldAdd')->middleware('permission:field_add');
    Route::get('/home/field/{id}/edit', [FieldController::class, 'fieldUpdatePage'])->name('fieldUpdatePage')->middleware('permission:field_update');
    Route::put('/home/field/{id}', [FieldController::class, 'updateField'])->name('fieldUpdate')->middleware('permission:field_update');
    Route::delete('/home/field/{id}', [FieldController::class, 'deleteField'])->name('fieldDelete')->middleware('permission:field_delete');

    // Project routes :
    Route::get('/home/projects', [ProjectController::class, 'index'])->name('projects')->middleware('permission:project_show');
    Route::get('/home/projects/add', [ProjectController::class, 'projectAddPage'])->name('projectAddPage')->middleware('permission:project_add');
    Route::post('/home/projects', [ProjectController::class, 'addProject'])->name('projectAdd')->middleware('permission:project_add');
    Route::get('/home/project/{id}/edit', [ProjectController::class, 'projectUpdatePage'])->name('projectUpdatePage')->middleware('permission:project_update');
    Route::put('/home/project/{id}', [ProjectController::class, 'updateProject'])->name('projectUpdate')->middleware('permission:project_update');
    Route::delete('/home/project/{id}', [ProjectController::class, 'deleteProject'])->name('projectDelete')->middleware('permission:project_delete');
    // Projects page :
    Route::get('/home/project/{id}', [ProjectController::class, 'projectPage'])->name('projectPage')->middleware('permission:project_access');

    // Users routes :
    Route::get('/home/users', [UserController::class, 'index'])->name('users')->middleware('permission:user_show');
    Route::get('/home/users/add', [UserController::class, 'userAddPage'])->name('userAddPage')->middleware('permission:user_add');
    Route::post('/home/users', [UserController::class, 'addUser'])->name('userAdd')->middleware('permission:user_add');
    Route::get('/home/user/{id}/edit', [UserController::class, 'userUpdatePage'])->name('userUpdatePage')->middleware('permission:user_update');
    Route::put('/home/user/{id}', [UserController::class, 'updateUser'])->name('userUpdate')->middleware('permission:user_update');
    Route::delete('/home/user/{id}', [UserController::class, 'deleteUser'])->name('userDelete')->middleware('permission:user_delete');

    // Roles routes :
    Route::get('/home/roles', [RoleController::class, 'index'])->name('roles')->middleware('permission:role_show');
    Route::get('home/roles/add', [RoleController::class, 'roleAddPage'])->name('roleAddPage')->middleware('permission:user_add');
    Route::post('/home/roles', [RoleController::class, 'addRole'])->name('roleAdd')->middleware('permission:user_add');
    Route::get('/home/role/{id}/edit', [RoleController::class, 'roleUpdatePage'])->name('roleUpdatePage')->middleware('permission:user_update');
    Route::put('/home/role/{id}', [RoleController::class, 'updateRole'])->name('roleUpdate')->middleware('permission:user_update');
    Route::delete('/home/role/{id}', [RoleController::class, 'deleteRole'])->name('roleDelete')->middleware('permission:user_delete');

    // Invoices Routes :

    Route::get('/home/invoices', [InvoiceController::class, 'index'])->name('invoices')->middleware('permission:invoice_show');
    Route::get('/hone/invoices/add', [InvoiceController::class, 'invoiceAddPage'])->name('invoiceAddPage')->middleware('permission:invoice_add');
    Route::post('/home/invoices', [InvoiceController::class, 'addInvoice'])->name('invoiceAdd')->middleware('permission:invoice_add');
    Route::get('/home/invoice/{id}/edit', [InvoiceController::class, 'invoiceUpdatePage'])->name('invoiceUpdatePage')->middleware('permission:invoice_update');
    Route::put('/home/invoice/{id}', [InvoiceController::class, 'updateInvoice'])->name('invoiceUpdate')->middleware('permission:invoice_update');
    Route::delete('/home/invoice/{id}', [InvoiceController::class, 'deleteInvoice'])->name('invoiceDelete')->middleware('permission:invoice_delete');
    Route::get('/home/invoice/{id}', [InvoiceController::class, 'invoicePage'])->name('pageInvoice')->middleware('permission:invoice_show');
});
