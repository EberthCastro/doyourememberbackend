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
            'image' => 'required'
            // 'category' => 'required', 
            // 'price' => 'required'       
        ]);

        // Subida y almacenamiento de la imagen
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/remembers/';
            $image->move(public_path($imagePath), $imageName);

        // Remember::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     // 'image' => $request->type,            
        // ]);

        // Creación y almacenamiento del libro
    $remember = new Remember();
    $remember->title = $request->title;
    $remember->description = $request->description;
    // $remember->user_id = auth()->id();
    $remember->image = $imagePath . $imageName;
    // $remember->category = $request->category;
    // $remember->price = $request->price;
    $remember->save();

    return response()->json($remember, 201);

        // return response([
        //     'message' => 'Remember created successfully'
        // ],201);
    }   

    
    public function show($id)
    {
        $Remember=Remember::findOrFail($id);
        return response($Remember,200);
    }

    
    public function update(Request $request, $id)
    {
        $Remember=Remember::findOrFail($id);
        $Remember->update([
            'title' => $request->content,
            'description' => $request->content,
            'image' => $request->type,   
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
