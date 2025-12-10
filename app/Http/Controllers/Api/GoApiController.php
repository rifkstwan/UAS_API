<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoApiController extends Controller
{
    protected $goApiService;

    public function __construct()
    {
        $this->goApiService = new GoApiService();
    }

    // Endpoint 1: Get Weather
    public function getWeather(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->goApiService->getWeather($request->city);
        return response()->json($result, $result['success'] ? 200 : 400);
    }

    // Endpoint 2: Get Currency
    public function getCurrency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string',
            'to' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->goApiService->getCurrency($request->from, $request->to);
        return response()->json($result, $result['success'] ? 200 : 400);
    }

    // Endpoint 3: Get News
    public function getNews(Request $request)
    {
        $category = $request->get('category', 'technology');
        $result = $this->goApiService->getNews($category);
        return response()->json($result, $result['success'] ? 200 : 400);
    }

    // Endpoint 4: Post Data
    public function postData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payload' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->goApiService->postData($request->payload);
        return response()->json($result, $result['success'] ? 201 : 400);
    }
}
