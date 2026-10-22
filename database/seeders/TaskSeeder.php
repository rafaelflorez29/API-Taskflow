<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@taskflow.test')->first();
        $projects = Project::with('participants')->get();

        foreach ($projects as $project) {
            foreach ($project->participants as $participant) {
                Task::factory(2)
                    ->for($project)
                    ->for($participant, 'assignee')
                    ->for($admin, 'creator')
                    ->create();
            }
        }
    }
}
