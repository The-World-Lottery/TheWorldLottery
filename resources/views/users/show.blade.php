@extends('layouts.master')

@section('title')

<title>User</title>

@stop


@section('content')

	@if(Auth::user()->isAdmin || Auth::id() == $user->id )
	<main class="container" style="max-width:100%;display:flex;justify-content: center;">
		<div class="row">	
			<div class="col-sm-12 text-center">
				<br>
				<a style="margin-right:1em;" href="{{action('Auth\AuthController@getLogout')}}"><button class="btn btn-success cleargreenBtn">LOG OUT</button></a>
				@if(Auth::id() == $user->id || Auth::user()->is_admin) 
					<a href="{{action('UsersController@edit', $user->id)}}"><button class="btn btn-warning">EDIT</button></a>
				@endif
			</div>
			<div class="col-sm-12 col-md-6 col" style="background-color:rgba(0,0,0,.4);padding:1em 0 1em 0;margin-top: 1.5em;border-radius: 2em;">
				{{-- <div class="col-sm-4 col" style="display:flex;justify-content: center;">
				<div>
					<img src='{{$user->image}}' id="profImg"><br><br>
					<img src='{{substr($user->image,1,-1)}}' id="profImg">
					<div>Imaginary Internet Points : <span class="greenTxt" style="font-size:150%;">{{ \App\Models\Vote::where('user_id',$user->id)->where('vote',1)->get()->count()}}</span></div>
				</div>
				</div> --}}
				<div class="">
					<blockquote style="margin-left:1em;">
						<h2>
							{{$user->name}}
						</h2>
						<b><u><span class="greenTxt">Email : </span></u></b><br> {{$user->email}}<br>
						<b><u><span class="greenTxt">User Name : </span></u></b><br> {{$user->username}}<br>
						<b><u><span class="greenTxt">Phone Number : </span></u></b><br> {{$user->phone_number}}<br>

					
						{{-- <b><u><span class="greenTxt" style="">Imaginary Internet Points :</span></u><br>{{ \App\Models\Vote::where('user_id',$user->id)->where('vote',1)->get()->count()}}</span>
						<br> --}}
						<b><u><span class="greenTxt">Donation Drawing Entries : </span></u><br>{{\App\Models\RaffleEntry::where('user_id',$user->id)->count()}}</b> <br>
						{{-- <b><u><span class="greenTxt">Global Charity Drawing Entries : </span></u></b><br> {{\App\Models\TheWorldLotteryEntry::where('user_id',$user->id)->count()}}<br> --}}
						{{-- <b><u><span class="greenTxt">Suggestion Count : </span></u></b><br> {{\App\Models\Suggestion::where('user_id',$user->id)->count()}} <br> --}}
					</blockquote>
				</div>
			</div>
			<div class="col col-sm-12 col-md-6">
				<h1 style="padding-top:1em;text-align:center;color:lightgreen;">YOUR CURRENT TICKETS</h1>
				<div  class="row">
					{{-- <div class="col-xs-12 col-sm-4"> <h3 class="ticketHead">Lotteries</h3>
						@foreach($user->lotteryEntries->unique('lottery_id') as $lotteryEntry)
							@if(\App\Models\Lottery::where('id', $lotteryEntry->lottery->id)->get()[0]->complete == 0)
								<a href="{{action('LotteriesController@show', $lotteryEntry->lottery->id)}}">
									<span style="color:lightgreen;">x{{\App\Models\LotteryEntry::where('lottery_id',$lotteryEntry->lottery->id)->where('user_id', $user->id)->count()}}</span> - {{$lotteryEntry->lottery->title}} #{{$lotteryEntry->lottery->id}}
								</a>
								<br>
							@endif
						@endforeach
					</div> --}}
					<div class="col-xs-12 col-sm-12">
						<h3 class="ticketHead">Donation Drawings</h3>
						@foreach($user->raffleEntries->unique('raffles_id') as $raffleEntry)
							@if(\App\Models\Raffle::where('id', $raffleEntry->raffle->id)->get()[0]->complete == 0)
								<a href="{{action('RafflesController@show', $raffleEntry->raffle->id)}}">
									<span style="color:lightgreen;">x{{\app\Models\RaffleEntry::where('raffles_id',$raffleEntry->raffle->id)->where('user_id', $user->id)->count()}}</span> - {{$raffleEntry->raffle->title}}
								</a>
								<br>
							@endif
						@endforeach
					</div>
					{{-- <div class="col-xs-12 col-sm-4">
						<h3 class="ticketHead">Global Charity Drawing</h3>
						@foreach($user->worldLotteryEntries->unique('the_world_lottery_id') as $worldLotteryEntry)
							@if(\App\Models\TheWorldLottery::orderBy('id','desc')->limit(1)->get()[0]->id == $worldLotteryEntry->theworldlottery->id)
								<a href="{{action('TheWorldLotterysController@index')}}">{{$worldLotteryEntry->theworldlottery->title}}
								</a>
								<br>
							@endif
						@endforeach
					</div> --}}
				</div>
			</div>
			{{-- <div class="col col-sm-12" style="margin-bottom:3em;">
				@if(count($suggestions))
					<div style="margin-top:1em;">
					<h1 style="text-align:center;color:lightgreen;margin-top:2em;">YOUR SUGGESTIONS</h1>
			        @foreach($suggestions as $suggestion)
			        <div class="col col-sm-6" style="margin-top:1em;">
					<div style="background-color: rgba(0,0,0,.4);border-radius:1em;padding:0 1em 1em 1em;height:150px;overflow:scroll;">
			            <a href="{{ action('SuggestionsController@show', $suggestion->id) }}">
			                <div class ="suggHead">{{$suggestion->title}}</div>
			            </a>
			            <a href="{{action('SuggestionsController@upvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-up"></span></a>
			            <span style="font-size: 180%;">{!!
		                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',1)->get()->count() -
		                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',-1)->get()->count()
		                 !!}
		                </span>
			            <a href="{{action('SuggestionsController@downvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-down"></span></a>
			            <p>{{$suggestion->content}}</p>
			        </div>
			        </div>
			        @endforeach
			        </div>
			    @else
			        <div style="text-align:center;margin-top:2em;">
				        <h1 style="color:lightgreen">YOU HAVE NO SUGGESTIONS</h1>
				       	<a href="{{action('SuggestionsController@create')}}"> <button class="btn btn-success cleargreenBtn">ADD SUGGESTION</button></a>
			       	</div>
			    @endif
			</div> --}}
		</div>
	</main>
	@endif

@stop