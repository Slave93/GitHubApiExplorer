<?php
require_once("functions.php");
if(!isset($_GET["language"])){
    header("Location: index.html");
}
$language = $_GET["language"];
$korisnici = brojKorisnikaJezika($language);
$repozitorijumi = brojRepozitorijumaJezika($language);
//Workaorund for github api bug that if no bugs for requested language is found it returns all bugs
//wich is not what this application needs
$otvoreniBagovi = 0;
$zatvoreniBagovi = 0;
if($repozitorijumi>0){
    $otvoreniBagovi = brojBagovaJezika($language, "open");
    $zatvoreniBagovi = brojBagovaJezika($language, "closed");
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icons/favicon.ico">

    <title>Your Language on GitHub</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
    <link href="cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<input type="hidden" id="language" value="<?php echo $_GET['language'];?>">
<input type="hidden" id="numRepos" value="<?php echo $repozitorijumi;?>">
<input type="hidden" id="numUsers" value="<?php echo $korisnici;?>">
<input type="hidden" id="numOpenBugs" value="<?php echo $otvoreniBagovi;?>">
<input type="hidden" id="numClosedBugs" value="<?php echo $zatvoreniBagovi;?>">
<div class="site-wrapper">

    <div class="site-wrapper-inner">



        <div class="cover-container">

            <!-- Carousel
                ================================================== -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>There are <?php echo number_format($repozitorijumi); ?> repositories related to <?php echo $language; ?></h1>
                                <p>Fill the box and submit to find out how many of them have specific number of stars.
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4"><input id="inputStars" type="text" class="form-control"></div>
                                </div>
                                <button onclick="fillModalRepos()" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modalRepos" role="button">Find Out</button>
                                </p>


                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>There are <?php echo number_format($otvoreniBagovi); ?> open and <?php echo number_format($zatvoreniBagovi); ?>
                                    closed bugs related to <?php echo $language ?></h1>
                                <p>Click on the buttons below to find out the oldest or the newest bug.</p>
                                <p><button onclick="fillModalBugs('obug')" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modalBugs" role="button">Oldest Bug</button><button onclick="fillModalBugs('nbug')" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modalBugs" role="button">Latest Bug</button></p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>There are <?php echo number_format($korisnici); ?>  users that use <?php echo $language ?></h1>
                                <p>Fill the box and submit to find out how many of them are from chosen country.
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4"><input id="inputCountry" type="text" class="form-control"></div>
                                </div>
                                <button onclick="fillModalUsers()" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modalUsers" role="button">Find Out</button>
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- /.carousel -->

            <!-- Modal -->
            <div class="modal fade" id="modalRepos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color: black"><p id="modalReposTitle"></p></h4>
                        </div>
                        <div class="modal-body" style="color: black">
                            <p id="modalReposBody"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalBugs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color: black"><p id="modalBugsTitle"></p></h4>
                        </div>
                        <div class="modal-body" style="color: black">
                            <p id="modalBugsBody"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="color: black"><p id="modalUsersTitle"></p></h4>
                        </div>
                        <div class="modal-body" style="color: black">
                            <p id="modalUsersBody"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="mastfoot">
                <div class="inner">
                    <p> Exploring <a href="https://developer.github.com/v3/">GitHub REST API</a> , by Ica,Diki,Ljuba,Slave</p>
                </div>
            </div>
            <form action="index.html">
                <p class="lead">
                    <button type="submit" value="choose another language" class="btn btn-lg btn-default">Choose another Language</button>
                </p>
            </form>
        </div>

    </div>

</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="dodatneInformacije.js"></script>
<script>
    function fillModalRepos(){
        stars = $("#inputStars").val();
        repos = $("#numRepos").val();
        if(repos==0){
            //just open empty modal
            popuniRepozitorijumeSaZvezdicom("x","x","")
        }else if(!isNaN(stars) && stars>-1 && stars.length>0){
            language = $("#language").val();
            popuniRepozitorijumeSaZvezdicom(language,stars);
        }else{
            popuniRepozitorijumeSaZvezdicom("x","x","Wrong input!<br/>Number of stars must be a number greater or equal to zero!");
        }



    }
    function fillModalBugs(option){
        language = $("#language").val();
        openBugs = $("#numOpenBugs").val();
        closedBugs = $("#numClosedBugs").val();
        if(openBugs==0 && closedBugs==0){
            //just open empty modal
            popuniBag("x","x","")
        }else{
            popuniBag(language,option);
        }
    }
    function fillModalUsers(){
        country = $("#inputCountry").val();
        users = $("#numUsers").val();
        if(users==0){
            //just open empty modal
            popuniRepozitorijumeSaZvezdicom("x","x","")
        }else if(isNaN(country) && country.length>0){
            language = $("#language").val();
            popuniKorisnikeIzZemlje(language,country);
        }else{
            popuniKorisnikeIzZemlje("x","x","Wrong input!</br><h1>"+country+"</h1> is not a country!");
        }
    }
</script>
</body>
</html>