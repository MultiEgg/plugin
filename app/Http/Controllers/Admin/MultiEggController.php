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
                'key'=>$key
        ]);
    }

    public function updateKeys(MultiEgg $multiegg, Request $request) {
        MultiEgg::where('id',1)->update(['license'=>$request->key]);
        if(Cache::has('multiegg_license_data')){ Cache::forget('multiegg_license_data'); }
        $this->cacheLicenseDetails();
        return redirect()->route('admin.multiegg.index');
    }

    public function checkKeyValid() {
        if(!Cache::has('multiegg_license_data')) { $this->cacheLicenseDetails; }
        $data = $this->cacheLicenseDetails();
    }

    public function cacheLicenseDetails() {
        if(!Cache::has('multiegg_license_data')) {
            $key = DB::select("select * from `multiegg` where `id`='1'");
            $build_url = "https://api.dev.multiegg.xyz/api/key/{$key[0]->license}/info/key";
            $res = Http::timeout(30)->get($build_url)->object();
            Cache::put('multiegg_license_data', $res, now()->addMinutes(60));
        }
        return Cache::get('multiegg_license_data');
    }

}
