<?php

namespace App\Http\Controllers;

use App\User;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        $star = Rating::select('rating')
        ->where('user_id', auth()->id())
        ->first();
        return view('profile', compact('star'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($this->validateUser());
        $birth = \DateTime::createFromFormat('d/m/Y', request("date_of_birth"))->format('Y-m-d');
        $user->update(['date_of_birth' => $birth]);
        
        return back();
    }

    public function validateUser()
    {
        if(!empty(request('skills'))){
            return request()->validate([
                'name' => ['required', 'string', 'max:70'],
                'email' => ['required', 'string', 'email', 'max:70'],
                'tel_number' => ['required', 'string', 'max:17'],
                'skills' => ['required'],
            ]);
        }
        return request()->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:70'],
            'tel_number' => ['required', 'string', 'max:17'],
        ]);
    }
}
