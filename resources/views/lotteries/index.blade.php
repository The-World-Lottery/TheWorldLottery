@extends('layouts.master')

@section('title')

<title>All Lotteries</title>

@stop

@section('divHead')

<span>All Lotteries</span>
<p class="suggBox">Lotteries are created with an initial value coming from the world lottery foundation. When the date/time of each lottery is reached, one user will be randomly selected from the pool of entrys. This ensures there will always be a winner. Each ticket you have to the lottery increases your chances of winning. Good Luck!</p>
@stop

@section('content')
	<span style="float:right;padding-right:1em;">{!! $lotteries->appends(Request::except('page'))->render() !!}</span>
	<main class="container" style="max-width:100%;float:left;">
		<div>
			@if (session()->has('successMessage'))
            <div class="alert alert-success">{{ session('successMessage') }}</div>
        	@endif

			@foreach($lotteries as $lottery)

			<a href="{{ action('LotteriesController@show', $lottery->id) }}">
				<h3 class ="suggHead">{{$lottery->title}}</h3>
			</a>
			<p>Current Estimated Value : {{$lottery->current_value}}</p>
			<p>Initial Value : {{$lottery->init_value}}</p>
			<p>Lottery Ends : {{$lottery->end_date->diffForHumans()}}</p>
			<p>Description : {{$lottery->content}}</p>

		@endforeach
		<br>
		</div>
	</main>

@stop