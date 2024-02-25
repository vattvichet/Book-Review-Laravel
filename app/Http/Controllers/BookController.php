<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest\Store_BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    //
    public function index()
    {
        $books =  QueryBuilder::for(Book::class)
            ->allowedFilters(['title'])
            ->get();
        if ($books) {
            return response()->json([
                'data' => $books,
            ]);
        }
        return;
    }

    public function show($id)
    {
        $book = Book::with('reviews')->find($id);
        if ($book) {
            return response()->json([
                'data' => $book,
            ]);
        } else {
            return response()->json([
                'err' => 'ID Invalid',
            ]);
        }
    }

    public function store(Store_BookRequest $request)
    {
        $validated = $request->validated();
        $book = Book::create($validated);
        if ($book) {
            return response()->json([
                'message' => 'success',
                'data' => $book,
            ], 201);
        }
        return;
    }
}
