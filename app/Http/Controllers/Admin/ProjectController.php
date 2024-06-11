<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Type;

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

        $data = [
            'projects' => $projects
        ];
        
        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        // dd($types);
        return view('admin.projects.create', compact('types'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|min:4|max:100|unique:projects,name',
                'client_name'=> 'required|min:1|max:100',
                'summary'=> 'nullable|min:5',
                'type_id'=> 'nullable|exists:types,id'
            ]
        );

        $formData = $request->all();
        // dd($formData);

        $newProject = new Project();
        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->name, '-');
        // dd($newProject);
        $newProject->save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOrFail($id);
        // dd($project->type);
        $data = [
            'project' => $project
        ];

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // dd($project);
        $data =[
            'project' => $project
        ];

        $types = Type::all();
        return view('admin.projects.edit', $data, compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                // 'name'=> 'required|min:4|max:100|unique:projects,name',
                'name'=> [
                    'required',
                    'min:4',
                    'max:100',
                    // 'unique:projects,name',

                    Rule::unique('projects')->ignore($project)
                ],
                'client_name'=> 'required|min:1|max:100',
                'summary'=> 'nullable|min:5',
                'type_id'=> 'nullable|exists:types,id'
            ]
        );

        $formData = $request->all();
        $formData['slug'] = Str::slug($formData['name'], '-');
        // dd($formData);
        $project->update($formData);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // dd($project);
        $project->delete();

        return redirect()->route('admin.projects.index');

    }
}
