@extends('master')
@section('content')
    <br>
    <br>
    {{--<div align="center">--}}
        {{--<a href="{{ action('StackExchangeController@home') }}" class="btn btn-info">New Stack Search</a>--}}
    {{--</div>--}}
    {{--<div class="col-lg-8 col-lg-offset-2">--}}
        {{--<div class="bs-component">--}}
            {{--<div class="well">--}}
                {{--{{ Form::open([ 'action' => 'StackExchangeController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="form-group">--}}
                            {{--{{ Form::label('stackExchangeSearch', 'Stack Exchange Search: ') }}--}}
                            {{--{{ Form::input('text', 'stackExchangeSearch', null, array('class' => 'form-control')) }}--}}
                            {{--{{ $errors->first('stackExchangeSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-3">--}}
                            {{--<div class="form-group">--}}
                                {{--{{ Form::label('count', '# of results:') }}--}}
                                {{--<br>--}}
                                {{--{{ Form::select('count', array('5' => '5', '10' => '10', '15' => '15'), null, array('class' => 'form-control')) }}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button class="btn btn-success" type="submit" onClick="this.form.submit(); this.disabled=true; this.innerHTML='Loading...Please wait...'; ">Submit</button>--}}
                {{--{{ Form::close() }}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    @if(empty($postIntel))
        <hr/>
        <div align="center">
            <h1>{{$searchTerm}}</h1>
        </div>
        <hr/>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            StackOverflow failed to return any results. Please refine your search or try again later.
        </div>
    @else
        <div class="col-lg-12">
            <div class="bs-component">
                <hr/>
                <div align="center">
                    <h1>{{$searchTerm}}</h1>
                </div>
                <hr/>
                <table id="sentiment" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Keywords</th>
                        <th>Entities</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(is_array($postIntel))
                        @foreach($postIntel as $intel)
                            <tr>
                                <td>
                                    {{--color code...--}}
                                    @if($intel['sentiment']['type'] == 'negative')
                                        <p class="text-danger">{{$intel['title']}}</p>
                                    @elseif($intel['sentiment']['type'] == 'positive')
                                        <p class="text-success">{{$intel['title']}}</p>
                                    @elseif($intel['sentiment']['type'] == 'neutral')
                                        <p class="text-muted">{{$intel['title']}}</p>
                                    @elseif($intel['sentiment']['type'] == 'mixed')
                                        <p class="text-warning">{{$intel['title']}}</p>
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        @if(is_array($intel['entities']))
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
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @if(is_array($intel['keywords']))
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
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <a class="text-info" target="_blank" href="{{$intel['link']}}">link</a>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready( function () {
                $('#sentiment').DataTable();
            } );
        </script>
    @endif
@endsection