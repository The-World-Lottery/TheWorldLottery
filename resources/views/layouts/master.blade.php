<!DOCTYPE html>
<html>
<head>

	@yield('title')
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	{{-- <link rel="stylesheet" type="text/css" href="/bootstrap.min.css"> --}}
	<link rel="stylesheet" type="text/css" href="/main.css">
	{{-- <link rel="stylesheet" href="/theWorldLottery.css"> --}}
	<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body style="">
<img id="backgroundPic" style="opacity:.41;height:100%;width:100%;" src="/images/earthAtNight.jpg">
	<div class="container-fluid" style="padding:0;">
		<div style="position:fixed;top:0;width:100%;float:right;z-index:10;">
			<div style="width:100%;" class="row">
				<div style="z-index:10;" id="main" class="col col-xs-12">
					@include('layouts.partials._header')	
				</div>
			</div>
		</div>
		<div style="z-index:0;" class="row">
			<div style="clear:left;font-size:1.5em;margin-top: 2.7em;" class="col col-sm-9 col-xs-12 borderOpac gameAndChatInfo" id="gameArea">
				@if(Auth::check() && Auth::user()->is_admin)
				<div style="width:100%;" class="row">
					<div id="main2" class="col col-xs-12">
				  		<a href="{{action('LotteriesController@adminIndex')}}">Manage Lotteries</a>
						<a href="{{action('RafflesController@adminIndex')}}">Manage Raffles</a>
						<a href="{{action('UsersController@index')}}">Manage Users</a>
						<a href="{{action('SuggestionsController@adminIndex')}}">Manage Suggestions</a>
					</div>
				</div>
				@endif
				@if(\Auth::check())
					<div class="walletShow" hidden style="width:100%;display:hidden;background-color:rgba(0,0,0,.4);margin:0;">
						<div style="padding-left:3em;display:flex;justify-content:space-around;">
							<div class="walletPadding text-center">USD <br>${{number_format(Auth::user()->userWallet->usd,"2",".",",")}} </div>
						
							<div class="walletPadding text-center">Euro<br>€{{number_format(Auth::user()->userWallet->eur,"2",".",",")}} </div>
							<div class="walletPadding text-center">Yen<br>¥{{number_format(Auth::user()->userWallet->jpy,"2",".",",")}} </div>
						
						
							<div class="walletPadding text-center">Pounds<br>£{{number_format(Auth::user()->userWallet->gbp,"2",".",",")}} </div>
							
							<div class="walletPadding text-center">Franks<br>₣{{number_format(Auth::user()->userWallet->chf,"2",".",",")}} </div>
						<br>
						</div>
					</div>
					<div class="walletShow" hidden style="width:100%;display:hidden;justify-content:space-around;background-color:rgba(0,0,0,.4);margin:0;padding:0;"><div style="display:flex;justify-content: space-around;">
					
					
						<div class="walletPadding text-center">Bitcoin<br>{{number_format(Auth::user()->userWallet->btc,"2",".",",")}} </div>
						<div class="walletPadding text-center">Litecoin<br>{{number_format(Auth::user()->userWallet->ltc,"2",".",",")}} </div>
					
					
						<div class="walletPadding text-center">Etherium<br>{{number_format(Auth::user()->userWallet->eth,"2",".",",")}} </div>
						<div class="walletPadding text-center">Dogecoin<br>{{number_format(Auth::user()->userWallet->doge,"2",".",",")}} </div>

					
						<div class="walletPadding text-center">Bitcoin Cash<br>{{number_format(Auth::user()->userWallet->bch,"2",".",",")}} </div>
						<div class="walletPadding text-center">Ripple<br>{{number_format(Auth::user()->userWallet->xrp,"2",".",",")}} </div>
					</div>
					</div>
				@endif
				<div style="margin-top:1em;" class="areaHeader">
					@yield('divHead')
				</div>
				<div >
					@yield('content')
				</div>	
			</div>
			<div style="background-color:rgba(0,0,0,.6);position:fixed;right:0;" class="col col-sm-3 col-xs-12 gameAndChatInfo chatInfoContSpacing">
				<div class="chatInfoMargins borderOpac" id="chat">
					<div id="chatArea" style="overflow-y:scroll;height:75vh;padding-top:5em;">
					@foreach(\App\Models\UserComment::orderBy('created_at','asc')->limit(60)->get() as $comment)
					<span style="padding-left:.5em;"><u style="color:lightgreen;">{{ \App\User::select('username')->where('id',$comment->user_id )->get()[0]['username']}}-</u></span>
					<span class="commentSpacing" style="padding-left:.2em;">{{$comment->content}}</span><br>
					@endforeach
					</div>
					<form action="{{ action('UsersController@comment') }}">
					{!! csrf_field() !!}
						<input type="text" autofocus style="padding:.5em;margin-top:.5em;border:0;border-bottom:1px solid white;color:white;width:100%;background-color:rgba(0,0,0,0);" placeholder="Say Something!" name="comment"><button hidden type="submit">Add comment</button>
					</form>
				{{-- </div> --}}
				{{-- <div class="chatInfoMargins borderOpac" id="info" style="text-align:center;"> --}}
					{{-- <h3><strong>Jackpot : </strong><span style="color:lightgreen;">${{ number_format(\App\Models\TheWorldLottery::select('current_value')->where('id','1')->get()[0]['current_value'],2,".",",")}} (USD)</span></h3> --}}
					<div style="text-align:center;margin-top:2em;">
						<h3 style="color:lightgreen">World Lottery Jackpot is <br>(USD) ${{number_format((\App\Models\TheWorldLottery::where('id','=','1')->get()[0]['current_value']),2,".",",")}}
						</h3>
						<h4 class="countdown">
		  					Drawing in:
		  					<span id="clock" data-clock-id="{{\App\Models\TheWorldLottery::where('id','=','1')->get()[0]['end_date']}}"></span>
						</h4>
						{{-- <p><strong>Registered Accounts:</strong> {{ \App\User::count()}}</p>
						<p><strong>Highest Value Lottery : </strong><span style="color:lightgreen;">${{ number_format(\App\Models\Lottery::select('current_value')->orderBy('current_value','desc')->limit(1)->get()[0]['current_value'],2,".",",")}} (USD)</span></p>
						<p><strong>Raffle finishing next : <br></strong>{{ \App\Models\Raffle::select('product','content')->orderBy('end_date','asc')->limit(1)->get()[0]['product']}}</p> --}}
					</div>
				</div>
			</div>
		</div>
		{{-- @include('layouts.partials._footer') --}}
	</div>
	<script
	  src="https://code.jquery.com/jquery-3.2.1.js"
	  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	  crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
	<script src="https://static.filestackapi.com/v3/filestack.js"></script>
	<script src="/main.js" type="text/javascript"></script>
	<script>
		function myFunction(id) {
	    var x = document.getElementById(id);
	    if (x.className.indexOf("w3-show") == -1) {
	        x.className += " w3-show";
	    } else { 
	        x.className = x.className.replace(" w3-show", "");
	    }
	}
	</script>
</body>
</html>
