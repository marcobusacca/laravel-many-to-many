<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();
        
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();

        // GESTIONE UPLOAD DEI FILE (COVER_IMAGE)

            if($request->hasFile('cover_image')){
                
                $img_path = Storage::put('projects_images', $request->cover_image);
                
                $form_data['cover_image'] = $img_path;
            }

        //

        $project = new Project();

        $project->fill($form_data);

        $project->save();

        // GESTIONE RELAZIONE MANY-TO-MANY (PROJECTS, TECHNOLOGY)

            if ($request->has('technologies')){

                $project->technologies()->attach($request->technologies);
            }

        //

        return redirect()->route('admin.projects.show', compact('project'))->with('message', "Progetto : '$project->title' Creato Correttamente");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        // GESTIONE UPLOAD DEI FILE (COVER_IMAGE)

            if($request->hasFile('cover_image')){

                if($project->cover_image){

                    Storage::delete($project->cover_image);
                }
                
                $img_path = Storage::put('projects_images', $request->cover_image);
                
                $form_data['cover_image'] = $img_path;
            }

        //

        $project->update($form_data);

        // GESTIONE RELAZIONE MANY-TO-MANY (PROJECTS, TECHNOLOGY)

            if ($request->has('technologies')){

                $project->technologies()->sync($request->technologies);
            }

        //

        return redirect()->route('admin.projects.show', compact('project'))->with('message', "Progetto : '$project->title' Modificato Correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // GESTIONE CANCELLAZIONE DEI FILE (COVER_IMAGE)

            if($project->cover_image){

                Storage::delete($project->cover_image);
            }

        //

        // GESTIONE RELAZIONE MANY-TO-MANY (PROJECTS, TECHNOLOGY)

            $project->technologies()->detach();

        //

        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "Progetto : '$project->title' Cancellato Correttamente");
    }

    public function deleteCoverImage(Project $project)
    {
        if($project->cover_image){

            Storage::delete($project->cover_image);

            $project->cover_image = NULL;

            $project->update();
        }
        
        return redirect()->route('admin.projects.edit', compact('project'));
    }
}