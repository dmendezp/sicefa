<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CAFETO\Http\Controllers\PUW;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;

class CAFETOController extends Controller
{
    /**
     * Carga data compartida para los dashboards por rol.
     */
    private function getDashboardData(): array
    {
        $view = [
            'titlePage' => trans('cafeto::mainPage.TitlePage') ?: 'Welcome to CAFETO',
            'titleView' => trans('cafeto::mainPage.TitleWelcome') ?: 'Welcome'
        ];

        $puw = PUW::getAppPuw();

        // Populares por token [POP] o [POP:1..4]
        // NO filtres por amount>0, para no perder populares con stock 0
        $popularElementIds = Inventory::query()
            ->where('productive_unit_warehouse_id', $puw->id)
            ->whereNotNull('description')
            ->where('description', 'like', '%[POP%')
            ->pluck('element_id')
            ->unique()
            ->values()
            ->toArray();

        $popularProducts = Element::query()
            ->whereIn('id', $popularElementIds)
            ->orderBy('name', 'ASC')
            ->take(4)
            ->get();

        return compact('view', 'popularProducts');
    }

    /**
     * Landing pública (mantiene tu comportamiento actual)
     */
    public function index()
    {
        $data = $this->getDashboardData();
        return view('cafeto::admin-index', $data);
    }

    /**
     * Home Admin (mantiene tu vista actual)
     */
    public function admin()
    {
        $data = $this->getDashboardData();
        return view('cafeto::admin-index', $data);
    }

    /**
     * ✅ Home Cashier (NUEVA VISTA: cafeto::cashier-index)
     */
    public function cashier()
    {
        $data = $this->getDashboardData();
        return view('cafeto::cashier-index', $data);
    }

    /**
     * ✅ Home Instructor (NUEVA VISTA: cafeto::instructor-index)
     */
    public function instructor()
    {
        $data = $this->getDashboardData();
        return view('cafeto::instructor-index', $data);
    }

    public function devs()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_devs_title_page') ?: 'Developers',
            'titleView' => trans('cafeto::controllers.CAFETO_devs_title_view') ?: 'Our Team'
        ];
        return view('cafeto::developers.index', compact('view'));
    }

    public function info()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_info_title_page') ?: 'Information',
            'titleView' => trans('cafeto::controllers.CAFETO_info_title_page') ?: 'About Us'
        ];
        return view('cafeto::information.index', compact('view'));
    }

    public function configuration()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_configuration_title_page') ?: 'Configuration',
            'titleView' => trans('cafeto::controllers.CAFETO_configuration_title_view') ?: 'Settings'
        ];
        return view('cafeto::configuration.index', compact('view'));
    }
}
