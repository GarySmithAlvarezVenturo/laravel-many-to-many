<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('projects') as $objProject) {

            $slug = Project::slugger($objProject['title']);
            $project = Project::create([
                "title"         => $objProject['title'],
                'slug'          => $slug,
                "author"        => $objProject['author'],
                "creation_date" => $objProject['creation_date'],
                "last_update"   => $objProject['last_update'],
                "collaborators" => $objProject['collaborators'],
                "description"   => $objProject['description'],
                "link_github"   => $objProject['link_github'],
                "type_id"       => $objProject['type_id'],
            ]);

            $project->languages()->sync($objProject['languages']);

        }
    }
}
