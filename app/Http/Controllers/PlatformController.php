<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;
use Exception;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $platforms = Platform::all();
            return response()->json($platforms, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, Platform::$validationRules);
            $platform = new Platform();
            $platform->name = $request->name;
            $platform->save();
            return response()->json($platform, 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Platform $platform)
    {
        try {
            return response()->json($platform, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Platform $platform)
    {
        try {
            $this->validate($request, Platform::$validationRules);
            $platform->name = $request->name;
            $platform->save();
            return response()->json($platform, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Platform $platform)
    {
        try {
            $platform->delete();
            return response()->json([
                "message" => "Deleted successfully",
            ], 205);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }

    /**
     * Return all platforms by search
     */
    public function search(Request $request)
    {
        try {
            return response()->json(Platform::orderBy("updated_at", "desc")->where('name', 'LIKE', '%' . $request->search . '%')->get(), 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }
}
