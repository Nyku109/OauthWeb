<?php

/**

 * @file

 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.

 */



/* Load required lib files. */

session_start();

require Config::get('app.libraryPath').'/twitteroauth/twitteroauth/twitteroauth.php';

require Config::get('app.libraryPath').'/twitteroauth/config.php';



/* If access tokens are not available redirect to connect page. */



if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {

    header('Location: '.url('/clearsessions'));

    exit;

}

  /* Get user access tokens out of the session. */

  $access_token = $_SESSION['access_token'];



  /* Create a TwitterOauth object with consumer/user tokens. */

  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

  /* If method is set change API call made. Test is called by default. */

  $content = $connection->get('photos', array('feature' => 'popular','rpp'=>'100'));

?>   



<!DOCTYPE html>

<html>

    <head>

        <title>Web App</title>

        {!! Html::style('webapp/resources/assets/css/app.css') !!}

        {!! Html::style('webapp/resources/assets/css/bootstrap.min.css') !!}

        {!! Html::style('webapp/resources/assets/css/lightbox.css') !!}



        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- All the files that are required -->

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>



        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>

        {!! Html::script('webapp/resources/assets/js/bootstrap.min.js') !!}

        {!! Html::script('webapp/resources/assets/js/lightbox.js') !!}

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    </head>

    <body>

        <div id="pics" class="modal-dialog col-md-12" style="width:100%">

          <div class="modal-content">

              <div class="modal-header">

                  <h4 class="modal-title" id="myModalLabel">Pics from 500px.com</h4>

              </div>

              <div class="modal-body">

                  <div class="row">

                      <div class="col-md-12">

                            <ul class="images">                         

                            @foreach($content->photos as $image)

                              <li>

                                  <div class="portlet-title">

                                      <div class="caption">

                                        {{$image->name}}

                                      </div>

                                  </div>

                                  <div class="portlet-body">

                                    <img src="{{$image->image_url}}">

                                    <br/>

                                    Votes: <span class="badge badge-primary votes">{{$image->votes_count}}</span><br/>

                                    <a class="btn btn-default blue" id="{{$image->id}}" href="{{url('imageLike/'.$image->id)}}">Like</a>

                                    <a class="btn btn-default red" id="{{$image->id}}" href="{{url('imageDislike/'.$image->id)}}">Dislike</a>                                     

                                  </div>

                              </li>                              

                            @endforeach

                            </ul>

                      </div>

                  </div>

              </div>

          </div>

      </div>

    </body>    

</html>



