<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advertisment;
use Illuminate\Http\Request;

class AdvertismentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisments = Advertisment::all();
        return response()->json([
            'status' => true,
            'advertisments' => $advertisments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ],401);
        }

        $validated = $request->validate([
            'title' => 'required|string',
            'text' => 'nullable|string',
            'image' => 'nullable',
        ]);

        if($request->hasFile('image')){
            $filePath = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('advetisments/'), $filePath);

        $advertisment = Advertisment::create([
            'title' => $request->title,
            'text' =>$request->text,
            'image' => $filePath
        ]);
        }else{
            $advertisment = Advertisment::create([
                'title' => $request->title,
                'text' =>$request->text,
            ]);
        }


        return response()->json([
            'status' => true,
            'advertisment' => $advertisment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ],401);
        }
        $advertisment = Advertisment::findOrFail($id);
        return response()->json([
            'status' => true,
            'advertisments' => $advertisment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ],401);
        }
        Advertisment::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'advertisment deleted successfully'
        ]);
    }
}
