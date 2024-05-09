<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Jobs\BookAdded;
use App\Jobs\BookBorrowed;
use App\Jobs\BookReturned;
use App\Models\Book;
use App\Traits\ApiResponseTrait;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponseTrait;

    //function to Get Data from Book

    public function index()
    {
        $book = Book::all();
        $book = Book::with('authors')->get();
        return $this->apiResponse(true, 'data back successfully', $book, Response::HTTP_OK);
    }

    //create data

    public function store(StoreBookRequest $request)
    {
        try {
            $book = Book::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
            // $book->authors()->attach($request->author_id);
            BookAdded::dispatch($book);
            $formattedDate = DateHelper::formatDateTime($book->created_at);
            return $this->apiResponse(true, 'data created successfully', $book,$formattedDate, Response::HTTP_CREATED);
        } catch (\Exception $error) {
            logger()->error($error);
            return $this->errorResponse('error at create data');
        }
    }
    // Show data by id

    public function show($id){
        $book = Book::find($id);
        $book->all();
        $formattedDate = DateHelper::formatDateTime($book->created_at);
        return $this->apiResponse(true, 'data back successfully', $book,$formattedDate, Response::HTTP_OK);

    }
    // Update Data

    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        try {
            $book->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return $this->apiResponse(true, 'data updated successfully', $book, Response::HTTP_OK);
        } catch (\Exception $error) {
            // Log the error

            logger()->error($error);


            // Return a custom error response

            return $this->errorResponse('error at updating data');
        }
    }

    // public function borrowBook(Request $request, $id)

    // {

    //     $book = Book::findOrFail($id);


    //     // Check if the book is available for borrowing

    //     if (!$book->isAvailable()) {

    //         return response()->json(['error' => 'The book is currently unavailable.'], 400);

    //     }


    //     // Mark the book as borrowed

    //     $book->borrow();
    //     // Dispatch the BookBorrowed job to send an email notification

    //     dispatch(new BookBorrowed($book));
    //     return response()->json(['message' => 'The book has been borrowed successfully.']);
    // }

    // public function returnedBook(Request $request, $id)

    // {

    //     $book = Book::findOrFail($id);


    //     // Check if the book is currently borrowed

    //     if (!$book->isBorrowed()) {

    //         return response()->json(['error' => 'The book is not currently borrowed.'], 400);

    //     }


    //     // Mark the book as returned

    //     $book->return();


    //     // Dispatch the BookReturned job to send an email notification

    //     dispatch(new BookReturned($book));


    //     return response()->json(['message' => 'The book has been returned successfully.']);

    // }



    // Delete Data

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return $this->apiResponse(true, 'data deleted successfully', $book, Response::HTTP_OK);
    }
}
