<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function (Request $request) {
        dd($request->getHost());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    Route::get('/file', function () {
        return view('testFile');
    });
    Route::post('/store', function (Request $request) {
        if ($request->hasFile('file')) {
            $storage_path = storage_path();
            $file = $request->file('file');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'Logo.' . $file_ext;
            Storage::putFileAs('public/company', $file, $file_name);
            // $request->file('file')->storeAs('public/company', $file_name);
            return asset('company/Logo.jpeg');
        }
    });
});
