<html lang="en"><head>
    <meta charset="utf-8">
    <title>Deep Intel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../flatly/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../flatly/bootswatch.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
    <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"></style>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">Deep Learning Dashboard</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ action('TwitterController@home') }}">Twitter</a>
                </li>
                <li>
                    <a href="{{ action('StackExchangeController@home') }}">StackExchange</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="www.alchemyapi.com/" target="_blank">Text Analysis by AlchemyAPI</a></li>
                {{--<li><img src="/images/AlchemyVisionApi.png" style="height: 15%; padding-top: 10px"></li>--}}
                {{--<li><img href="" src="/images/Twitter.png" style="height: 15%; padding-top: 10px; padding-left: 5px"></li>--}}
                {{--<li><li><img src="/images/stack2.png" style="height: 16%; padding-top: 5px; padding-left: 1px"></li></li>--}}
            </ul>
        </div>
    </div>
</div>


<div class="container">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../flatly/bootstrap.min.js"></script>
    <script src="../flatly/bootswatch.js"></script>

    <!-- DataTables -->
    {{HTML::style('bower_components/datatables/integration/dataTables.bootstrap.css')}}
    {{--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>--}}
    {{HTML::script('bower_components/datatables/media/js/jquery.dataTables.js')}}
    {{HTML::script('bower_components/datatables/integration/dataTables.bootstrap.js')}}
    {{ HTML::style('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}
    {{--<link rel="stylesheet" href="http://css-spinners.com/css/spinner/whirly.css" type="text/css">--}}
    @yield('content')
</div>

<script type="text/javascript">
    /* <![CDATA[ */
    (function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
    /* ]]> */
</script>

</body>

</html>