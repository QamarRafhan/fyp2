<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:' . config('application-auth.auth.guard'))
    ->as('api.')
    ->group(function () {

        // 


        Route::prefix('categories')
            ->as('category.')
            ->group(function () {

                Route::get('list')
                    ->uses('CategoryController@index')
                    ->name('list');
            });



        Route::prefix('companies')
            ->as('company.')
            ->group(function () {

                Route::get('list')
                    ->uses('CompanyController@index')
                    ->name('list');
            });

        Route::prefix('vehicles')
            ->as('vehicles.')
            ->group(function () {

                Route::get('list')
                    ->uses('VehicleController@index')
                    ->name('list');
            });

        Route::prefix('repairingRequest')
            ->as('repairingRequest.')
            ->group(function () {

                Route::get('list')
                    ->uses('RepairingRequestController@index')
                    ->name('list');
                Route::post('save')
                    ->uses('RepairingRequestController@store')
                    ->name('save');
            });


        Route::prefix('payment')
            ->as('payment.')
            ->group(function () {

                Route::post('pay')
                    ->uses('PaymentController@store')
                    ->name('store');
            });
        Route::prefix('mechanic')
            ->as('mechanic.')
            ->group(function () {

                Route::get('list')
                    ->uses('MechanicController@index')
                    ->name('list');


                Route::post('change_data')
                    ->uses('MechanicController@store')
                    ->name('store');
            });






        //flights and users searches 
        // Route::prefix('flight')
        //     ->as('flight.')
        //     ->group(function () {

        //         Route::get('list')
        //             ->uses('FlightController@index')
        //             ->name('list');
        //         Route::get('detail/{flight?}')
        //             ->uses('FlightController@show')
        //             ->name('show');
        //         Route::get('detail-by-no/{flight:flight_no?}')
        //             ->uses('FlightController@getOperator')
        //             ->name('detail');
        //     });



        // // Booking
        // Route::prefix('booking')
        //     ->as('booking.')
        //     ->group(function () {
        //         Route::get('list')
        //             ->uses('BookingController@index')
        //             ->name('list');
        //         Route::post('save')
        //             ->uses('BookingController@store')
        //             ->name('save');

        //         Route::get('{booking?}')
        //             ->uses('BookingController@show')
        //             ->name('show');

        //         Route::put('{booking}')
        //             ->uses('BookingController@update')
        //             ->name('update');

        //         Route::delete('{booking}')
        //             ->uses('BookingController@destroy')
        //             ->name('delete');
        //     });


        // // Notifications
        // Route::prefix('notification')
        //     ->as('notification.')
        //     ->group(function () {

        //         Route::get('/')
        //             ->uses('NotificationController@index')
        //             ->name('index');

        //         Route::get('read')
        //             ->uses('NotificationController@getReadNotifications')
        //             ->name('read');

        //         Route::get('unread')
        //             ->uses('NotificationController@getUnreadNotifications')
        //             ->name('unread');

        //         Route::get('unread/count')
        //             ->uses('NotificationController@getUnreadNotificationsCount')
        //             ->name('unread.count');

        //         Route::post('subscribe')
        //             ->uses('NotificationController@subscribe')
        //             ->name('subscribe');

        //         Route::post('unsubscribe')
        //             ->uses('NotificationController@unsubscribe')
        //             ->name('unsubscribe');

        //         Route::post('mark-all-as-read')
        //             ->uses('NotificationController@markAllAsRead')
        //             ->name('mark-all-as-read');

        //         Route::post('mark-as-read/{id}')
        //             ->uses('NotificationController@markAsRead')
        //             ->name('mark-as-read');

        //         Route::post('destroy')
        //             ->uses('NotificationController@destroy')
        //             ->name('destroy');
        //         Route::post('destroyAll')
        //             ->uses('NotificationController@destroyAll')
        //             ->name('destroyAll');
        //     });
    });
