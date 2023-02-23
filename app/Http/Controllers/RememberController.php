<?php

namespace App\Http\Controllers;

use App\Models\Remember;
use Illuminate\Http\Request;

class RememberController extends Controller
{
    
    public function index()
    {
        $Remembers=Remember::all();
        return  response($Remembers,201);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',            
            // 'image' => 'required',         
        ]);

        Remember::create([
            'title' => $request->content,
            'description' => $request->content,
            // 'image' => $request->type,            
        ]);

        return response([
            'message' => 'Remember created successfully'
        ],201);
    }

    
    public function show($id)
    {
        $Remember=Remember::findOrFail($id);
        return response($Remember,201);
    }

    
    public function update(Request $request, $id)
    {
        $Remember=Remember::findOrFail($id);
        $Remember->update([
            'title' => $request->content,
            'description' => $request->content,
            // 'image' => $request->type,   
        ]);

        return response([
            'message'=>'Remember updated successfully'
        ],201);
    }

    
    public function destroy($id)
    {
        $Remember=Remember::where('id',$id)->delete();

        return response([
            'message'=>'Remember deleted successfully'
        ],201);
    }
}
