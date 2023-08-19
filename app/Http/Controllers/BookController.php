<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $book = new Books;
        $book->task = $request->task;
        $book->save();

        return response()->json([
            "message" => "Book added."
        ], 201);
    }



    public function show($id) 
    {
        $book = Books::find($id);
        if(!empty($book))
        {
            return response()->json($book);
        }
        else
        {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->task = is_null($request->task) ? $book->task : $request->task;
            $book->save();

            return response()->json([
                "message" => "Book updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "Book not found."
            ], 404);
        }
    }



    public function destroy($id)
    {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->delete();

            return response()->json([
                "message" => "records deleted."
            ], 202);
        }else{
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}
