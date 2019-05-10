<?php

namespace App\Http\Controllers;

use App\Girl;
use App\Myevent;
use App\EventStatys;
use App\EventPhoto;
use Doctrine\DBAL\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use File;

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
            'city' => 'required|numeric',
        ]);
        //  dump($request);
        // die();
        $event = new Myevent();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->max_people = $request->max;
        $event->min_people = $request->min;
        if ($request->has('place')) {
            $event->place = $request->place;
        }

        // dump($request);
        //


        $user = Auth::user();
        $girl = Girl::select(['id', 'name', 'user_id'])->where('user_id', $user->id)->first();
        if ($girl == null) {
            return null;
        }

        if ($request->has('city')) {
            $event->city_id = $request->city;
        }
        $event->girl_id = $girl->id;
        $event->save();

        if (Input::hasFile('file')) {
            foreach ($request->file as $key) {
                $image_extension = $key->getClientOriginalExtension();
                $image_new_name = md5(microtime(true));
                $key->move(public_path().'/images/events/', strtolower($image_new_name.'.'.$image_extension));

                $photo = new EventPhoto();
                $photo['photo_name'] = $image_new_name.'.'.$image_extension;
                $photo['event_id'] = $event->id;
                $photo->save();
            }
        }


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

    public function viewmyevent($id)
    {
        $events = DB::table('myevents')
            ->join('event_statys', 'event_statys.id', '=', 'myevents.status_id')
            ->where('myevents.id', '=', $id)
            ->first();
        //dump($events);
        $statys = EventStatys::select()->get();
        // dump($events);

        // dump($statys);

        return view('event.viewmy')->with(['event' => $events, 'statys' => $statys]);
    }

}
