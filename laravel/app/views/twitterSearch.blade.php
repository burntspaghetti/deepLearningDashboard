@extends('master')
@section('content')

    <br>
    <br>

    <div class="col-lg-9">
        <div class="bs-component">
            <div class="well">
                {{ Form::open([ 'action' => 'TwitterController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
                <!--twitterSearch Form Input-->
                <div class="form-group">
                    {{ Form::label('twitterSearch', 'Twitter Search: ') }}
                    {{ Form::input('text', 'twitterSearch', null, array('class' => 'form-control')) }}
                    {{ $errors->first('twitterSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}
                </div>
                <!-- popular radios-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            {{ Form::label('type', 'What type of tweets?') }}
                            <br/>
                            <label class="radio-inline">
                                {{Form::radio('type', 'popular', true)}} Popular
                            </label>
                            <br>
                            <label class="radio-inline">
                                {{Form::radio('type', 'recent')}} Recent
                            </label>
                            <br>
                            <label class="radio-inline">
                                {{Form::radio('type', 'mixed')}} Popular & Recent
                            </label>

                            {{--<label class="radio-inline">--}}
                                {{--{{Form::radio('popular', '0')}} No--}}
                            {{--</label>--}}
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>



@endsection