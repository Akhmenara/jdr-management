<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <script src="/assets/ext/jquery/js/jquery.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <style>
            @import url(http://fonts.googleapis.com/css?family=Roboto:400);
            body {
              background-color:#fff;
              -webkit-font-smoothing: antialiased;
              font: normal 14px Roboto,arial,sans-serif;
            }

            .container {
                padding: 25px;
                position: fixed;
            }

            .form-login {
                background-color: #EDEDED;
                padding-top: 10px;
                padding-bottom: 20px;
                padding-left: 20px;
                padding-right: 20px;
                border-radius: 15px;
                border-color:#d2d2d2;
                border-width: 5px;
                box-shadow:0 1px 0 #cfcfcf;
            }

            h4 {
             border:0 solid #fff;
             border-bottom-width:1px;
             padding-bottom:10px;
             text-align: center;
            }

            .form-control {
                border-radius: 10px;
            }

            .wrapper {
                text-align: center;
            }

        </style>
    </head>
    <body>
        <div class="container">
    <div class="row">
        <div class="col-md-offset-6 col-md-3">
            <div class="form-login">
            <h4>Bienvenue aventurier</h4>
            <form method="post" action="<?php echo site_url('Login/login'); ?>">
                <input type="text" id="name" name="name" class="form-control input-sm chat-input" placeholder="Nom" />
                </br>
                <div class="wrapper">
                    <span class="group-btn">
                        <input type="submit" class="btn btn-primary btn-md" value="Se connecter"/><i class="fa fa-sign-in"></i>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
