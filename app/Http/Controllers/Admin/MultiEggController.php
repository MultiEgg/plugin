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
        return $this->view->make('admin.multiegg.index',['version'=>$this->version]);
    }

}