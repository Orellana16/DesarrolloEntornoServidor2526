<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $weather = null;
        $alert = false;

        if ($user->latitude) {
            $apiKey = 'TU_API_OPENWEATHER'; // KEY
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'lat' => $user->latitude,
                'lon' => $user->longitude,
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'es'
            ]);

            if ($response->successful()) {
                $weather = $response->json();
                // Lógica de Alerta: Si llueve, nieva o hay tormenta
                $main = $weather['weather'][0]['main'];
                if (in_array($main, ['Rain', 'Snow', 'Thunderstorm', 'Drizzle'])) {
                    $alert = true;
                }
            }
        }
        return view('dashboard', compact('weather', 'alert'));
    }
}
