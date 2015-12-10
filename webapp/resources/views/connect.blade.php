<?php


/**

 * @file

 * Check if consumer token is set and if so send user to get a request token.

 */



/**

 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.

 */

require Config::get('app.libraryPath').'/twitteroauth/config.php';

if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {

  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';

  exit;

}

?>



<!DOCTYPE html>

<html>

    <head>

        <title>Web App</title>

        {!! Html::style('webapp/resources/assets/css/app.css') !!}

        {!! Html::style('webapp/resources/assets/css/bootstrap.min.css') !!}



        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- All the files that are required -->

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>



        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>

        {!! Html::script('webapp/resources/assets/js/bootstrap.min.js') !!}

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    </head>

    <body>



        <div id="login-overlay" class="modal-dialog">

          <div class="modal-content">

              <div class="modal-header">

                  <h4 class="modal-title" id="myModalLabel">Login to 500px.com</h4>

              </div>

              <div class="modal-body">

                  <div class="row">

                      <div class="col-xs-12">

                          <div class="well">

                              <a class="btn btn-default" href="{{url('redirect')}}">Login using 500px</a>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

      </div>

    </body>

</html>