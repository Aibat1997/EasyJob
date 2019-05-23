<?php

namespace App\Http\Controllers;

use App\Respond;
use App\Job;
use App\Rating;
use App\User;
use App\Mail\OfferSended;
use App\Mail\RespondSended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RespondController extends Controller
{
    public function index(Respond $respond)
    {
        $responds = Respond::select('jobs.title','jobs.cost','responds.status','responds.job_id','users.tel_number')
        ->leftJoin('jobs', 'responds.job_id', '=', 'jobs.id')
        ->leftJoin('users', 'jobs.owner_id', '=', 'users.id')
        ->where('responds.user_id', auth()->id())
        ->get();
        return view('respond',compact('responds'));
    }

    public function store(Request $request)
    {
        $attributes['job_id'] = $request->job_id;
        $attributes['user_id'] = auth()->id();
        $attributes['send'] = $request->offer;
        Respond::create($attributes);

        $ow_id = Job::select('owner_id')->where('id', $request->job_id)->first();
        $att['owner_id'] = $ow_id->owner_id;
        $att['job_id'] = $request->job_id;
        $att['user_id'] = auth()->id();
        Rating::create($att);

        $owner_email = Job::select('users.email')
            ->leftJoin('users', 'jobs.owner_id', '=', 'users.id')
            ->where('jobs.id', $request->job_id)
            ->first();
        $job = Job::where('id', $request->job_id)->first();
        Mail::to($owner_email->email)->queue(new OfferSended($job));
        
        return back();
    }

    public function show(Respond $respond,Job $job)
    {
        $jobs = Job::where('owner_id', auth()->id())->get();
    
        $responds = Respond::select('users.name','responds.job_id','responds.id','responds.status','responds.user_id','users.date_of_birth','users.tel_number','users.skills')
        ->leftJoin('users', 'responds.user_id', '=', 'users.id')
        ->get();

        return view('offers',compact('jobs', 'responds'));
    }

    public function OfferJson(Respond $respond,Job $job)
    {    
        $responds = Respond::select('users.name','responds.job_id','responds.id','responds.status','responds.user_id','users.date_of_birth','users.tel_number','users.skills')
        ->leftJoin('users', 'responds.user_id', '=', 'users.id')
        ->get();

        return $responds;
    }

    public function update(Request $request, Respond $respond)
    {
        $respond = Respond::where('id', $request->resp_id)
        ->update(['status' => $request->status]);

        if ($request->status == 1) {
            $resp_email = Respond::select('users.email')
            ->leftJoin('users', 'responds.user_id', '=', 'users.id')
            ->where('responds.id', $request->resp_id)
            ->first();
            $job = Respond::select('jobs.title')
                ->leftJoin('jobs', 'responds.job_id', '=', 'jobs.id')
                ->where('responds.id', $request->resp_id)
                ->first();
            Mail::to($resp_email->email)->queue(new RespondSended($job->title));
        }

        return back();
    }

}
