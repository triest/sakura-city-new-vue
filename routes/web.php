<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/messages', 'HomeController@index')->name('home');

Route::get('/messages2', 'HomeController@index2')->name('home2');

Route::get('/contacts', 'ContactsController@get');
Route::get('/contacts2', 'ContactsController@get2');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');
Route::post('/conversation/sendModal', 'ContactsController@sendModal');

Route::get('/join/', 'CustomUserController@index')->name('join');

Route::get('/', function () {
    return view('welcome2');
})->name('welcome');

Route::get('/anket', 'GirlsController@index')->name('main');

Route::get('/anket2', function () {
    return view('index2');
})->name('main2');


//создание анкеты
Route::get('/createAnketPage', 'AnketController@createGirl')->name('createGirlPage')->middleware('auth');;

Route::post('/anket/create', 'AnketController@Store')->name('storeGirl');
Route::get('/anket/{id}', 'GirlsController@showGirl')->name('showGirl');

//количество непрочитанных сообщений
Route::get('/getCountUnreaded', 'ContactsController@getCountUnreadedMessages')->middleware('auth');

//оличество непрочитанных запросов
Route::get('/getCountUnreadedRequwest', 'ContactsController@getCountUnreadedRequwest')->middleware('auth');


//заявки на открытия
Route::get('/applications', 'ContactsController@getApplicationPage')->middleware('auth');
//получаем сами заявки
Route::get('/getapplication', 'ContactsController@getApplication')->middleware('auth');

Route::get('/getmyapplication', 'ContactsController@myApplication')->middleware('auth');
//кто имеет доступ к моеё анкете
Route::get('/whohaveaccesstomyanket', 'ContactsController@whoHavaAccessToMyAnket')->middleware('auth');
//закрыть доступ
Route::get('/clouseaccess', 'ContactsController@clouseaccess')->middleware('auth');
//заявки на открытие телефон
Route::get('/getrequwesttoopenphone', 'ContactsController@getrequwesttoopenphone')->middleware('auth');

//предоставление доступа к телефону
Route::get('/getnewphonaaplication', 'ContactsController@getnewphonaaplication')->middleware('auth');




//отклонить доступ
Route::get('/denideaccess', 'ContactsController@denideAccess')->middleware('auth');

Route::get('/geteaccess', 'ContactsController@makeAccess')->middleware('auth');

Route::get('/req', 'ContactsController@reqTest')->middleware('auth');

//проверяем, есть ли доступ к приватной части или нет
Route::get('/getisprivaterrnot', 'ContactsController@getIsPrivateOrNot')->middleware('auth');

//проверяем, отправляли ли запрос
Route::get('/getsendregornot', 'ContactsController@sendornot')->middleware('auth');

//отправляем запрос:
Route::get('/sendreg', 'ContactsController@sendreg')->middleware('auth');

//отправлен ли запрос на открытие телефона
Route::get('/getsendregphoneornot', 'ContactsController@getsendregphoneornot')->middleware('auth');

Route::get('/denidephoneaplication', 'ContactsController@denidephoneaplication')->middleware('auth');

//
Route::get('/sendregphone', 'ContactsController@sendregphone')->middleware('auth');

//редактирование галлереи
Route::get('/editimages', function () {
    return view('editimages');
})->middleware('auth');


Route::get('/join/', 'CustomUserController@index')->name('join');
Route::post('/join/new', 'CustomUserController@join')->name('joinStore');
Route::get('/continion/', 'AnketController@createGirl')->name('continion');

//редактировать анке
Route::get('/edit', 'AnketController@girlsEditAuchAnket')->name('girlsEditAuchAnket')->middleware('auth');;
Route::post('/user/anketa/edit/', 'AnketController@edit')->name('girlsEdit');

//обновление главной фотографии
Route::post('/updateMainImage', 'AnketController@updateMainImage')->name('updateMainImage');
Route::get('/getmainImage', 'AnketController@getmainimage')->middleware('auth');
//получаем обычные фотографии
Route::get('/getImages', 'AnketController@getImages')->middleware('auth');
//загрузить обычнае фотографии
Route::post('/updateGalerayImage', 'AnketController@updateGalerayImage')->middleware('auth');

//удалить фотографию
Route::get('/deleteImage', 'AnketController@deleteImage')->middleware('auth');

//приватные фотографии
Route::get('/getPrivateImages', 'AnketController@getPrivateImages')->middleware('auth');

Route::post('/updatePrivateGalerayImage', 'AnketController@updatePrivateGalerayImage')->middleware('auth');

Route::get('/deletePrivateImage', 'AnketController@deletePrivateImage')->middleware('auth');

Route::get('/power', function () {
    return view('power');
})->middleware('auth');


//олучаем состояние счета
Route::get('/getMoney', 'MoneyController@getCurrentMoney')->middleware('auth');

//путь для яндекса
Route::post('/yandex', 'MoneyController@reciverMoney');

//получить цены
Route::get('/getpricestotop', 'MoneyController@getpricestotop')->middleware('auth');

Route::get('/getpricetoseach', 'MoneyController@getpricetoseach')->middleware('auth');

Route::get('/getpricetofirstplace', 'MoneyController@getpricetofirstplase')->middleware('auth');

Route::get('/getpricechangemainimage', 'MoneyController@getpricechangemainimage')->middleware('auth');

Route::get('/tofirstplaсe', 'MoneyController@toFirstPlase')->middleware('auth');

Route::get('/totop', 'MoneyController@totop')->middleware('auth');

Route::get('/toseach', 'MoneyController@toseach')->middleware('auth');


//получаем картинки для карусели
Route::get('/getdataforcarousel', 'AnketController@getdataforcarousel');


//ути администратора
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@adminPanel')->name('adminPanel');
    Route::get('/presentsControll', function () {
        return view('admin.presentsControl');
    })->name('presentsControll');

    Route::get('/targetsControll', function () {
        return view('admin.targetsControl');
    })->name('targetsControll');

    Route::get('/interessControll', function () {
        return view('admin.interesControl');
    })->name('interetsControll');

    Route::get('/usersControll', function () {
        return view('admin.usersControll');
    })->name('usersControll');

    Route::get('/moneyControll', function () {
        return view('admin.moneyControll');
    })->name('moneyControll');

    Route::get('/phoneSettings', function () {
        return view('admin.phoneSettings');
    })->name('phoneSettings');

    // пользователи
    Route::get('/getuserslist', 'AdminController@getuserslist')->middleware('auth', 'admin');
    //конец пользователей
    //получаем список интересов

    Route::get('/interess', 'AdminController@getinteresslist')->middleware('auth', 'admin');

    Route::post('/createinteress', 'AdminController@createinteress')->middleware('auth', 'admin');

    Route::post('/editinteress', 'AdminController@editinteress')->middleware('auth', 'admin');

    Route::post('/deleteinteress', 'AdminController@deleteinteress')->middleware('auth', 'admin');

    Route::get('/bannedorNot', 'AdminController@bannedorNot')->middleware('auth', 'admin');
    //работа с анкетами пользовател
    Route::post('/makebunned', 'AdminController@makebunned')->middleware('auth', 'admin');

    Route::get('/seachAdmin', 'AdminController@seachAdmin')->middleware('auth', 'admin');

    Route::get('/bannedorNot', 'AdminController@bannedorNot')->middleware('auth', 'admin');

    Route::get('/seachAdmin', 'AdminController@seachAdmin')->middleware('auth', 'admin');

    Route::get('/getPrices', 'MoneyController@getPrices')->middleware('auth', 'admin');

    //changeprice
    Route::post('/changePrice', 'MoneyController@changePrice')->middleware('auth', 'admin');
});

Route::get('/isAdmin', 'AdminController@isAdmin')->middleware('auth');

Route::get('/getpresents', 'PresentController@getpresents');

Route::post('/createpresent', 'PresentController@storepresent');

Route::post('/delpresent', 'PresentController@delpresent')->middleware('auth');

//подарить подарок
Route::post('/givepresent', 'PresentController@givepresent')->middleware('auth');

Route::get('/presenttest', 'PresentController@presenttest');

//счетчик подаркоа
Route::get('/getCountUnreadedPresents', 'PresentController@getCountUnreaderPresents')->middleware('auth');

//мои подарки
Route::get('mypresents', function () {
    return view('presents.mypresents');
}

//получение списка моих подарко
)->middleware('auth');
Route::get('/getpresentsforMe', 'PresentController@presentsForMe')->middleware('auth');

Route::get('/getpresentsHistoryforMe', 'PresentController@getpresentsHistoryforMe')->middleware('auth');


Route::get('/getpresentsFromMe', 'PresentController@getpresentsFromMe')->middleware('auth');

//markpresentasreaded
Route::post('/markpresentasreaded', 'PresentController@markpresentasreaded')->middleware('auth');

//
Route::get('/getDataForChangeMainImage', 'AnketController@getDataForChangeMainImage')->middleware('auth');;

//получаем id пользователя по

//SMS
Route::get('/sendSMS2', function () {
    $phone = Input::get('phone');
    $user = collect(DB::select('select * from users where phone like ?', [$phone]))->first();
    //   dump($user);
    if ($user != null and $user->phone_conferd == 1) {
        //echo 'Phone alredy exist!';
        return response()->json(['result' => 'alredy']);
    }
    $user = Auth::user();
    //если найден,то
    //1)генерируем проль для отправки
    $user->phone = $phone;
    $activeCode = rand(1000, 9999);
    $user->actice_code = $activeCode;
    $user->save();
    //2) отправляем его в смс
    App::call('App\Http\Controllers\GirlsController@sendSMS', [$phone, $activeCode]);

    return response()->json(['result' => 'ok']);
}
);
Route::get('/sendCODE2', function () {
    $code = Input::get('code');
    $user = Auth::user();
    if ($user->phone_conferd == 1) {
        return response()->json(['result' => 'alredy']);
    }
    if ($code == $user->actice_code) {
        $user->phone_conferd = 1;
        $user->save();

        return response()->json(['answer' => 'ok']);
    } else {
        return response()->json(['result' => 'fail']);
    }
}
);

Route::get('/myAnket', 'AnketController@myAnket')->name("myAnket")->middleware('auth', 'anketExist');

Route::get('/getMyAnketData', 'AnketController@getMyAnketData')->middleware('auth', 'anketExist');

Route::get('/getTopPhotos', 'AnketController@getTopPhotos')->middleware('auth', 'anketExist');

Route::get('/getuserid', 'ContactsController@getUserID');

//
Route::post('/inputPhone', 'GirlsController@inputPhone')->middleware('auth');

Route::post('/inputCode', 'GirlsController@inputCode')->middleware('auth');

//список целей
Route::get('/targets', 'AdminController@gettargetslist')->middleware('auth', 'admin');

Route::post('/createtarget', 'AdminController@createtarget')->middleware('auth', 'admin');

Route::post('/edittarget', 'AdminController@edittarget')->middleware('auth', 'admin');

Route::post('/deletetargret', 'AdminController@deletetargret')->middleware('auth', 'admin');

//поиск города
Route::get('/findcity/{name}', 'AnketController@findcity')->middleware('auth');

Route::get('/getargetslist', 'AdminController@gettargetslist');

Route::get('/getinterestslist', 'AdminController@getinteresslist');

Route::get('/seach', 'AnketController@seach');

Route::get('/inseach', 'AnketController@inseach');

Route::get('/eventtest', 'PresentController@eventtest');


//лайки
Route::get('/newlike', 'LikeController@newLike');
Route::get('/getLikesNumber', 'LikeController@getLikesNumber');
Route::get('/getLikesNumberAuch', 'LikeController@getLikesNumberAuch')->middleware('auth');
//likeSendedl
Route::get('/likeSended', 'LikeController@likeSended');


//боковая панель, все данные
//getalldataforsidepanel
Route::get('/getalldataforsidepanel', 'AnketController@getalldataforsidepanel')->middleware('auth');