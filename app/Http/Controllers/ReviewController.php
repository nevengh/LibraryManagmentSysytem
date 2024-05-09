<?php

namespace App\Http\Controllers;

use App\Models\Author;

use App\Models\Book;
use App\Models\Review;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $reviews = Review::all();
        return $this->apiResponse(true, 'data back successfully', $reviews, Response::HTTP_OK);
    }

    public function show($id)
    {
        $book = Book::find($id);

        $reviews = $book->reviews;

        return $this->apiResponse(true, 'data back successfully', $reviews, Response::HTTP_OK);
    }

    public function store(Request $request,$id)
    {
        $book = Book::find($id);

        $review = Review::create([

            'content' => $request->content,

            'rate' => $request->rate,
            // 'reviewable' => $request->reviewable,
        ]);

        $book->reviews()->save($review);
    }

    public function storeAuthorReview(Request $request, $id)
    {
        $author = Author::find($id);

        $review = Review::create([

            'content' => $request->content,

            'rate' => $request->rate,

        ]);

        $author->reviews()->save($review);
    }

}
