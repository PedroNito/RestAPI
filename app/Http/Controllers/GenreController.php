<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Exception;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $genres = Genre::all();
            return response()->json($genres, 200);
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
            $this->validate($request, Genre::$validationRules);
            $genre = new Genre();
            $genre->name = $request->name;
            $genre->save();
            return response()->json($genre, 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Genre $genre)
    {
        try {
            return response()->json($genre, 200);
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
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Genre $genre)
    {
        try {
            $this->validate($request, Genre::$validationRules);
            $genre->name = $request->name;
            $genre->save();
            return response()->json($genre, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Error: ' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();
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
     * Return all todos by search
     */
    public function search(Request $request)
    {
        try {
            return response()->json(Genre::orderBy("updated_at", "desc")->where('name', 'LIKE', '%' . $request->search . '%')->get(), 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }
}
