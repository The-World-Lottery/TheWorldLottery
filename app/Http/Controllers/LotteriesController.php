<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\LotteryEntry;
use App\Models\TheWorldLottery;
use App\Models\UserWallet;
use Log;
use App\User;
use DB;


class LotteriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('q')){
        //     $q = $request->q;
        //     $lotterys = Lottery::search($q);
        // } else {
        //     $lotterys = Lottery::with('user')->paginate(6);  
        // }
        // var_dump(\Carbon\Carbon::now());
        $lotteries = Lottery::where('end_date','>',\Carbon\Carbon::now())->orderBy('end_date','asc')->paginate(6);
        return view('lotteries.index')->with(array('lotteries' => $lotteries));
       

        // $data['lotterys']= $lotterys;
        // return view('lotteries.index',$data);
    }

    public function one(Request $request)
    {   
        $lottery = Lottery::where('end_date','>',\Carbon\Carbon::now())->first();
        return view('lotteries.one')->with(array('lottery' => $lottery)); 
    }

    public function chargeCard(Request $request, $id, $count)
    {

        if(!\Auth::check()){
            $request->session()->flash('errorMessage', 'You must be LOGGED IN to purchase a ticket!');
            return \Redirect::action('Auth\AuthController@getLogin');
        }

        if(!is_int((int)$count)){
            $request->session()->flash('errorMessage', 'You need to enter an integer amount. No decimals, no letters, and NO SCRIPTS!');
            return \Redirect::action('LotteriesController@index');
        }

        \Stripe\Stripe::setApiKey("sk_test_ZzKGRiePc0b4mGyYiwkRnPEy");

        $token = \Input::get('stripeToken');

        try {
            $userId = \Auth::id(); 
            $charge = \Stripe\Charge::create(array(
                    "amount"=> 500 * $count,
                    "currency"=>"usd",
                    "card"=> $token,
                    "description"=>$userId,
                ));


            // $userWallet = UserWallet::find($userId);
            // $userWallet->$currency -= (2 * $currConv);
            // $userWallet->save();

            $twlWallet = UserWallet::find(1);
            $twlWallet->usd += 2 * $count;
            $twlWallet->save();

            $currLottery = Lottery::find($id);
            $currLottery->current_value += 1.2 * $count;
            $currLottery->save();

            $currWorldLottery = TheWorldLottery::orderBy('id','desc')->limit(1)->get()[0];
            $currWorldLottery->current_value += 1.35 * $count;
            $currWorldLottery->save();


            for ($i = 0; $i < $count; $i++){
                $newEntry = new LotteryEntry();
                $newEntry->user_id = $userId;
                $newEntry->lottery_id = $id;
                $newEntry->save();
            }

        } catch (\Stripe\Error\Card $e){
            dd($e);
        }

        $request->session()->flash('successMessage', 'You have successfully purchased ' . $count . ' Lottery Ticket(s)');
        return \Redirect::action('LotteriesController@index');

    }

    public function adminIndex()
    {
        if(\Auth::user()->is_admin){
            $lotteries = Lottery::paginate(16);
            return view('lotteries.admin')->with(array('lotteries' => $lotteries));
        }
        return \Redirect::action('LotteriesController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lotteries.create');
    }

    public function addUserToEntries(Request $request, $id)
    { 

        $currency = $request->input()['currency'];

        if(\Auth::check()){

            switch ($currency){
                case "usd":
                $currConv = 1;
                break;
                case "eur":
                $currConv = $request->input()['eurConv'];
                break;
                case "jpy":
                $currConv = $request->input()['jpyConv'];
                break;
                case "gbp":
                $currConv = $request->input()['gbpConv'];
                break;
                case "chf":
                $currConv = $request->input()['chfConv'];
                break;
                case "btc":
                $currConv = $request->input()['btcConv'];
                break;
                case "ltc":
                $currConv = $request->input()['ltcConv'];
                break;
                case "eth":
                $currConv = $request->input()['ethConv'];
                break;
                case "doge":
                $currConv = $request->input()['dogeConv'];
                break;
                case "bch":
                $currConv = $request->input()['bchConv'];
                break;
                case "xrp":
                $currConv = $request->input()['xrpConv'];
                break;

            }

            $userId = \Auth::id();

            $userWallet = UserWallet::find($userId);
            $userWallet->$currency -= (2 * $currConv);
            $userWallet->save();

            $twlWallet = UserWallet::find(1);
            $twlWallet->usd += .60;
            $twlWallet->save();

            
            $currLottery = Lottery::find($id);
            $currLottery->current_value += .80;
            $currLottery->save();

            $currWorldLottery = TheWorldLottery::find(1);
            $currWorldLottery->current_value += .50;
            $currWorldLottery->save();

            $newEntry = new LotteryEntry();
            $newEntry->user_id = $userId;
            $newEntry->lottery_id = $id;
            $newEntry->save();

        } else {
            $request->session()->flash('errorMessage', 'You must be LOGGED IN to purchase a ticket!');
            return \Redirect::action('Auth\AuthController@getLogin');
        }


        $request->session()->flash('successMessage', 'You have successfully purchased a LOTTERY ticket! Thank you for your donation and good luck!');
        return \Redirect::action('LotteriesController@index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, Suggestion::$rules);

        $title = $request->input('title');
        $content = $request->input('content');
        $init_value = $request->input('init_value');
        $end_date = $request->input('end_date') . " " . $request->input('end_time') . ":00";
        $lottery = new Lottery();
        $lottery->title = $title;
        $lottery->winner_id = null;
        $lottery->content = $content;
        $lottery->init_value = $init_value;
        $lottery->current_value = $init_value;
        $lottery->end_date = $end_date;
        $lottery->user_id = \Auth::id();
        $lottery->save();

        // $request->session()->flash('successMessage', 'Suggestion created');

        // Log::info("$title, $content, $url");

        return redirect()->action('LotteriesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lottery = Lottery::find($id);

        if(!$lottery){
            abort(404);
        }

        $data['lottery'] = $lottery;
        return view('lotteries.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lottery = Lottery::find($id);

        if(\Auth::user()->is_admin){ 
            if(!$lottery){
                abort(404);
            }
            $data['lottery'] = $lottery;
            return view('lotteries.edit',$data);
        } else {
            header('Location:/lotteries');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, Suggestion::$rules);

        $lottery = Lottery::find($id);

        if(!$lottery){
            abort(404);
        }

        $title = $request->input('title');
        $content = $request->input('content');
        $init_value = $request->input('init_value');
        $end_date = $request->input('end_date');
        $lottery->title = $title;
        $lottery->content = $content;
        $lottery->init_value = $init_value;
        $lottery->end_date = $end_date;
        $lottery->save();

        // $request->session()->flash('successMessage', 'lottery updated');

        return \Redirect::action('LotteriesController@show', $lottery->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lottery = Lottery::find($id);

        if(!$lottery){
            abort(404);
        }

        $lottery->delete();
        $request->session()->flash('successMessage', 'lottery deleted');
        return redirect()->action('LotteriesController@index');
    }
    
}
