<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();
        User::create([
            'username' => 'AzeaKN',
            'full_name' => 'Azea Kirsten E. Natividad',
            'email' => 'aenatividad@feualabang.edu.ph',
        ]);

        $today = Carbon::today();
        $tasks = [
            ['title' => 'Review today’s priorities', 'status' => 'pending', 'task_date' => $today],
            ['title' => 'Finish the Laravel dashboard', 'status' => 'pending', 'task_date' => $today],
            ['title' => 'Check project requirements', 'status' => 'completed', 'task_date' => $today],
            ['title' => 'Prepare the weekly report', 'status' => 'pending', 'task_date' => $today->copy()->subDay()],
            ['title' => 'Organize study materials', 'status' => 'completed', 'task_date' => $today->copy()->subDay()],
            ['title' => 'Plan next week’s tasks', 'status' => 'pending', 'task_date' => $today->copy()->addDay()],
            ['title' => 'Back up project files', 'status' => 'pending', 'task_date' => $today->copy()->addDays(2)],
            ['title' => 'Write the project reflection', 'status' => 'pending', 'task_date' => $today->copy()->addDays(2)],
        ];

        Task::query()->delete();
        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
