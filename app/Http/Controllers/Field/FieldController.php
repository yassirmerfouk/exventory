<?php

namespace App\Http\Controllers\Field;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('fields.fields', ['fields' => $fields]);
    }

    public function fieldAddPage()
    {
        return view('fields.addfield');
    }

    public function addField(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:fields|max:250',
            'description' => 'max:250'
        ]);

        Field::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        session()->flash('Add', 'Successful field addition');
        return redirect('/home/fields');
    }

    public function fieldUpdatePage($id)
    {
        $field = Field::findOrFail($id);
        return view('fields.modifyfield', ['field' => $field]);
    }

    public function updateField($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:fields,name,' . $id,
            'description' => 'max:250'
        ]);

        $field = Field::find($id);
        $field->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        session()->flash('Update', 'Successful field update');
        return redirect('/home/fields');
    }

    public function deleteField($id)
    {
        Field::find($id)->delete();

        session()->flash('Delete', 'Successful field delete');
        return redirect('/home/fields');
    }
}
