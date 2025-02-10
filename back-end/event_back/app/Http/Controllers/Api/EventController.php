<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Http\Requests\StoreEventRequest;

class EventController extends Controller
{
    public function index(){

        $events=Event::with('meetings')->get();

        //no events return
        if ($events->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun evento trovato per i criteri specificati.'
            ]);
        }

        //return events
        return response()->json([
            'success' => true,
            'results' => $events,
        ]);

    }

    public function week(){

        $events=Event::with('meetings')->where('end', '>=', Carbon::now())->where('start', '<=', Carbon::now()->addDays(7))->orderBy('start','asc')->get();

        //no events return
        if ($events->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nessun evento trovato per i criteri specificati.'
            ]);
        }

        //return events
        return response()->json([
            'success' => true,
            'results' => $events,
        ]);
    }

    //code below need review because column changed (meetindTable -1 column (event_id)) (eventTable +1 column (meeting_is))
    public function find(Request $request){
        $findId=$request->query('id');
        $findDate=$request->query('date');

        $events=Meeting::whereHas('events',function($query) use ($findDate){
            $query->where('start', '<=', $findDate)->where('end','>=',$findDate);
        })->where("id","=",$findId)->with("events")->get();


        //no events return
        if ($events->isEmpty()) {
            return response()->json([
                'success' => false,
                'results' => 'Nessun evento trovato per i criteri specificati.'
            ]);
        }

        //return events

        return response()->json([
            'success' => true,
            'results' => $events,
        ]);


    }

    //logic for check the available meetings in the specific range if free
    public function availableMeetings(Request $request){
        $start=$request->query('start');
        $end=$request->query('end');
        $meetings=Meeting::whereHas('events',function($query) use ($start,$end){
            $query->where(function($query) use ($start, $end) {
                // First condition: start and end are less than the start
                $query->where('start', '>', $end);
            })->orWhere(function($query) use ($start, $end) {
                // Second condition: start and end are greater than the end
                $query->where('end', '<', $start);
            });
        })->get();

        return response()->json([
            'success' => true,
            'results' => $meetings,
        ]);
    }

    //save new event

    public function storeEvents(StoreEventRequest $request) {
        $validatedData = $request->validated();

        $event = new Event();
        $event->fill($validatedData);
        $event->save();

        return response()->json(['message' => 'Event created successfully!', 'event' => $event], 201);
    }



}
