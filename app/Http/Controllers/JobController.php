<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use App\Respond;
use App\Mail\JobCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'DESC')->paginate(15);
        $jobs->setPath('/filter');
        
        $jobs_del = Job::all();
        foreach ($jobs_del as $job) {
            if (date('Y-m-d', strtotime($job->start_date. ' + 1 days')) <= date("Y-m-d", time())) {
                $job->delete();
            }
        }        

        setlocale(LC_ALL, 'ru_RU.UTF-8');
        return view('index',compact('jobs'));
    }

    public function SendResult()
    {
        $sends = '';
        
        if (Auth::check()) {
            $sends = Respond::select('send', 'job_id')
            ->where('user_id', auth()->id())
            ->get();
        }

        return $sends;
    }

    public function create()
    {
        return view('create-job');
    }

    public function store(Job $job, Request $request)
    {
        $end_date = date('Y-m-d', strtotime('+2 month'));
        $to_day = date("Y-m-d");
        $start_d = \DateTime::createFromFormat('d/m/Y', request("start_date"))->format('Y-m-d');
        $final_d = \DateTime::createFromFormat('d/m/Y', request("final_date"))->format('Y-m-d'); 
        $earlier = new \DateTime($start_d);
        $later =  new \DateTime($final_d);
        $diff = $later->diff($earlier)->format("%a");
        
        if ($to_day > $start_d || $start_d > $end_date) {
            $error = "В поле \"Начало\" дата указанна не корректно";
            return redirect()->back()->withErrors($error)->withInput($request->all());
        }
        if ($to_day > $final_d || $final_d > $end_date) {
            $error = "В поле \"Окончание\" дата указанна не корректно";
            return redirect()->back()->withErrors($error)->withInput($request->all());
        }

        $attributes = $this->validateJob();
        $attributes['deadline'] = $diff+1;
        $attributes['owner_id'] = auth()->id();
        $cost = str_replace(" ", "", request('cost'));
        $attributes['cost'] = (int)$cost;
        $attributes['start_date'] = $start_d;
        $attributes['final_date'] = $final_d;
        
        $job = Job::create($attributes);

        return redirect()->action('RespondController@show', [auth()->id()]);
    }

    public function show(Job $job)
    {        
        $owner = $job::find($job->id)->users()->first();
        
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        return view('job-info',compact('job','owner'));
    }

    public function edit(User $user,Job $job)
    {
        if ($user->id == auth()->id()) {
            return view('edit-job', compact('job'));
        }   
    }

    public function update(Request $request, Job $job)
    {

        $end_date = date('Y-m-d', strtotime('+1 month'));
        $to_day = date("Y-m-d");
        $start_d = \DateTime::createFromFormat('d/m/Y', request("start_date"))->format('Y-m-d');
        $final_d = \DateTime::createFromFormat('d/m/Y', request("final_date"))->format('Y-m-d'); 
        $earlier = new \DateTime($start_d);
        $later =  new \DateTime($final_d);
        $diff = $later->diff($earlier)->format("%a");
        
        if ($to_day > $start_d || $start_d > $end_date) {
            $error = "В поле \"Начало\" дата указанна не корректно";
            return redirect()->back()->withErrors($error)->withInput($request->all());
        }
        if ($to_day > $final_d || $final_d > $end_date) {
            $error = "В поле \"Окончание\" дата указанна не корректно";
            return redirect()->back()->withErrors($error)->withInput($request->all());
        }

        $job->update($this->validateJob());
        $cost = (int)str_replace(" ", "", request('cost'));
        $job->update(['cost' => $cost]);
        $job->update(['status' => null]);
        $job->update(['start_date' => $start_d]);
        $job->update(['final_date' => $final_d]);
        $job->update(['deadline' => $diff+1]);
        
        return redirect()->action('RespondController@show', [auth()->id()]);
    }

    public function destroy(User $user, Job $job)
    {
        $job->delete();
        return back();
    }

    public function filter(Request $request)
    {
        $jobs = Job::orderBy('id', 'DESC');

        if(!empty($request->category)){
            $jobs->where('category', 'like', "%$request->category%");
        }
        if(!empty($request->cost2) && !empty($request->cost1)){
            $jobs->whereBetween('cost',[$request->cost1,$request->cost2]);
        }
        else if(!empty($request->cost1)){
            $jobs->where('cost', '>=', $request->cost1);
        }
        else if(!empty($request->cost2)){
            $jobs->where('cost', '<=', $request->cost2);
        }
        if(!empty($request->region)){
            $jobs->where('region', 'like', "%$request->region%");
        }
        if(!empty($request->deadline2) && !empty($request->deadline1)){
            $jobs->whereBetween('deadline',[$request->deadline1,$request->deadline2]);
        }
        else if(!empty($request->deadline1)){
            $jobs->where('deadline', '>=', $request->deadline1);
        }
        else if(!empty($request->deadline2)){
            $jobs->where('deadline', '<=', $request->deadline2);
        }

        $jobs = $jobs->paginate(15)->appends([
            'category' => $request->category,
            'cost2' => $request->cost2,
            'cost1' => $request->cost1,
            'region' => $request->region,
            'deadline2' => $request->deadline2,
            'deadline1' => $request->deadline1,
        ]);        

        setlocale(LC_ALL, 'ru_RU.UTF-8');
        return view('filter', compact('jobs'));
    }

    public function xmlindex()
    {
        return view('sitemap');
    }

    public function validateJob()
    {
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'category' => ['required', 'min:3'],
            'num_persons' => ['required', 'min:1'],
            'region' => ['required'],
            'address' => ['required', 'min:3'],
        ]);
    }
}
