<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function response()
    {
        $response = Http::get('https://dev.edwin.pcss.pl/api/meteo/v3/observationStation?type=WEATHER&active=true&page=0&size=20');

        if ($response->successful()) {
            $content = $response->json();
            $dataArray = json_decode(json_encode($content), true); // Convert JSON to array

            return dd(response()->json(['data' => $dataArray], 200));
        } else {
            $statusCode = $response->status();

            return response()->json(['message' => 'Error: ' . $statusCode], $statusCode);
        }
    }
}
