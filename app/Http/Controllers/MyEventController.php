<?php

namespace App\Http\Controllers;

use App\Girl;
use App\Myevent;
use App\EventStatys;
use Doctrine\DBAL\Events;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class MyEventController extends Controller
{
    //

    public function myevent(Request $request)
    {
        return view('event.myevent');
    }

    //форма события
    public function create(Request $request)
    {
        return view('event.create');
    }

    //пост события
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'max' => 'required|numeric|min:1',
            'min' => 'required|numeric|min:1',
            'begin' => 'required',
            'end' => 'required',
            // 'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $event = new Myevent();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->max_people = $request->max;
        $event->min_people = $request->min;
        if ($request->has('place')) {
            $event->place = $request->place;
        }


        $user = Auth::user();
        $girl = Girl::select(['id', 'name', 'user_id'])->where('user_id', $user->id)->first();
        if ($girl == null) {
            return null;
        }

        //

        $event->girl_id = $girl->id;
        $event->save();

        return redirect("/myevent");
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $girl = $user->anketisExsis();
        if ($girl == null) {
            return null;
        }
        //$events = $girl->eventorganizer()->get();
        $events = DB::table('myevents')
            ->join('event_statys', 'event_statys.id', '=', 'myevents.status_id')
            ->where('girl_id', $girl->id)
            ->get();

        //dump($events);

        return response()->json(["events" => $events]);
    }

    public function edit($id)
    {
        $events = DB::table('myevents')
            ->join('event_statys', 'event_statys.id', '=', 'myevents.status_id')
            ->where('myevents.id', '=', $id)
            ->first();
        //dump($events);
        $statys = EventStatys::select()->get();

        // dump($statys);

        return view('event.edit')->with(['event' => $events, 'statys' => $statys]);
    }

}
