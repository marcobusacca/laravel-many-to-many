<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $form_data = $request->all();

        $technology = new Technology();

        $form_data['slug'] = $technology->generateSlug($form_data['name']);

        $technology->fill($form_data);

        $technology->save();

        return redirect()->route('admin.technologies.show', compact('technology'))->with('message', "Tecnologia : '$technology->name' Creata Correttamente");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->all();

        $form_data['slug'] = $technology->generateSlug($form_data['name']);

        $technology->update($form_data);

        return redirect()->route('admin.technologies.show', compact('technology'))->with('message', "Tecnologia : '$technology->name' Modificata Correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        // GESTIONE RELAZIONE MANY-TO-MANY (PROJECTS, TECHNOLOGY)

            $technology->projects()->detach();

        //

        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('message', "Tecnologia : '$technology->name' Cancellata Correttamente");
    }
}
