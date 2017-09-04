@extends('layouts.master')

@section('title')

<title>All Suggestions</title>

@stop

@section('content')

	<main class="container">
		<h1>All Suggestions</h1>
	

		@foreach($suggestions as $suggestion)
			<h1>{{$suggestion->title}}</h1>
			<a href="{{action('suggestionsController@upvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-up"></span></a>
            <a href="{{action('suggestionsController@downvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-down"></span></a>
			<p>{{$suggestion->content}}</p>
			<p>By {{$suggestion->user->name}}</p>
			<a href="{{ action('suggestionsController@show', $suggestion->id) }}">See More</a>
		@endforeach
		<br>

	
		{!! $suggestions->appends(Request::except('page'))->render() !!}

	</main>

@stop