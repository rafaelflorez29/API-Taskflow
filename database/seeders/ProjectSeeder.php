<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@taskflow.test')->first();
        $collaborators = User::where('email', '!=', 'admin@taskflow.test')->get();

        Project::factory(4)
            ->for($admin, 'creator')
            ->create()
            ->each(function (Project $project) use ($collaborators) {
                $participants = $collaborators->random(3);
                $project->participants()->attach($participants);
            });
    }
}
