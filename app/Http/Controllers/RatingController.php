<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function RatingJson()
    {    
        $rating = Rating::select('rating', 'job_id', 'user_id','owner_id')->get();

        return $rating;
    }
    
    public function update(Request $request, Rating $rating)
    {
        $respond = Rating::where('job_id', $request->job_id)
        ->where('owner_id', auth()->id())
        ->where('user_id', $request->user_id)
        ->update(['rating' => $request->rating]);

        return back();
    }

}
