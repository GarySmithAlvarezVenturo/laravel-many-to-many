<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:4|max:50',
        'author'        => 'required|string|max:30',
        'image'         => 'nullable|image|max:1024',
        'creation_date' => 'required|date',
        'last_update'   => 'required|date',
        'collaborators' => 'nullable|string|max:150',
        'description'   => 'nullable|string',
        //'languages'     => 'required|string|max:50',
        'link_github'   => 'required|string|max:150',
        'type_id'       => 'required|integer|exists:types,id',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $languages = Language::all();
        return view('Admin.projects.create', compact('types', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati 
        $request->validate($this->validations);

        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);
        // Salvare i dati nel database
        $newProject                 = new Project();
        $newProject->title          = $data['title'];
        $Project->image             = $imagePath;
        $newProject->slug           = Project::slugger($data['title']);
        $newProject->author         = $data['author'];
        $newProject->creation_date  = $data['creation_date'];
        $newProject->last_update    = $data['last_update'];
        $newProject->collaborators  = $data['collaborators'];
        $newProject->description    = $data['description'];
        // $newProject->languages   = $data['languages'];
        $newProject->link_github    = $data['link_github'];
        $newProject->type_id        = $data['type_id'];
        $newProject->save();

        $newProject->languages()->sync($data['languages'] ?? []);

        return redirect()->route('admin.project.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types = Type::all();
        $languages = Language::all();
        return view('admin.projects.edit', compact('project', 'types', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        // validare i dati 
        $request->validate($this->validations);

        $data = $request->all();

        if ($data['image']) {

            // Per salvare la nuova immagine
            $imagePath = Storage::put('uploads', $data['image']);

            // per eliminare la vecchia immagine

            Storage::delete($project->image);
            
            $project->image         = $imagePath;
        }

        Storage::delete($project->image);
        // Salvare i dati nel database
        $project->title             = $data['title'];
        $project->author            = $data['author'];
        // $project->image             = $imagePath;
        $project->creation_date     = $data['creation_date'];
        $project->last_update       = $data['last_update'];
        $project->collaborators     = $data['collaborators'];
        $project->description       = $data['description'];
        //$project->languages        = $data['languages'];
        $project->link_github       = $data['link_github'];
        $project->type_id           = $data['type_id'];
        $project->update();

        $project->languages()->sync($data['languages'] ?? []);

        return redirect()->route('admin.project.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();

        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($slug)
    {
           
        $project = Project::find($slug);
        Project::withTrashed()->where('slug', $slug)->restore();
        $project = Project::where('slug', $slug)->firstOrFail();

        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        // $projects = project::all(); // SELECT * FROM `projects`
        $trashedProjects = Project::onlyTrashed()->paginate(6);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($slug)
    {
         $project = Project::withTrashed()->where('slug', $slug)->first();
        // $project = Project::where('slug', $slug)->firstOrFail();
        
        $project->languages()->detach();
        $project->forceDelete();

        return to_route('admin.project.trashed')->with('delete_success', $project);
    }

    public function cancel($slug)
    {
        Project::withTrashed()->where('slug', $slug)->restore();
        $project = Project::where('slug', $slug)->firstOrFail();

        $project = Project::find($slug);

        return to_route('admin.project.index')->with('cancel_success', $project);
    }
}
