<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Twitter's Favorites</title>
=======
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
>>>>>>> f19706e8b74b6bf724878359e39050fedbcf5f4e

        <title>Twitter's Favorites</title>

        <!-- Bootstrap core CSS -->
        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">
	   {{ HTML::style('css/style.css') }}
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::open(array('url'=>'/')) }}
                        {{ Form::label('Entrez un pseudo Twitter', null, array('class'=>'form-group')) }}
                        {{ Form::input('text', 'pseudo', null, array('class'=>'form-control')) }}
                        {{ Form::submit('Envoyer', array('class'=>'btn btn-primary btn-xs')) }}
                    {{ Form::close() }}
                </div>
                    <div class="col-md-6">
                        @foreach ($pseudos as $pseudo)
                            {{ HTML::link('search/'.$pseudo->screen_name, $pseudo->name, array('class'=>'btn btn-success btn-xs')) }}
                        @endforeach
                    </div>
                @if(!isset($twitter))
                    @if(isset($erreur))
                        </div>
                            <div class="row">
                                <h1>{{ $erreur }}</h1>
                            </div>
                    @endif
                @else
            </div>
                <div class="row">
                    @if(!isset($erreur))
                        <div class="pagination">
                            {{ $twitter->links() }}
                        </div>
                    @endif
                </div>
            <div class="row">
                @if(isset($erreur))
                    <h1>{{ $erreur }}</h1>
                @else
                    <h1>Tweets favoris de {{ '@'.$name }}</h1>
                    @foreach($twitter as $twit)
                        <div class="twitter col-md-6">
                            <img src="{{ $twit->profile_image_url }}" class="img-rounded" alt="">
                            <p><span class="screen_name" >{{ '@'.$twit->screen_name }}</span> : {{ $twit->name }} - {{ Twitter::ago($twit->date_tweet) }}</p>
                            <p>{{ Twitter::Linkify($twit->text) }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif

        </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    </body>
</html>
