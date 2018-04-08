<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site de exemplo para teste de oportunidade de emprego, não deve ser utilizado em produção. Somente para fins avaliativos.">
    <meta name="author" content="Marcos Angelo Molizane">
    <link rel="icon" href="favicon.ico">
    <link rel="shortcut icon" href="favicon.ico" />

    <title>{{ __("title") }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset("css/bootstrap.min.css") !!}" media="all" rel="stylesheet" type="text/css" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{!! asset("css/ie10-viewport-bug-workaround.css") !!}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{!! asset("css/jumbotron.css") !!}" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
        <script src="{!! asset("js/ie8-responsive-file-warning.js") !!}"></script>
    <![endif]-->
    <script src="{!! asset("js/ie-emulation-modes-warning.js") !!}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<nav class="navbar navbar-jobtest navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/{!! App::getLocale() !!}">{{ HTML::image("images/logo-inverted.png", __("project")) }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul id="switcher" class="switcher navbar-right" title="{!! __("theme_color") !!}">
                <li id="btnColor1"></li>
                <li id="btnColor2"></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div id="header" class="jumbotron jumbotron-normal">
    <div class="container">
        <ul class="nav nav-pills navbar-right" role="tablist" title="{!! __("theme_language") !!}">
            <li role="presentation" class="dropdown active">
                <a href="#" class="dropdown-toggle" id="drop1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ config("app.locales")[App::getLocale()] }} ({{ App::getLocale() }})
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" id="languages" aria-labelledby="drop1">
                    @foreach (config("app.locales") as $locale => $language)
                        @if ($locale != App::getLocale())
                            <li>
                                <a href="/{{$locale}}">{{$language}} ({{ $locale }})</a>
                            </li>

                        @endif
                    @endforeach
                </ul>

            </li>
        </ul>
    </div>

    <div class="container">
        <h1>{!! __("header_txt") !!}</h1>
        <p>{!! __("header_content") !!}</p>
        {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>--}}
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">

        {{--<!-- Coluna do formulário -->--}}
        <div id="col1" class="col-md-6">
            <h2>{!! __("comment_insert") !!}</h2>

            <div id="alert" class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>

            <form>
                {{ csrf_field() }}
                <input type="hidden" name="locale_now" value="{!! App::getLocale() !!}">
                <div class="form-group">
                    <label>{!! __("form_field_name") !!}:</label>
                    <input type="text" name="nome" class="form-control" placeholder="{!! __("form_field_name") !!}">
                </div>

                <div class="form-group">
                    <label>{!! __("form_field_email") !!}:</label>
                    <input type="email" name="email" class="form-control" placeholder="{!! __("form_field_email") !!}">
                </div>

                <div class="form-group">
                    <strong>{!! __("form_field_comment") !!}:</strong>
                    <textarea class="form-control" name="comentario" placeholder="{!! __("form_field_comment") !!}"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-submit">{!! __("form_btn_submit") !!}</button>
                </div>

            </form>
        </div>

        {{--<!-- Coluna dos comentários -->--}}
        <div id="col2" class="col-md-6">
            <h2>{!! __("comment_comments") !!}</h2>
            <div id="alert-comment" class="alert alert-danger print-error-msg-comment" style="display:none">
            </div>

            <ul class="list-group comments_inline">
            </ul>

        </div>

        {{--<!-- Coluna do gráfico -->--}}
        <div id="col3" class="col-md-6">
            <h2>{!! __("comment_time") !!}</h2>

            <div id="alert-grafico" class="alert alert-danger print-error-msg-graph" style="display:none">
            </div>

            <div class="chart-container">
                <canvas id="grafico-comentarios"></canvas>
            </div>
        </div>

        {{--<!-- Coluna do ver o que fazer --> --}}
        <div id="col4" class="col-md-6">
            <h2>{!! __("comment_another") !!}</h2>
            <p>Sem conteúdo...</p>
        </div>
    </div>

    <hr>

</div> <!-- /container -->

<div id="footer" class="jumbotron-footer jumbotron-footer-normal">
    <div class="container">
        <footer>
            <p>&copy; 2017 {{__("company")}}</p>
        </footer>
    </div>
</div>


{{--<!-- Bootstrap core JavaScript--}}
{{--================================================== -->--}}

{{--<!-- Placed at the end of the document so the pages load faster -->--}}
<script src="{!! asset("js/jquery.min.js") !!}"></script>
<script src="{!! asset("js/bootstrap.min.js") !!}"></script>

{{--<!-- Script específico para o propósito -->--}}
<script src="{!! asset("js/jobtest.js") !!}"></script>

{{--<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->--}}
<script src="{!! asset("js/ie10-viewport-bug-workaround.js") !!}"></script>

{{--<!-- scripts para a geração do gráfico - Chart -->--}}
<script src="{!! asset("js/Chart.min.js") !!}"></script>

</body>
</html>