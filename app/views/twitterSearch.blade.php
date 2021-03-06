@extends('master')
@section('content')
    
    <br>
    <div class="col-lg-9 col-lg-offset-1">
        <div class="bs-component">
            <div class="well">
                {{ Form::open([ 'action' => 'TwitterController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
                <div class="row">
                    <div class="col-lg-4">
                        <!--twitterSearch Form Input-->
                        <div class="form-group">
                            {{ Form::label('twitterSearch', 'Twitter Search: ') }}
                            {{ Form::input('text', 'twitterSearch', 'obama', array('class' => 'form-control')) }}
                            {{ $errors->first('twitterSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}
                        </div>
                    </div>
                    <!-- popular radios-->
                    <div class="form-group">
                        {{--<div class="row">--}}
                            <div class="col-sm-3">
                                {{ Form::label('type', 'Type of tweets:') }}
                                <br/>
                                <label class="radio-inline">
                                    {{Form::radio('type', 'mixed', true)}} Popular & Recent
                                </label>
                                <br>
                                <label class="radio-inline">
                                    {{Form::radio('type', 'popular')}} Popular
                                </label>
                                <br>
                                <label class="radio-inline">
                                    {{Form::radio('type', 'recent')}} Recent
                                </label>
                            </div>
                            <div class="col-sm-3">
                                <!--numberOfTweets dropdown-->
                                <div class="form-group">
                                    {{ Form::label('numberOfTweets', '# of tweets:') }}
                                    <br>
                                    {{ Form::select('numberOfTweets', array('10' => '10', '50' => '50', '100' => '100'), null, array('class' => 'form-control')) }}
                                    <small>a higher # will result in longer loading time</small>
                                </div>
                            </div>
                        {{--</div>--}}
                    </div>
                </div>

                <button class="btn btn-success" type="submit" onClick="this.form.submit(); this.disabled=true; this.innerHTML='Loading...Please wait...'; ">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection