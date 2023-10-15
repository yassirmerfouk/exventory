<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.tags', ['tags' => $tags]);
    }

    public function tagAddPage()
    {
        return view('tags.addtag');
    }

    public function addTag(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags'
        ]);
        Tag::create([
            'name' => $request->name
        ]);
        session()->flash('Add', 'Successful tag addition');
        return redirect('/home/tags');
    }

    public function tagUpdatePage($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.modifytag', ['tag' => $tag]);
    }

    public function updateTag($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags,name,' . $id
        ]);
        $tag = Tag::find($id);
        $tag->update([
            'name' => $request->name
        ]);
        session()->flash('Update', 'Successful tag update');
        return redirect('/home/tags');
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id)->delete();
        session()->flash('Delete', 'Successful tag delete');
        return redirect('/home/tags');
    }
}
