<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
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

        $lotteries = Lottery::paginate(16);
        return view('lotteries.index')->with(array('lotteries' => $lotteries));
       

        // $data['lotterys']= $lotterys;
        return view('lotteries.index',$data);
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
        $end_date = $request->input('end_date');
        $lottery = new Lottery();
        $lottery->title = $title;
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

        if(\Auth::id() == $lottery->user_id){ 
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
        //
    }
}