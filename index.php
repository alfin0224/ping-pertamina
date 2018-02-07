<!--
* GenesisUI Bootstrap 4 Admin Template built as framework!
* Version 1.4.1
* https://GenesisUI.com
* Copyright 2016 creativeLabs Łukasz Holeczek
* License : https://GenesisUI.com/license.html
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="ROOT Admin - UI Admin Kit Powered by Bootstrap 4">
        <meta name="author" content="Lukasz Holeczek">
        <meta name="keyword" content="ROOT Admin - UI Admin Kit Powered by Bootstrap 4">
        <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
        <title>Login Admin</title>
        <!-- Main styles for this application -->
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card-group vamiddle">
                        <div class="card  p-a-2">
                            <div class="card-block">
                            <div style="padding-bottom:10%;">
                               <img src="assets/img/logo_pertamina.png" style="height:35px; ">
                            </div>
                            
                                <h3>Login || Net Monitoring</h3>
                                <p class="text-muted">Sign In to your account</p>
                                <form method="post" action="proses/proses_login.php">
                                    <div class="input-group m-b-1">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="input-group m-b-2">
                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" name="login" class="btn btn-primary p-x-2">Login</button>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <button type="button" class="btn btn-link p-x-0">Forgot password?</button>
                                    </div>
                                </div> 
                                </form>

                            </div>
                        </div>
                        <div class="card card-inverse card-primary p-y-3" style="width:44%">
                            <div class="card-block text-xs-center">
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap and necessary plugins -->
        <script src="assets/js/libs/jquery.min.js"></script>
        <script src="assets/js/libs/tether.min.js"></script>
        <script src="assets/js/libs/bootstrap.min.js"></script>
        <script>
        function verticalAlignMiddle()
        {
            var bodyHeight = $(window).height();
            var formHeight = $('.vamiddle').height();
            var marginTop = (bodyHeight / 2) - (formHeight / 2);
            if (marginTop > 0)
            {
                $('.vamiddle').css('margin-top', marginTop);
            }
        }
        $(document).ready(function()
        {
            verticalAlignMiddle();
        });
        $(window).bind('resize', verticalAlignMiddle);
        </script>
        
        
    </body>
</html>