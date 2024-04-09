<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        return response()->json([
          'status'=>"Done",
          'artists'=>$artists


        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtistRequest $request)
    {
        try{
            DB::beginTransaction();
            $artist = Artist::create([
                'name'=>$request->name,
                'Nationality'=>$request->Nationality,


            ]);
            DB::commit();
            return response()->json([
                'status'=>"Done",
                'artist'=>$artist
            ]);




        }
        catch (\Throwable $th){
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'status'=>"Failed",


            ]);

        }







    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)

    {
        $artist2=$artist->songs()->get(['title', 'image', 'audio']);


        return response()->json([
            'status'=>"Done",
            'artist'=>$artist,
            'songs'=>$artist2,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        $Artist=[];
        try
        {
            DB::beginTransaction();
            if(isset($request->title)){
                $Artist['title'] = $request->title;

            }
            if(isset($request->image)){
                $Artist['image'] = $request->image;

            }
            if(isset($request->audio)){
                $Artist['audio'] = $request->audio;
            }
            DB::commit();
            $artist->update($Artist);
            return response()->json([
                'status'=>'Done',
                'Artist'=> $Artist


            ]);
        }

        catch(\Throwable $th) {
            DB::rollback();
            Log::error($th) ;
            return response()->json([
                'status' => 'FAILED',

            ]);



        };

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json([
            'status'=>'Done',
            'artist'=> 'artist deleted successfully']);
    }
}
