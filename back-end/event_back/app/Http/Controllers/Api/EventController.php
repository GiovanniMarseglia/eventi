<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\event;
use App\Models\meeting;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(){



        $events=event::with('meetings')->get();

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



        $events=event::with('meetings')->where('start', '>=', Carbon::now())->where('start', '<=', Carbon::now()->addDays(7))->get();

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

    public function find(Request $request){
        $findId=$request->query('id');
        $findDate=$request->query('date');

        $events=event::whereHas('meetings',function($query) use ($findId,$findDate){
            $query->where('id', '=', $findId);
        })->where('start', '<=', $findDate)->where('end', '>=', $findDate)->with('meetings')->get();


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


}
