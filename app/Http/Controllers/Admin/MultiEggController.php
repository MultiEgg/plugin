<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use DB;
use DateTime;
use Illuminate\View\View;
use Pterodactyl\Models\MultiEgg;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Helpers\SoftwareVersionService;
use Prologue\Alerts\AlertsMessageBag;


class MultiEggController extends Controller
{
    /**
     * MultiEggController constructor.
     */
    public function __construct(
        private AlertsMessageBag $alert,
        private SoftwareVersionService $version,
        private ViewFactory $view
    ) {
    }

    public function index() {
        $key = DB::select("select * from `multiegg` where `id`='1'");
        return $this->view->make('admin.multiegg.index',[
                'version'=>$this->version,
                'key'=>$key,
                'is_valid'=>$this->checkKeyValid()
        ]);
    }

    public function updateKeys(MultiEgg $multiegg, Request $request) {
        MultiEgg::where('id',1)->update(['license'=>$request->key]);
        if(Cache::has('multiegg_license_data')){ Cache::forget('multiegg_license_data'); }
        if(Cache::has('multiegg_license_brand')){ Cache::forget('multiegg_license_brand'); }
        if(Cache::has('multiegg_license_perm')){ Cache::forget('multiegg_license_perm'); }
        if(Cache::has('multiegg_license_toggle')){ Cache::forget('multiegg_license_toggle'); }
        $this->cacheLicenseDetails();
        return redirect()->route('admin.multiegg.index');
    }

    public function checkKeyValid() {
        if(!Cache::has('multiegg_license_data_key')) { $this->cacheLicenseDetails(); }
        $data = Cache::get('multiegg_license_data_key');
        if($data->error == (!isset($data->error) || null || true)) { return "error"; }
        if($data->data->suspended == (!isset($data->data->suspended) || null || "1" || 1)) { return "suspended"; }
        return "1";
    }

    public function cacheLicenseDetails() {
        if(!Cache::has('multiegg_license_data')) {
            $key = DB::select("select * from `multiegg` where `id`='1'");
            $key_info = "https://api.dev.multiegg.xyz/api/key/{$key[0]->license}/info/key";
            $brand_info = "https://api.dev.multiegg.xyz/api/key/{$key[0]->license}/info/branding";
            $perm_info = "https://api.dev.multiegg.xyz/api/key/{$key[0]->license}/info/perms";
            $toggle_info = "https://api.dev.multiegg.xyz/api/key/{$key[0]->license}/info/gtoggle";

            $key_res = Http::timeout(30)->get($key_info)->object();
            $brand_res = Http::timeout(30)->get($brand_info)->object();
            $perm_res = Http::timeout(30)->get($perm_info)->object();
            $toggle_res = Http::timeout(30)->get($toggle_info)->object();

            Cache::put('multiegg_license_data_key', $key_res, now()->addMinutes(60));
            Cache::put('multiegg_license_data_brand', $brand_res, now()->addMinutes(60));
            Cache::put('multiegg_license_data_perm', $perm_res, now()->addMinutes(60));
            Cache::put('multiegg_license_data_toggle', $toggle_res, now()->addMinutes(60));
        }
    }

}
