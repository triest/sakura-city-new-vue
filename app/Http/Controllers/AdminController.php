<?php

namespace App\Http\Controllers;

use App\Events\eventPreasent;
use App\GiftAct;
use App\Girl;
use App\Present;
use App\Target;
use App\Interest;
use App\User;
use Illuminate\Http\Request;
use File;
use App\ImageResize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    //
    public function adminPanel()
    {
        return view('admin/adminPanel');
    }

    public function gettargetslist(Request $request)
    {
        $targets = Target::select(['id', 'name'])->get();

        return response()->json($targets);
    }

    public function createtarget(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $name = $request->name;
        $rez = Target::select(['id', 'name'])->where('name', $name)->first();
        if ($rez != null) {
            return response()->json('alredy');
        }
        $target = new Target();
        $target->name = $name;
        $target->save();

        return response()->json("ok");
    }

    public function edittarget(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);
        $target = Target::select(['id', 'name'])->where('id', $request->id)->first();

        if ($target == null) {
            return response()->json('fail');
        }
        $target->name = $request->name;
        $target->save();

        return response()->json("ok");
    }

    public function deletetargret(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);
        $target = Target::select(['id', 'name'])->where('id', $request->id)->first();
        $target->delete();
    }

    public function getinteresslist(Request $request)
    {
        $targets = Interest::select(['id', 'name'])->get();

        return response()->json($targets);
    }

    public function createinteress(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $name = $request->name;
        $rez = Interest::select(['id', 'name'])->where('name', $name)->first();
        if ($rez != null) {
            return response()->json('alredy');
        }
        $target = new Interest();
        $target->name = $name;
        $target->save();

        return response()->json("ok");
    }

    public function editinteress(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);
        $target = Interest::select(['id', 'name'])->where('id', $request->id)->first();

        if ($target == null) {
            return response()->json('fail');
        }
        $target->name = $request->name;
        $target->save();

        return response()->json("ok");
    }

    public function deleteinteress(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);
        $target = Interest::select(['id', 'name'])->where('id', $request->id)->first();
        $target->delete();
    }

    public function isAdmin(Request $request)
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            return response()->json("true");
        } else {
            return response()->json("false");
        }
    }

    public function bannedorNot(Request $request)
    {
        //    dump($request);
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $girl = Girl::select(['id', 'name', 'user_id', 'banned'])->where('user_id', $request->id)->first();
        //  dump($girl);
        if ($girl->banned == 1) {
            return response()->json("true");
        } else {
            return response()->json("false");
        }

    }

    public function makebunned(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $girl = Girl::select(['id', 'name', 'user_id', 'banned'])->where('user_id', $request->id)->first();

     //   dump($girl);
        if ($girl->banned == 1) {
            $girl->banned = 0;
            $girl->save();
        } elseif ($girl->banned == 0) {
            $girl->banned = 1;
            $girl->save();
        }
        $girl->save();

        return response()->json("true");
    }
}
