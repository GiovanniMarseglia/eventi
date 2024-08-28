<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\meeting;
use App\Http\Requests\StoreMeetingRequest;
//manage exception
use Illuminate\Validation\ValidationException;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingRequest $request)
    {
        try{
            $data='a';
            $data = $request->validated();
            $newMeeting = new meeting();
            $newMeeting->name = $data["params"]["name"];
            $newMeeting->description = $data["params"]["description"];
            $newMeeting->place = $data["params"]["number"];
            $newMeeting->save();
            return response()->json([
                'success' => true,
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'success' => false,
                'dati' => $data,
                'errors' => $e->errors(),

            ], 422);//vaidation error
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage(),
                'info' => "qualcosa è andato storto,riprova",
                'dati' => $data,
            ], 422);//vaidation error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        //
    }
}
