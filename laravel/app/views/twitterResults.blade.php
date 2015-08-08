@extends('master')
@section('content')
    <br>
    <br>
    <div class="col-lg-9">
        <div class="bs-component">
            <div class="well">
                {{ Form::open([ 'action' => 'TwitterController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
                <div class="row">
                    <div class="col-lg-4">
                        <!--twitterSearch Form Input-->
                        <div class="form-group">
                            {{ Form::label('twitterSearch', 'Twitter Search: ') }}
                            {{ Form::input('text', 'twitterSearch', null, array('class' => 'form-control')) }}
                            {{ $errors->first('twitterSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}
                        </div>
                    </div>
                    <!-- popular radios-->
                    <div class="form-group">
                        {{--<div class="row">--}}
                        <div class="col-sm-3">
                            {{ Form::label('type', 'Type of tweets?') }}
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
                        </div>
                        <div class="col-sm-3">
                            <!--numberOfTweets dropdown-->
                            <div class="form-group">
                                {{ Form::label('numberOfTweets', '# of tweets:') }}
                                <br>
                                {{ Form::select('numberOfTweets', array('10' => '10', '50' => '50', '100' => '100'), null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        {{--</div>--}}
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="bs-component">
            <h1>{{$searchTerm}}</h1>
            <hr/>

            <table id="sentiment" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tweet</th>
                    <th>Entities</th>
                    <th>Keywords</th>
                    <th>Concepts</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tweetIntel as $intel)
                    <tr>
                        <td>
                            {{--color code...--}}
                            @if($intel['sentiment']['type'] == 'negative')
                                <p class="text-danger">{{$intel['tweet']}}</p>
                            @elseif($intel['sentiment']['type'] == 'positive')
                                <p class="text-success">{{$intel['tweet']}}</p>
                            @elseif($intel['sentiment']['type'] == 'neutral')
                                <p class="text-muted">{{$intel['tweet']}}</p>
                            @elseif($intel['sentiment']['type'] == 'mixed')
                                <p class="text-warning">{{$intel['tweet']}}</p>
                            @endif
                            <a class="text-info" href="{{$intel['userURL']}}">{{$intel['screenName']}}</a>
                        </td>
                        <td>
                            <ul>
                                @foreach($intel['entities'] as $entity)
                                        @if($entity['sentiment']['type'] == 'negative')
                                            <li class="text-danger">{{$entity['text']}} ({{round($entity['relevance'], 2)}})</li>
                                        @elseif($entity['sentiment']['type'] == 'positive')
                                            <li class="text-success">{{$entity['text']}} ({{round($entity['relevance'], 2)}})</li>
                                        @elseif($entity['sentiment']['type'] == 'neutral')
                                            <li class="text-muted">{{$entity['text']}} ({{round($entity['relevance'], 2)}})</li>
                                        @elseif($entity['sentiment']['type'] == 'mixed')
                                            <li class="text-warning">{{$entity['text']}} ({{round($entity['relevance'], 2)}})</li>
                                        @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($intel['keywords'] as $keyword)
                                    @if($keyword['sentiment']['type'] == 'negative')
                                        <li class="text-danger">{{$keyword['text']}} ({{round($keyword['relevance'], 2)}})</li>
                                    @elseif($keyword['sentiment']['type'] == 'positive')
                                        <li class="text-success">{{$keyword['text']}} ({{round($keyword['relevance'], 2)}})</li>
                                    @elseif($keyword['sentiment']['type'] == 'neutral')
                                        <li class="text-muted">{{$keyword['text']}} ({{round($keyword['relevance'], 2)}})</li>
                                    @elseif($keyword['sentiment']['type'] == 'mixed')
                                        <li class="text-warning">{{$keyword['text']}} ({{round($keyword['relevance'], 2)}})</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($intel['keywords'] as $keyword)
                                    <li>{{$keyword['text']}} ({{round($keyword['relevance'], 2)}})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>



    <script>
        $(document).ready( function () {
            $('#sentiment').DataTable();
        } );
    </script>
@endsection