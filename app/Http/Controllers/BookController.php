<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
            return $this->apiResponse(true, 'data created successfully', $book, Response::HTTP_CREATED);
        } catch (\Exception $error) {
            logger()->error($error);
            return $this->errorResponse('error at create data');
        }
    }
    // Show data by id

    public function show($id){
        $book = Book::find($id);
        $book->all();
        return $this->apiResponse(true, 'data back successfully', $book, Response::HTTP_OK);
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

    // Delete Data

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return $this->apiResponse(true, 'data deleted successfully', $book, Response::HTTP_OK);
    }
}
