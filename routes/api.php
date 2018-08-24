<?php
header('Access-Control-Allow-Origin', '*');
header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials',' true');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//routes sale
Route::namespace('Api')->group(function () {
    Route::post('/user/login', 'UserController@login')->name('user-login');
    Route::post('/user/validateToken', 'UserController@validateToken')->name('user-validate-token');
    Route::middleware('auth:api')->get('/users', 'UserController@index')->name('users');
    Route::middleware('auth:api')->get('/users/{id}', 'UserController@show')->name('user-show');
    Route::middleware('auth:api')->post('users', 'UserController@store')->name('user-store');
    Route::middleware('auth:api')->put('/users/{id}', 'UserController@update')->name('user-update');
    Route::middleware('auth:api')->delete('/users/{id}', 'UserController@delete')->name('user-delete');


    //school group
    Route::get('/schoolgroups', 'SchoolGroupController@index')->name('schoolgroups');
    Route::post('/schoolgroups', 'SchoolGroupController@store')->name('schoolgroup-store');
    Route::put('/schoolgroups/{id}', 'SchoolGroupController@update')->name('schoolgroup-update');
    Route::delete('/schoolgroups/{id}', 'SchoolGroupController@delete')->name('schoolgroup-delete');
    //languages
    Route::get('/languages', 'LanguageController@index')->name('languages');
    Route::post('/languages', 'LanguageController@store')->name('languages-store');
    Route::put('/languages/{id}', 'LanguageController@update')->name('languages-update');
    Route::delete('/languages/{id}', 'LanguageController@delete')->name('languages-delete');
    //currencies
    Route::get('/currencies', 'CurrencyController@index')->name('currencies');
    Route::post('/currencies', 'CurrencyController@store')->name('currencies-store');
    Route::put('/currencies/{id}', 'CurrencyController@update')->name('currencies-update');
    Route::delete('/currencies/{id}', 'CurrencyController@delete')->name('currencies-delete');
    //countries
    Route::get('/countries', 'CountryController@index')->name('countries');
    Route::post('/countries', 'CountryController@store')->name('countries-store');
    Route::put('/countries/{id}', 'CountryController@update')->name('countries-update');
    Route::delete('/countries/{id}', 'CountryController@delete')->name('countries-delete');
    //zones
    Route::get('/zones', 'ZoneController@index')->name('zones');
    Route::get('/zones/{country_id}', 'ZoneController@filter')->name('zones-by-country-id');
    Route::post('/zones', 'ZoneController@store')->name('zones-store');
    Route::put('/zones/{id}', 'ZoneController@update')->name('zones-update');
    Route::delete('/zones/{id}', 'ZoneController@delete')->name('zones-delete');
    //cities
    Route::get('/cities', 'CityController@index')->name('cities');
    Route::get('/cities/{zone_id}', 'CityController@filter')->name('cities-by-zone-id');
    Route::post('/cities', 'CityController@store')->name('cities-store');
    Route::put('/cities/{id}', 'CityController@update')->name('cities-update');
    Route::delete('/cities/{id}', 'CityController@delete')->name('cities-delete');
    //accommodation types
    Route::get('/school-accommodation-types', 'SchoolAccommodationTypeController@index')->name('school-accommodation-types');
    Route::post('/school-accommodation-types', 'SchoolAccommodationTypeController@store')->name('school-accommodation-types-store');
    Route::put('/school-accommodation-types/{id}', 'SchoolAccommodationTypeController@update')->name('school-accommodation-types-update');
    Route::delete('/school-accommodation-types/{id}', 'SchoolAccommodationTypeController@delete')->name('school-accommodation-types-delete');
    //fee types
    Route::get('/school-fee-types', 'SchoolFeeTypeController@index')->name('school-fee-types');
    Route::post('/school-fee-types', 'SchoolFeeTypeController@store')->name('school-fee-types-store');
    Route::put('/school-fee-types/{id}', 'SchoolFeeTypeController@update')->name('school-fee-types-update');
    Route::delete('/school-fee-types/{id}', 'SchoolFeeTypeController@delete')->name('school-fee-types-delete');
    //item types
    Route::get('/item-types', 'ItemTypeController@index')->name('item-types');
    Route::post('/item-types', 'ItemTypeController@store')->name('item-types-store');
    Route::put('/item-types/{id}', 'ItemTypeController@update')->name('item-types-update');
    Route::delete('/item-types/{id}', 'ItemTypeController@delete')->name('item-types-delete');
    //company types
    Route::get('/company-types', 'CompanyTypeController@index')->name('company-types');
    Route::post('/company-types', 'CompanyTypeController@store')->name('company-types-store');
    Route::put('/company-types/{id}', 'CompanyTypeController@update')->name('company-types-update');
    Route::delete('/company-types/{id}', 'CompanyTypeController@delete')->name('company-types-delete');
    //companies
    Route::get('/companies', 'CompanyController@index')->name('companies');
    Route::post('/companies', 'CompanyController@store')->name('companies-store');
    Route::put('/companies/{id}', 'CompanyController@update')->name('companies-update');
    Route::delete('/companies/{id}', 'CompanyController@delete')->name('companies-delete');
    //customer types
    Route::get('/customer-types', 'CustomerTypeController@index')->name('customer-types');
    Route::post('/customer-types', 'CustomerTypeController@store')->name('customer-types-store');
    Route::put('/customer-types/{id}', 'CustomerTypeController@update')->name('customer-types-update');
    Route::delete('/customer-types/{id}', 'CustomerTypeController@delete')->name('customer-types-delete');
    //customer status
    Route::get('/customer-status', 'CustomerStatusController@index')->name('customer-status');
    Route::post('/customer-status', 'CustomerStatusController@store')->name('customer-status-store');
    Route::put('/customer-status/{id}', 'CustomerStatusController@update')->name('customer-status-update');
    Route::delete('/customer-status/{id}', 'CustomerStatusController@delete')->name('customer-status-delete');
    //webmidias
    Route::get('/webmidias', 'WebmidiaController@index')->name('webmidias');
    Route::post('/webmidias', 'WebmidiaController@store')->name('webmidias-store');
    Route::put('/webmidias/{id}', 'WebmidiaController@update')->name('webmidias-update');
    Route::delete('/webmidias/{id}', 'WebmidiaController@delete')->name('webmidias-delete');
    //dashboard
    Route::get('/summaries', 'DashboardController@index')->name('dashboard');
    //agency prop types
    Route::get('/agency-prop-types', 'AgencyPropTypeController@index')->name('agency-prop-types');

    //school
    Route::get('/schools', 'SchoolController@index')->name('schools');
    Route::post('/schools', 'SchoolController@store')->name('schools-store');
    Route::get('/schools/{id}', 'SchoolController@show')->name('schools-show');
    Route::put('/schools/{id}', 'SchoolController@update')->name('schools-update');
    Route::delete('/schools/{id}', 'SchoolController@delete')->name('schools-delete');
    //school contacts
    Route::get('/school-contacts', 'SchoolContactController@index')->name('school-contacts');
    Route::post('/school-contacts', 'SchoolContactController@store')->name('school-contacts-store');
    Route::get('/school-contacts/{id}', 'SchoolContactController@show')->name('school-contacts-show');
    Route::put('/school-contacts/{id}', 'SchoolContactController@update')->name('school-contacts-update');
    Route::delete('/school-contacts/{id}', 'SchoolContactController@delete')->name('school-contacts-delete');
    //school contents
    Route::get('/school-contents', 'SchoolContentController@index')->name('school-contents');
    Route::post('/school-contents', 'SchoolContentController@store')->name('school-contents-store');
    Route::get('/school-contents/{id}', 'SchoolContentController@show')->name('school-contents-show');
    Route::put('/school-contents/{id}', 'SchoolContentController@update')->name('school-contents-update');
    Route::delete('/school-contents/{id}', 'SchoolContentController@delete')->name('school-contents-delete');
    //school accommodations
    Route::get('/school-accommodations', 'SchoolAccommodationController@index')->name('school-accommodations');
    Route::post('/school-accommodations', 'SchoolAccommodationController@store')->name('school-accommodations-store');
    Route::get('/school-accommodations/{id}', 'SchoolAccommodationController@show')->name('school-accommodations-show');
    Route::put('/school-accommodations/{id}', 'SchoolAccommodationController@update')->name('school-accommodations-update');
    Route::delete('/school-accommodations/{id}', 'SchoolAccommodationController@delete')->name('school-accommodations-delete');
    //school fees
    Route::get('/school-fees', 'SchoolFeeController@index')->name('school-fees');
    Route::post('/school-fees', 'SchoolFeeController@store')->name('school-fees-store');
    Route::get('/school-fees/{id}', 'SchoolFeeController@show')->name('school-fees-show');
    Route::put('/school-fees/{id}', 'SchoolFeeController@update')->name('school-fees-update');
    Route::delete('/school-fees/{id}', 'SchoolFeeController@delete')->name('school-fees-delete');
    //school fees
    Route::get('/school-transfers', 'SchoolTransferController@index')->name('school-transfers');
    Route::post('/school-transfers', 'SchoolTransferController@store')->name('school-transfers-store');
    Route::get('/school-transfers/{id}', 'SchoolTransferController@show')->name('school-transfers-show');
    Route::put('/school-transfers/{id}', 'SchoolTransferController@update')->name('school-transfers-update');
    Route::delete('/school-transfers/{id}', 'SchoolTransferController@delete')->name('school-transfers-delete');
    //commissions
    Route::get('/commissions', 'CommissionController@index')->name('commissions');
    Route::post('/commissions', 'CommissionController@store')->name('commissions-store');
    Route::get('/commissions/{id}', 'CommissionController@show')->name('commissions-show');
    Route::put('/commissions/{id}', 'CommissionController@update')->name('commissions-update');
    Route::delete('/commissions/{id}', 'CommissionController@delete')->name('commissions-delete');
    //customer
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::post('/customers', 'CustomerController@store')->name('customers-store');
    Route::get('/customers/{id}', 'CustomerController@show')->name('customers-show');
    Route::put('/customers/{id}', 'CustomerController@update')->name('customers-update');
    Route::delete('/customers/{id}', 'CustomerController@delete')->name('customers-delete');
    //agency
    Route::get('/agencies', 'AgencyController@index')->name('agencies');
    Route::post('/agencies', 'AgencyController@store')->name('agencies-store');
    Route::get('/agencies/{id}', 'AgencyController@show')->name('agencies-show');
    Route::put('/agencies/{id}', 'AgencyController@update')->name('agencies-update');
    Route::delete('/agencies/{id}', 'AgencyController@delete')->name('agencies-delete');
    //agency imates
    Route::get('/agency-images', 'AgencyImageController@index')->name('agency-images');
    Route::post('/agency-images', 'AgencyImageController@store')->name('agency-images-store');
    Route::get('/agency-images/{id}', 'AgencyImageController@show')->name('agency-images-show');
    Route::post('/agency-images-update', 'AgencyImageController@update')->name('agency-images-update');
    Route::delete('/agency-images/{id}', 'AgencyImageController@delete')->name('agency-images-delete');
});
