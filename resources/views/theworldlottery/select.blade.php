@extends('layouts.master')

@section('title')

<title>The World Lottery</title>

@stop

@section('divHead')
<h2>The World Lottery</h2>

@stop

@section('content')
	

	<div class="container text-center">
		@if (session()->has('successMessage'))
	        <div class="alert alert-success text-center">{{ session('successMessage') }}</div>
	    @endif
	    @if (session()->has('errorMessage'))
	        <div class="alert alert-warning text-center">{{ session('errorMessage') }}</div>
	    @endif
		{{-- <div class="col-sm-7 col"> --}}
			<h4 id="jackpot" style="color:lightgreen;"><strong >Jackpot - </strong>$ {{number_format($theWorldLottery->current_value,0,".",",")}}</h4>
		{{-- </div>
		<div class="col-sm-5 col"> --}}		
			<h4 style="color:#00ffc4;">Drawing takes place in: <span class="worldLottoClock" data-clock-id="{{\App\Models\TheWorldLottery::where('id','=','1')->get()[0]['end_date']}}"></span></h4>
		{{-- </div> --}}
	</div>
	<main class="container" style="max-width:100%;display:flex;justify-content: center;">


		<div class="row" id="checkWrapper">

			<form method="GET" action="{{action('TheWorldLotterysController@storeNumbers')}}">
				<div style="margin-bottom: 2em;" class="col col-md-9 col-xs-12">
					<h2>Pick any 5 numbers!</h2>
					{!! csrf_field() !!}
					@for($i = 1; $i <= 100; $i++)

				
						<div style="float:left;position:relative;display:flex;justify-content:center;">
							<span style="position:absolute;top:10%;">{{$i}}</span>
							<input class="numCheckbox" type="checkbox" name="{{$i}}">
						</div>
				
					@endfor
				</div>
				<div style="margin-bottom: 2em;" class="text-center col col-md-3 col-xs-12">
					<h2>And select a<br>POWER NUMBER!!!</h2>
					<select class="selectpicker text-center" name="powerNumber"> 
						@for($i = 1; $i <= 100; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<br>
					<br>
					<button class="btn btn-success">Submit Numbers</button><br><br>
					@if ((Auth::check()) && (Auth::user()->is_admin))
						<a href="{{ action('TheWorldLotterysController@edit', $theWorldLottery->id) }}"><button style="margin-bottom: 2em;" class="btn btn-warning">Edit</button></a>

					@endif
				</div>
			</form>
		</div>
		<br>


	</main>
	
@stop