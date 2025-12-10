<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoApiController extends Controller
{
    /**
     * Endpoint 1: Get Weather
     * Method: GET
     * Protected: Yes (Requires Bearer Token)
     * Parameters: city (required)
     */
    public function getWeather(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'city' => 'required|string|max:100'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'city' => $request->city,
                    'temperature' => '28°C',
                    'condition' => 'Sunny',
                    'humidity' => '65%',
                    'timestamp' => now()->toIso8601String()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint 2: Get Currency
     * Method: GET
     * Protected: Yes (Requires Bearer Token)
     * Parameters: from (required, 3 chars), to (required, 3 chars)
     */
    public function getCurrency(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'from' => 'required|string|size:3',
                'to' => 'required|string|size:3'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'from' => strtoupper($request->from),
                    'to' => strtoupper($request->to),
                    'rate' => 15750.50,
                    'amount' => 1,
                    'timestamp' => now()->toIso8601String()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint 3: Get News
     * Method: GET
     * Protected: Yes (Requires Bearer Token)
     * Parameters: category (optional, default: technology)
     */
    public function getNews(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category' => 'sometimes|string|max:50'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $category = $request->get('category', 'technology');

            return response()->json([
                'success' => true,
                'data' => [
                    'category' => $category,
                    'total' => 2,
                    'articles' => [
                        [
                            'id' => 1,
                            'title' => 'Latest ' . ucfirst($category) . ' News 1',
                            'description' => 'This is a sample ' . $category . ' news article',
                            'date' => now()->subDay()->toDateString(),
                            'source' => 'API Server'
                        ],
                        [
                            'id' => 2,
                            'title' => 'Latest ' . ucfirst($category) . ' News 2',
                            'description' => 'Another sample ' . $category . ' news article',
                            'date' => now()->toDateString(),
                            'source' => 'API Server'
                        ]
                    ],
                    'timestamp' => now()->toIso8601String()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint 4: Post Data
     * Method: POST
     * Protected: Yes (Requires Bearer Token)
     * Parameters: payload (required, array)
     */
    public function postData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'payload' => 'required|array|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data received successfully',
                'data' => [
                    'id' => uniqid(),
                    'received_payload' => $request->payload,
                    'timestamp' => now()->toIso8601String()
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
