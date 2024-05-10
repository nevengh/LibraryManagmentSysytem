<?php

namespace App\Http\Controllers;

use App\Models\Author;

use App\Models\Book;
use App\Models\Review;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $review = Review::with('reviewable')->get();
            return $this->apiResponse(true, 'data back successfully', $review, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["there is something wrong in server"],500);
        }
    }


    public function storeBookReview(Request $request,Book $book)
    {
        try {
            $review = $book->reviews()->create([
                'content' =>$request->content,
                'rate'=>$request->rate,
            ]);
            return $this->apiResponse(true, 'data back successfully', $review, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["there is something wrong in server"],500);
        }
    }
    public function storeAuthorReview(Request $request,Author $author)
    {
        try {
            $review = $author->reviews()->create([
                'content' =>$request->content,
                'rate'=>$request->rate,
            ]);
            return $this->apiResponse(true, 'review created successfully', $review, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["there is something wrong in server"],500);
        }
    }

    public function show(Review $review)
    {
        try {
            return $this->apiResponse(true, 'data back successfully', $review, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["there is something wrong in server"],500);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return $this->apiResponse(true, 'review deleted successfully', $review, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(["there is something wrong in server"],500);
        }
    }

}
