<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Exception;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $games = Game::all()->load("genres", "platforms");
            return response()->json($games, 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
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
            $this->validate($request, Game::$validationRules);
            $game = new Game();
            $game->title = $request->title;
            $game->released = $request->released;
            $game->director = $request->director;
            $game->critic_score = $request->critic_score;
            $game->user_score = $request->user_score;
            $game->save();
            $game->genres()->sync($request->genres);
            $game->platforms()->sync($request->platforms);
            return response()->json($game, 201);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Game $game)
    {
        try {
            $game = $game->load("genres", "platforms");
            return response()->json($game, 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Game $game)
    {
        try {
            $this->validate($request, Game::$validationRules);
            $game->title = $request->title;
            $game->released = $request->released;
            $game->director = $request->director;
            $game->critic_score = $request->critic_score;
            $game->user_score = $request->user_score;
            $game->save();
            $game->genres()->sync($request->genres);
            $game->platforms()->sync($request->platforms);
            return response()->json($game, 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Game $game)
    {
        try {
            $game->genres()->detach();
            $game->platforms()->detach();
            $game->delete();
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
     * Return all games by search
     */
    public function search(Request $request)
    {
        try {
            return response()->json(Game::orderBy("updated_at", "desc")->where('title', 'LIKE', '%' . $request->search . '%')->get(), 200);
        } catch (Exception $exception) {
            return response()->json([
                "message" => "Error: " . $exception,
            ], 500);
        }
    }
}
