<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
use Storage;
use DateTime;
use App\User;
use App\Girl;
use App\Photo;


class GirlsController extends Controller
{
    //
    function index()
    {
        if (Auth::check()) {
            $user = Auth::user();  // и если админ
            if ($user->isAdmin == 1) {
                $girls = Girl::select(['id', 'name', 'phone', 'main_image', 'description', 'banned'])
                    ->orderBy('created_at', 'DESC')->simplePaginate(9);
            } else {
                $girls = Girl::select(['id', 'name', 'phone', 'main_image', 'description', 'sex'])
                    ->where('banned', '=', '0')
                    ->orderBy('created_at', 'DESC')
                    ->Paginate(9);
            }
        } else {
            $girls = Girl::select(['id', 'name', 'phone', 'main_image', 'description', 'sex'])
                ->where('banned', '=', '0')
                ->orderBy('created_at', 'DESC')
                ->Paginate(9);
        }
        $user = Auth::user();


        return view('index')->with(['girls' => $girls]);
    }


    public function showGirl($id)
    {
        $girl = Girl::select([
            'name',
            'id',
            'description',
            'main_image',
            'sex',
            'meet',
            'weight',
            'height',
            'age',
            'country_id',
            'region_id',
            'city_id',
            'banned',
            'user_id',
            'phone',
            'phone_settings',
            'status',
            'views_all',
        ])->where('id', $id)->first();

        if ($girl == null) {
            return $this->index();
        }
        $images = $girl->photos()->get();

        $AythUser = Auth::user();
        $privatephoto = null;

        $targets = $girl->target()->get();

        if ($girl->city_id != null) {
            $city = DB::table('cities')->where('id_city', '=', $girl->city_id)->first();
        } else {
            $city = null;
        }

        //интересы
        $interes = $girl->interest()->get();

        //счетчик просмотров
        $views = $girl->views_all;
        $views = $views + 1;
        $girl->views_all = $views;
        $girl->save();

        //проверяем, что просматривающий пользователь зареген.
        if ($AythUser != null) {
            $user3 = DB::table('user_user')
                ->where('my_id', $AythUser->id)
                ->where('other_id', $girl->user_id)->first();
            if ($user3 != null) {
                $girl = Girl::select([
                    'name',
                    'id',
                    'description',
                    'main_image',
                    'sex',
                    'meet',
                    'weight',
                    'height',
                    'age',
                    'phone',
                    'country_id',
                    'region_id',
                    'city_id',
                    'banned',
                    'user_id',
                    'private',
                    'phone_settings',
                ])->where('id', $id)->first();
                $privatephoto = $girl->privatephotos()->get();
            }
        }
        $phone_settings = $girl->phone_settings;

        $phone = null;
        if ($phone_settings == 1) {
            $phone = $girl->phone;
        } else {
            if ($AythUser != null) {
                $auth_girl = Girl::select('id', 'user_id')->where('user_id', $AythUser->id)->first();
                if ($auth_girl != null) {
                    $girl_in_table = DB::table('girl_open_phone_girl')
                        ->where('girl_id', $auth_girl->id)
                        ->where('target_id', $girl->id)->first();
                    if ($girl_in_table != null) {
                        $girl2 = Girl::select([
                            'id',
                            'phone',
                        ])->where('id', $id)->first();;
                        $phone = $girl2->phone;
                    } else {
                        $phone = null;
                    }
                } else {
                    $phone = null;
                }
            }

        }

        if (count($interes) == 0) {
            $interes = null;
        }

        return view('girlView')->with([
            'girl' => $girl,
            'images' => $images,
            'privatephotos' => $privatephoto,
            'targets' => $targets,
            'city' => $city,
            'interes' => $interes,
            'phone_settings' => $phone_settings,
            'phone' => $phone,
            'views'=>$views
        ]);
    }

    public function inputPhone(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|numeric|min:11',
        ]);

        $phone = $request->phone;
        $user = collect(DB::select('select * from users where phone like ?', [$phone]))->first();
        //   dump($user);
        if ($user != null and $user->phone_confirmed == 1) {
            //echo 'Phone alredy exist!';
            return response()->json(['result' => 'alredy']);
        }
        $user = Auth::user();
        //если найден,то
        //1)генерируем проль для отправки
        $user->phone = $phone;
        $activeCode = rand(1000, 9999);
        $user->active_code = $activeCode;
        $user->save();
        //2) отправляем его в смс
        // App::call('App\Http\Controllers\GirlsController@sendSMS', [$phone, $activeCode]);
        $this->sendSMS($phone, $activeCode);

        return response()->json(['result' => 'ok']);
    }


    public function inputCode(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|numeric|min:11',
        ]);

        $inputCode = $request->code;
        $user = Auth::user();
        if ($user->active_code == $inputCode) {
            $user->phone_confirmed = 1;
            $user->save();

            return response()->json(['result' => 'ok']);
        } else {
            return response()->json(['result' => 'wrongCode']);
        }
    }

    public function SendSMS($phone, $text)
    {
        $src = '<?xml version="1.0" encoding="UTF-8"?>
        <SMS>
            <operations>
            <operation>SEND</operation>
            </operations>
            <authentification>
            <username>sakura-city@rambler.ru</username>
            <password>22d2af28</password>
            </authentification>
            <message>
            <sender>SMS</sender>
            <text>'.$text.'</text>
            </message>
            <numbers>
            <number messageID="msg11">'.$phone.'</number>
            </numbers>
        </SMS>';
        $Curl = curl_init();
        $CurlOptions = array(
            CURLOPT_URL => 'http://api.atompark.com/members/sms/xml.php',
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_POST => true,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_POSTFIELDS => array('XML' => $src),
        );
        curl_setopt_array($Curl, $CurlOptions);
        if (false === ($Result = curl_exec($Curl))) {
            throw new Exception('Http request failed');
        }
        curl_close($Curl);
    }
}
