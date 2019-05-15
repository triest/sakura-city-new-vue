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

    public function eventsinmycity(Request $request)
    {
        /*
                $events = DB::table('myevents')
                    ->join('event_statys', 'event_statys.id', '=', 'myevents.status_id')
                    ->leftJoin('events_participants','event_id','=','myevents.id')
                    ->where('myevents.city_id', '=', $request->id)
                    ->first();*/
        /* $events = DB::table('events_participants')
             ->select('myevents.id')
             ->leftJoin('myevents', 'id', '=', 'events_participants.event_id')
             ->get();*/

        //->join('event_statys', 'event_statys.id', '=', 'myevents.status_id')
        // ->leftJoin('myevents','id','=','events_participants.event_id')
        //  ->select('myevenst.id')
        // ->where('myevents.city_id', '=', $request->id)
        //$user=collect(DB::select('select * from users where phone like ?', [$phone]))->first();
        $events = collect(DB::select('select myev.id,myev.name,myev.begin,myev.end,myev.status_id from myevents myev left join events_participants evpart on myev.id=evpart.event_id
             where myev.city_id=? ', [$request->id]));

        $count = collect(DB::select('select myev.id,myev.name,myev.begin,myev.end,myev.city_id from myevents myev left join events_participants evpart on myev.id=evpart.event_id
             where myev.city_id=? group by myev.id', [$request->id]));

        // dump($count);

        return $events;
    }

    public function singup($id)
    {
        //выбираем событие
        /* $events = collect(DB::select('select myev.id,myev.name,myev.place,myev.description,myev.max_people,myev.min_people,myev.begin,myev.end,myev.status_id from myevents myev left join events_participants evpart on myev.id=evpart.event_id
              where myev.id=? limit 1', [$id]));*/
        $events = Myevent::select(['id', 'name', 'place', 'description','max_people'])->Paginate(1);
        dump($events);
      /*  $count = collect(DB::select('select myev.id,myev.name,myev.begin,myev.end,myev.city_id from myevents myev left join events_participants evpart on myev.id=evpart.event_id
             where myev.id=? group by myev.id', [$id]));
*/
       // dump($count);


        return view('event.singup')->with(['events' => $events,/* 'count' => $count*/]);
    }

}