<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $songs=Song::all();
        return response([
            'songs'=>$songs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $songs=Song::create([
                'title'=>$request->title,
                'image'=>$request->file('image')->store('images'),
                'audio'=>$request->file('audio')->store('audio'),
                'artist_id'=>$request->artist_id
            ]);
            DB::commit();
            return response()->json([
                'message'=>'song added successfully',
                'songs'=>$songs,

            ]);

        }
        catch(\Throwable $th){
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'message'=>$th->getMessage()
            ]);
        }












    }

    /**
     * Display the specified resource.
     */
    public function show(Song $songs)

    {
        $songs2=$songs->artist()->get('name');



        return response()->json([
            'songs'=>$songs,
            'artist'=>$songs2

        ]);



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $songs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $songs)
    {
        //
    }
}
