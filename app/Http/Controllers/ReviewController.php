<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(){
        $user = Auth::user();
        $review = Review::all();
        return view('master.review.index',compact('review','user'));
    }

    public function updateReview(Request $request, $id){
        // update dari default(pending) ke aprove/declined
        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return redirect()->route('master.review.index')
                         ->with('success', 'Review updated successfully');
    }
}