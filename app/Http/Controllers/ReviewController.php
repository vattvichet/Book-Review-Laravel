<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest\Store_ReviewRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Store_ReviewRequest $request)
    {
        $validated = $request->validated();
        if (Book::find($validated['book_id'])) {
            $review = Review::create($validated);
            return $review;
        }
        return "ID Invalid";
    }
}
