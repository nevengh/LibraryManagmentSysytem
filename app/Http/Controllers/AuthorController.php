<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $author = Author::all();
        $author = Author::with('books','reviews')->get();

        return $this->apiResponse(true, 'data back successfully', $author, Response::HTTP_OK);
    }

    //create data

    public function store(StoreAuthorRequest $request)
    {
        try {
            $author = Author::create([
                'name' => $request->name,
                'bio' => $request->bio
            ]);
            // $author->books()->attach($request->book_id);
            $formattedDate = DateHelper::formatDateTime($author->created_at);
            return $this->apiResponse(true, 'data created successfully', $author,$formattedDate, Response::HTTP_CREATED);
        } catch (\Exception $error) {
            logger()->error($error);
            return $this->errorResponse('error at create data');
        }
    }

    // Show data by id

    public function show($id){
        $author = Author::find($id);
        $author->all();
        $author = Author::with('books')->get();
        return $this->apiResponse(true, 'data back successfully', $author, Response::HTTP_OK);
    }

    // Update Data

    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = Author::find($id);
        try {

            $author->update([
                'name' => $request->name,
                'bio' => $request->bio
            ]);
            // $author->books()->attach($request->book_id);
            return $this->apiResponse(true, 'data updated successfully', $author, Response::HTTP_OK);
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
        $author = Author::find($id);
        $author->delete();
        return $this->apiResponse(true, 'data deleted successfully', $author, Response::HTTP_OK);
    }
}
