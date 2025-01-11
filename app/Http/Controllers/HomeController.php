<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ip = "152.58.216.180";
        $request_ip = $request->ip();
        $data = Location::get($request_ip); 
        if (!$data) {
            $data = Location::get($ip);
        }

        $userLocation = $data->cityName.', '.$data->regionName.', '.$data->countryName;
        $userLatitude = $data->latitude;
        $userLongitude = $data->longitude;

        $stores = Store::select('*')
            ->selectRaw("(
                6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )
            ) AS distance", [$userLatitude, $userLongitude, $userLatitude])
            ->where('status', 1)
            ->orderBy('distance')
            ->get();
        
        return view('welcome', compact('userLocation', 'stores'));
    }

}
