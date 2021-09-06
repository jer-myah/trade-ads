<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function adminDashboard() {
        $total_users = User::where('role', '!=', 'administrator')->count();
        $total_traders = User::where('role', '=', '*-trader')->count();
        $total_ads = Advert::count();
        $total_links = Link::count();
        return Inertia::render('Admin/Dashboard', [
            'total_users' => $total_users,
            'total_traders' => $total_traders,
            'total_ads' => $total_ads,
            'total_links' => $total_links,
            ]);
    }
}
