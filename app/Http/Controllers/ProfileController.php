<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile=Profile::with('songs')->get();
        return response()->json([
            'profile' => $profile
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request ,$song_id)
    {
        try{
            DB::beginTransaction();
            $profile=Profile::create([
                'name'=>$request->name,
                'age'=>$request->age,
                'gender'=>$request->gender
            ]);

            $profile->songs()->attach($song_id);
            DB::commit();

            return response()->json([
                'message'=>'Profile created successfully',
                'profile'=>$profile,

            ]);
        }
        catch(\Throwable $th){
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'message'=>'Profile didn`t add ']);


        }




    }

    /**
     * Display the specified resource.
     */
    public function show( Profile  $profile)
    {
        return response()->json([
            'profile'=>$profile,
            'songs'=>$profile->songs
        ]);

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
        //
    }
}
