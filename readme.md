First of thank you so much for purchasing MultiEgg Premium! Hope you enjoy this BETA addon. This is a simple install as most of it you just have to upload to your /var/www/pterodactyl directory. If you need any support contact us at our discord server: https://discord.gg/z4ZFaXUZMa 

NOTE:
You will be able to install this wiithout a licnese, but if you remove the license checker from the plugin, our api will slap your panel (Destroy) straight across the face. YOU HAVE BEEN WARNED.

1. In routes/admin.php

Under all file contents add:

/*
|--------------------------------------------------------------------------
| MultiEgg Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /admin/multiegg
|
*/
Route::group(['prefix' => 'multiegg'], function () {
    Route::get('/', [Admin\MultiEggController::class, 'index'])->name('admin.multiegg.index');
    Route::get('/lite', [Admin\MultiEggController::class, 'lite'])->name('admin.multiegg.lite');
    Route::get('/plus', [Admin\MultiEggController::class, 'plus'])->name('admin.multiegg.plus');
    Route::get('/pro', [Admin\MultiEggController::class, 'pro'])->name('admin.multiegg.pro');
    Route::get('/support', [Admin\MultiEggController::class, 'support'])->name('admin.multiegg.support');
    Route::get('/api/clearcache', [Admin\MultiEggController::class, 'clearCache']);

    Route::post('/edit', [Admin\MultiEggController::class, 'update'])->name('admin.multiegg.edit');
});


2. In resources/views/layouts/admin.blade.php

Above:

<li class="{{ ! starts_with(Route::currentRouteName(), 'admin.nests') ?: 'active' }}">

Add:

<li class="{{ ! starts_with(Route::currentRouteName(), 'admin.multiegg') ?: 'active' }}">
                            <a href="{{ route('admin.multiegg.index') }}">
                                <i class="fa fa-gears"></i> <span>MultiEgg</span>
                            </a>
                        </li>
                        
3. Easy right? now finish it off by running our script:

bash <(curl -s https://api.multiegg.xyz/addon/install.sh)
