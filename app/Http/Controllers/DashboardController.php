<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    /**
     * Service to handle dashboard-related logic 
     * and separating it from the controller
     * 
     * @var DashboardService
     */
    protected $dashboardService;

    /**
     * DashboardController constructor
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the DashboardSerivce to handle dashboard-related logic
        $this->dashboardService = $dashboardService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counts = $this->dashboardService->getInfo();

        return view('new-dashboard.dashboard.dashboard', [
            'counts' => $counts,
        ]);
    }
}
