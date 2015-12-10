<?php

/* Load required lib files. */

session_start();

require Config::get('app.libraryPath').'/twitteroauth/twitteroauth/twitteroauth.php';

require Config::get('app.libraryPath').'/twitteroauth/config.php';

require Config::get('app.libraryPath').'/twitterAPI/TwitterAPIExchange.php';

/* If access tokens are not available redirect to connect page. */

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {

    header('Location: '.url('/clearsessions'));

    exit;

}

/* Get user access tokens out of the session. */

$access_token = $_SESSION['access_token'];
$params = array('id'=>$image,'vote'=>1);

$settings = array(
    'oauth_access_token' => $access_token['oauth_token'],
    'oauth_access_token_secret' => $access_token['oauth_token_secret'],
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET
);
$url = 'https://api.500px.com/v1/photos/'.$image.'/vote.json';
$requestMethod = 'POST';
$twitter = new TwitterAPIExchange($settings);
$response =  $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($params)
    ->performRequest();
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

        <div id="pics" class="modal-dialog col-md-12" style="width:80%;margin:30px 10% 0px;">

          <div class="modal-content">

              <div class="modal-header">

                  <h4 class="modal-title" id="myModalLabel">Pics from 500px.com</h4>

                  <a href="{{url('/pics')}}" class="btn btn-primary pull-right">Go back</a>
              </div>

              <div class="modal-body">

                  <div class="row">

                      <div class="col-md-12">

                      <?php
                      $content = json_decode($response);
                      if (isset($content->error)){
                        echo $content->error;
                      }else{
                        $image = $content->photo;
                        ?>
                        <div class="alert alert-success" role="alert">Thanks for your vote. :)</div>
                        <h4>{{$image->name}}</h4>
                        <img src='{{$image->image_url}}' alt="{{$image->name}}"/>
                        <p><b>Author: </b></p>
                        <p>{{$image->user->firstname.' '.$image->user->lastname}}</p>
                        <p><b>Votes: </b></p>
                        <p>{{$image->votes_count}}</p>
                        <p><b>Description: </b></p>
                        <p>{{$image->description}}</p>
                        </div>
                      <?php } ?>
                      </div>
                  </div>

              </div>

          </div>

      </div>

    </body>   

</html>



