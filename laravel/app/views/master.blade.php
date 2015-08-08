<html lang="en"><head>
    <meta charset="utf-8">
    <title>Deep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../flatly/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../flatly/bootswatch.min.css">




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
    <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"></style><script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script><script>

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-23019901-1']);
        _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="../" class="navbar-brand">Deep Learning Dashboard</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" aria-labelledby="themes">--}}
                        {{--<li><a href="../default/">Default</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="../cerulean/">Cerulean</a></li>--}}
                        {{--<li><a href="../cosmo/">Cosmo</a></li>--}}
                        {{--<li><a href="../cyborg/">Cyborg</a></li>--}}
                        {{--<li><a href="../darkly/">Darkly</a></li>--}}
                        {{--<li><a href="../flatly/">Flatly</a></li>--}}
                        {{--<li><a href="../journal/">Journal</a></li>--}}
                        {{--<li><a href="../lumen/">Lumen</a></li>--}}
                        {{--<li><a href="../paper/">Paper</a></li>--}}
                        {{--<li><a href="../readable/">Readable</a></li>--}}
                        {{--<li><a href="../sandstone/">Sandstone</a></li>--}}
                        {{--<li><a href="../simplex/">Simplex</a></li>--}}
                        {{--<li><a href="../slate/">Slate</a></li>--}}
                        {{--<li><a href="../spacelab/">Spacelab</a></li>--}}
                        {{--<li><a href="../superhero/">Superhero</a></li>--}}
                        {{--<li><a href="../united/">United</a></li>--}}
                        {{--<li><a href="../yeti/">Yeti</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li>
                    <a href="{{ action('TwitterController@home') }}">Twitter</a>
                </li>
                <li>
                    <a href="{{ action('StackExchangeController@home') }}">StackExchange</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>--}}
                {{--<li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>--}}
            </ul>

        </div>
    </div>
</div>


<div class="container">

    {{--<div class="page-header" id="banner">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-8 col-md-7 col-sm-6">--}}
                {{--<h1>Flatly</h1>--}}
                {{--<p class="lead">Flat and modern</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- Navbar
    ================================================== -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../flatly/bootstrap.min.js"></script>
    <script src="../flatly/bootswatch.js"></script>

    <!-- DataTables -->
    {{HTML::style('bower_components/datatables/integration/dataTables.bootstrap.css')}}
    {{--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>--}}
    {{HTML::script('bower_components/datatables/media/js/jquery.dataTables.js')}}
    {{HTML::script('bower_components/datatables/integration/dataTables.bootstrap.js')}}
    {{ HTML::style('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}
    @yield('content')
</div>


{{--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>--}}
{{--<script src="../flatly/bootstrap.min.js"></script>--}}
{{--<script src="../flatly/bootswatch.js"></script>--}}

{{--<!-- DataTables -->--}}
{{--{{HTML::style('bower_components/datatables/integration/dataTables.bootstrap.css')}}--}}
{{--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>--}}
{{--{{HTML::script('bower_components/datatables/media/js/jquery.dataTables.js')}}--}}
{{--{{HTML::script('bower_components/datatables/integration/dataTables.bootstrap.js')}}--}}
{{--{{ HTML::style('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}--}}
<script type="text/javascript">
    /* <![CDATA[ */
    (function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
    /* ]]> */
</script>


<script id="hiddenlpsubmitdiv" style="display: none;"></script><script>try{for(var lastpass_iter=0; lastpass_iter < document.forms.length; lastpass_iter++){ var lastpass_f = document.forms[lastpass_iter]; if(typeof(lastpass_f.lpsubmitorig2)=="undefined"){ lastpass_f.lpsubmitorig2 = lastpass_f.submit; if (typeof(lastpass_f.lpsubmitorig2)=='object'){ continue;}lastpass_f.submit = function(){ var form=this; var customEvent = document.createEvent("Event"); customEvent.initEvent("lpCustomEvent", true, true); var d = document.getElementById("hiddenlpsubmitdiv"); if (d) {for(var i = 0; i < document.forms.length; i++){ if(document.forms[i]==form){ if (typeof(d.innerText) != 'undefined') { d.innerText=i.toString(); } else { d.textContent=i.toString(); } } } d.dispatchEvent(customEvent); }form.lpsubmitorig2(); } } }}catch(e){}</script></body></html>