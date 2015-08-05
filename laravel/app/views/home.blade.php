@extends('master')
@section('content')
	<!--twitterSearch Form Input-->
	<div class="form-group">
	    {{ Form::label('twitterSearch', 'Twitter Search: ') }}
	    {{ Form::input('text', 'twitterSearch', null, array('class' => 'form-control')) }}
	</div>


@endsection