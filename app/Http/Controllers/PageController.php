<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $tasks = Task::whereDate('task_date', Carbon::today())
            ->orderBy('id')
            ->get();

        return view('home', compact('tasks'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function profile(): View
    {
        $user = User::firstOrFail();

        return view('profile', compact('user'));
    }
}
