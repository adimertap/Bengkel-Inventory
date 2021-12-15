<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['verify' => true]);


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get("/getkabupaten/{id}", "Auth\RegisterController@kabupaten_baru");
Route::get("/getkecamatan/{id}", "Auth\RegisterController@kecamatan_baru");
Route::get("/getdesa/{id}", "Auth\RegisterController@desa_baru");


Route::get('account/password', 'Account\PasswordController@edit')->name('password.edit');
Route::patch('account/password', 'Account\PasswordController@update')->name('password.edit');

Route::group(
    ['middleware' => 'auth'],
    function () {
        // MODUL INVENTORY ------------------------------------------------------------------------------------ INVENTORY
        // DASHBOARD
        Route::prefix('inventory')
            ->namespace('Inventory')
            ->middleware(['admin_inventory_accounting', 'verified'])

            ->group(function () {
                Route::get('/', 'DashboardinventoryController@index')
                    ->name('dashboardinventory');
            });

        // MASTERDATA INVENTORY -------------------------------------------------------- Master Data Inventory
        Route::prefix('Inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::get('/', 'MasterdatasparepartController@index')
                    ->name('masterdatasparepart');
                Route::resource('sparepart', 'MasterdatasparepartController');
                Route::get('sparepart/getmerk/{id}', 'MasterdatasparepartController@getmerk');
            });

        Route::prefix('inventory/gallerysparepart')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::get('/', 'MasterdatagalleryController@index')
                    ->name('masterdatagallery');

                Route::resource('gallery', 'MasterdatagalleryController')->except('create');
                Route::get('gallery/create/{idsparepart}', 'MasterdatagalleryController@create')->name('gallery.create');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('merk-sparepart', 'MasterdatamerksparepartController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('jenis-sparepart', 'MasterdatajenissparepartController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::get('/{id_supplier}/sparepart', 'MasterdatasupplierController@getDataSparepartBySupplierId');
                Route::resource('supplier', 'MasterdatasupplierController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('hargasparepart', 'MasterdatahargasparepartController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('rak', 'MasterdatarakController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('konversi', 'MasterdatakonversiController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('kemasan', 'MasterdatakemasanController');
            });

        Route::prefix('inventory')
            ->namespace('Inventory\Masterdata')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('gudang', 'MasterdatagudangController');
            });


        // DETAIL SPAREPART
        Route::prefix('inventory')
            ->namespace('Inventory\DetailSparepart')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {
                Route::resource('Detailsparepart', 'DetailSparepartController');
                Route::get('Detailsparepart/{id_detail_sparepart}/gallery', 'DetailSparepartController@gallery')
                    ->name('Detailsparepart-gallery');
               
            });



        // PURCHASE ORDER ---------------------------------------------------------------- Purchase Order
        Route::prefix('inventory')
            ->namespace('Inventory\Purchase')
            ->middleware(['admin_purchasing', 'verified'])
            ->group(function () {
                Route::resource('purchase-order', 'PurchaseorderController');
                Route::post('PO/{id_po}/set-status', 'PurchaseorderController@setStatus')
                    ->name('po-status-kirim');
                Route::get('cetak-po/{id}', 'PurchaseorderController@CetakPO')->name('cetak-po');
            });

        Route::prefix('inventory/approvalpembelian')
            ->namespace('Inventory\Purchase')
            ->middleware(['admin_purchasing', 'verified'])
            ->group(function () {
                Route::get('/', 'ApprovalpurchaseController@index')
                    ->name('approvalpo');

                Route::resource('approval-po', 'ApprovalpurchaseController');

                Route::post('PO/{id_po}/set-status', 'ApprovalpurchaseController@setStatus')
                    ->name('po-status');
            });

        Route::prefix('inventory/approvalappembelian')
            ->namespace('Inventory\Purchase')
            ->middleware(['admin_inventory_accounting', 'verified'])
            ->group(function () {
                Route::get('/', 'ApprovalpurchaseAPController@index')
                    ->name('approvalpoap');

                Route::resource('approval-po-ap', 'ApprovalpurchaseAPController');

                Route::post('PO/{id_po}/set-status', 'ApprovalpurchaseAPController@setStatus')
                    ->name('po-status-ap');
            });

        // RECEIVING ------------------------------------------------------------------- Receiving
        Route::prefix('inventory')
            ->namespace('Inventory\Rcv')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {

                Route::resource('receiving', 'RcvController', ['names' => 'Rcv']);
                Route::get('detail/{id_po}', 'RcvController@detailpo')
                    ->name('Rcv-detail-po');
                Route::get('cetak-rcv/{id}', 'RcvController@CetakRcv')->name('cetak-rcv');
                Route::get('receiving/{id_rcv}/getrak/{id_gudang}', 'RcvController@getrak', function ($id_gudang){
                    return $id_gudang;
                });
                Route::get('receiving/{id}/editrcv', 'RcvController@edit2')->name('rcvgetedit');
            });

        // RETUR ---------------------------------------------------------------------- Retur
        Route::prefix('inventory')
            ->namespace('Inventory\Retur')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {

                Route::resource('retur', 'ReturController');
                Route::get('cetak-retur/{id}', 'ReturController@CetakRetur')->name('cetak-retur');
            });

        // OPNAME ---------------------------------------------------------------------- Stock Opname
        Route::prefix('inventory')
            ->namespace('Inventory\Opname')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {

                Route::resource('Opname', 'OpnameController');
                Route::post('Opname/storeawal', 'OpnameController@Storeawal')
                    ->name('opname-store2');
            });

        Route::prefix('inventory/approvalopname')
            ->namespace('Inventory\Opname')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::get('/', 'ApprovalopnameController@index')
                    ->name('approvalopname');

                Route::resource('approval-opname', 'ApprovalopnameController');

                Route::post('Opname/{id_opname}/set-status', 'ApprovalopnameController@setStatus')
                    ->name('approval-opname-status');
            });


        // KARTU GUDANG --------------------------------------------------------------------------- Kartu Gudang
        Route::prefix('inventory')
            ->namespace('Inventory\Kartugudang')
            ->middleware(['admin_gudang', 'verified'])
            ->group(function () {

                Route::resource('Kartu-gudang', 'KartugudangController');
                Route::get('cetak-kartu-gudang/{id}', 'KartugudangController@CetakKartu')->name('cetak-kartu-gudang');
                Route::get('getrak/{id_gudang}', 'KartugudangController@getrak');
            });
    }
);
