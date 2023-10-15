<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Field;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $project_allowed = [];
        foreach ($projects as $project) {
            if (Auth::user()->hasRole('super-admin') || $project->user_id == Auth::user()->id || $project->isProjectMember(Auth::user()->id)) {
                array_push($project_allowed, $project);
            }
        }
        return view('projects.projects', ['projects' => $project_allowed]);
    }

    public function projectAddPage()
    {
        $fields = Field::all();
        $users = User::all();
        return view('projects.addproject', ['fields' => $fields, 'users' => $users]);
    }

    public function addProject(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:250',
            'field_id' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'image' => 'image',
            'client_company' => 'max:250',
            'progress' => 'gte:0|lte:100'
        ]);

        $project = Project::create([
            'name' => $request->name,
            'field_id' => $request->field_id,
            'user_id' => Auth::user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'budget' => $request->budget,
            'progress' => $request->progress,
            'client_company' => $request->client_company,
            'description' => $request->description
        ]);

        if ($request->has('image')) {
            $project->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if ($request->has('files')) {
            $project->clearMediaCollection('files');
            foreach ($request->file('files') as $file)
                $project->addMedia($file)->toMediaCollection('files');
        }

        $users = User::find($request->users);
        $project->users()->attach($users);

        session()->flash('Add', 'Successful project addition');
        return redirect('/home/projects');
    }

    public function projectUpdatePage($id)
    {
        $project = Project::findOrFail($id);
        $fields = Field::all()->where('id', '!=', $project->field_id);
        $users = User::all();
        if (Auth::user()->hasRole('super-admin') || $project->user_id == Auth::user()->id || $project->isProjectMember(Auth::user()->id)) {
            return view('projects.modifyProject', ['project' => $project, 'fields' => $fields, 'users' => $users]);
        }
        abort(404);
    }

    public function updateProject($id, Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:projects,name,' . $id,
            'field_id' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'image' => 'image',
            'client_company' => 'max:250',
            'progress' => 'gte:0|lte:100'
        ]);

        $project = Project::find($id);
        $project->update([
            'name' => $request->name,
            'field_id' => $request->field_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'budget' => $request->budget,
            'progress' => $request->progress,
            'client_company' => $request->client_company,
            'description' => $request->description
        ]);

        // to delete the file delete selected :
        if ($request->has('deletefiles')) {
            foreach ($request->deletefiles as $idFile) {
                Media::find($idFile)->delete();
            }
        }

        if ($request->has('image')) {
            $project->clearMediaCollection('images');
            $project->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if ($request->has('files')) {
            foreach ($request->file('files') as $file)
                $project->addMedia($file)->toMediaCollection('files');
        }

        // TO SAVE NEW USERS :
        $users = User::find($request->users);
        $project->users()->detach($project->users);
        $project->users()->attach($users);

        session()->flash('Update', 'Successful project update');
        return redirect('/home/projects');
    }

    public function deleteProject($id)
    {
        $project = Project::find($id)->first();
        if (Auth::user()->hasRole('super-admin') || $project->user_id == Auth::user()->id || $project->isProjectMember(Auth::user()->id)) {
            $project->delete();
            session()->flash('Delete', 'Successful project update');
            return redirect('/home/projects');
        }
    }

    public function projectPage($id)
    {
        $project = Project::findOrFail($id);
        if (Auth::user()->hasRole('super-admin') || $project->user_id == Auth::user()->id || $project->isProjectMember(Auth::user()->id)) {
            return view('projects.project', ['project' => $project]);
        }
        abort(404);
    }
}
