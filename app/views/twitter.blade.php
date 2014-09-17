
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Twitter's Favorites</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">
	{{ HTML::style('css/style.css') }}
  </head>

  <body>

    <div class="container">
      <div class="row col-md-6 ">
        {{ Form::open() }}
          {{ Form::label('nom', null, array('class'=>'form-group')) }}
          {{ Form::input('text', 'nom', null, array('class'=>'form-control')) }}
          <hr>
          {{ Form::submit('Envoyer', array('class'=>'btn btn-primary')) }}
        {{ Form::close() }}
      </div>
      <div class="clearfix"></div>
      <hr>
      <div class="row">
      @if(isset($twitter->errors))
        <h1>{{ $name }} n'exite pas !!!</h1>
      @else
      <h1>Tweets favoris de {{ '@'.$name }}</h1>
          @foreach($twitter as $twit)
              <div class="twitter col-md-6">
                  <img src="{{ $twit->user->profile_image_url }}" class="img-rounded" alt="">
                <p><span class="screen_name" >{{ '@'.$twit->user->screen_name }}</span> : {{ $twit->user->name }} - {{ substr( $twit->created_at, 8, 2) }} {{ substr( $twit->created_at, 0, 3) }}.</p>
                <p>{{ Twitter::Linkify($twit->text) }}</p>
              </div>
          @endforeach
      @endif
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

  </body>
</html>
