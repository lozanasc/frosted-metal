<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;

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
    return view('welcome');
});
Route::get('edit-tools/{id}', [StaffController::class,'edit_tools'])->name('edit-tools');
Route::get('edit-staff/{id}', [DashboardController::class,'edit_staff'])->name('edit-staff');
Route::get('staff_update', [DashboardController::class,'staffview'])->name('staffview');
Route::get('customer_panel', [DashboardController::class,'customer_Panel'])->name('customerPanel');
Route::get('equipment_panel', [DashboardController::class,'equipment_Panel'])->name('equipmentPanel');
Route::get('transaction_panel', [DashboardController::class,'transaction_Panel'])->name('transactionPanel');

Route::get('owner/registration_approval', [DashboardController::class,'registration_Panel'])->name('registrationPanel');
Route::get('owner/owner_customer_panel', [DashboardController::class,'owner_customer_Panel'])->name('OwnerCustomerPanel');
Route::get('owner/owner_staff_panel', [DashboardController::class,'owner_staff_Panel'])->name('OwnerStaffPanel');

Route::get('staff/staff_equipment_panel', [StaffController::class,'staff_equipment_Panel'])->name('StaffEquipmentPanel');
Route::get('staff/staff_transaction_panel', [StaffController::class,'staff_transaction_Panel'])->name('StaffTransactionPanel');

Route::get('send', [DashboardController::class, 'approveduser'])->name('approveduser');
Route::post('/add_tools', [StaffController::class, 'add_tools'])->name('addTools');
Route::post('/member', [StaffController::class, 'member'])->name('member');
Route::get('/userdash/{id}', [StaffController::class,'profile'])->name('profileBack');
Route::get('/staff', [DashboardController::class, 'staff'])->name('staff');
Route::post('/newstaff',[DashboardController::class, 'newstaff'])->name('newstaff');
Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});
Route::put('update-staff/{id}', [DashboardController::class, 'update_staff'])->name('update.staff');
Route::put('update-customer/{id}', [DashboardController::class, 'update_customer'])->name('update.customer');
Route::post('/availExtend', [StaffController::class, 'avail_extend'])->name('availExtend');
Route::post('/updatetools', [StaffController::class, 'update_tool'])->name('updatetools');
Route::post('/add_transactions', [StaffController::class, 'add_transactions'])->name('add.transactions');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('status/{id}', [DashboardController::class, 'status'])->name('status');
    Route::get('memberstatus/{id}', [DashboardController::class, 'memberstatus'])->name('memberstatus');
    Route::get('deny/{id}', [DashboardController::class, 'deny'])->name('deny');
    Route::get('memberdeny/{id}', [DashboardController::class, 'memberdeny'])->name('memberdeny');
    Route::get('deleteMember/{id}', [DashboardController::class, 'delete_member'])->name('deleteMember');
    Route::get('deleteUser/{id}', [DashboardController::class, 'delete_user'])->name('deleteUser');
    Route::get('updateUser/{id}', [DashboardController::class, 'update_user'])->name('updateUser');
    Route::get('deleteTools/{id}', [StaffController::class, 'delete_tools'])->name('deleteTools');
});

require __DIR__.'/auth.php';
