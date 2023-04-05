<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function createReview(Request $request)
    {try {
        //code...

        $pizzaId = $request->input('pizza_id');
        $userId = auth()->user()->id;
        $review = request()->input('review');

        $newReview = new Review();
        $newReview->pizza_id = $pizzaId;
        $newReview->user_id = $userId;
        $newReview->review = $review;
        $newReview->save();

        return response()->json(
            [
                "success" => true,
                "message" => "New Review created",
                "data" => $newReview
            ],
            200
        );

    } catch (\Throwable $th) {
        //throw $th;
        Log::error("Creating Review Error: ".$th->getMessage());

        return response()->json(
            [
                "success" => false,
                "message" => "Error Creating Review"
            ], 
            500
        );
    }}
}
