<?php

namespace App\Http\Controllers;

use App\Moderator;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ModeratorController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::all();
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        return view('moderator-index', compact('jobs'));
    }

    protected function create(Request $request)
    {
        $moderators = Moderator::all();
        if ($moderators->count() > 0) {
            foreach ($moderators as $moderator) {
                if ($moderator->tel_number === $request->tel_number) {
                    $error_check = "Такой пользователь уже существует";
                    return view('moderator-reg', compact('error_check'));
                }
            } 
            $attributes = $this->validateModerator();
            $attributes['password'] = Hash::make($request['password']);       
            Moderator::create($attributes);
            $request->session()->put('moderator', 'true');
            return redirect('/moderator_side/page_for_login_moderator/index');
            
        }
        else {
            $attributes = $this->validateModerator();
            $attributes['password'] = Hash::make($request['password']);       
            Moderator::create($attributes);
            $request->session()->put('moderator', 'true');
            return redirect('/moderator_side/page_for_login_moderator/index');
        }
    }

    public function update(Request $request)
    {
        Job::where('id', $request->job_id)
        ->update(['status' => $request->status]);

        return back();
    }

    public function check(Request $request)
    {
        $moderators = Moderator::all();
        foreach ($moderators as $moderator) {
            if ($moderator->tel_number === $request->tel_number && Hash::check($request->password, $moderator->password)) {
                $request->session()->put('moderator', 'true');
                return redirect('/moderator_side/page_for_login_moderator/index');
            }
        }
        return back();
    }

    public function register(Request $request)
    {
        $request->session()->forget('moderator');
        return view('moderator-reg');
    }

    public function login(Request $request)
    {
        $request->session()->forget('moderator');
        return view('moderator-login');
    }
    
    public function validateModerator()
    {
        return request()->validate([
            'tel_number' => ['required', 'string', 'max:17'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    public function JobJson(Request $request)
    {
        return Job::all();
    }
}
