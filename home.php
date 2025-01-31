<?php
	require_once('auth.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="appLogo.png" width="10" height="10" />
    <title>Split the Bill</title>

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>


<body>
    <nav class="navbar navbar-light bg-light" id="topnav">
        <a class="navbar-brand" href="#">
            <img class="mb-4" src="appLogo.png" alt="" width="50" height="50">
            <h1 class="nav-header">Split the Bill</h1>

        </a>

        <form class="form-inline" form action = "logout.php">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="search">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
    </nav>



    <div class="parent">
        <div class="child1">
            <ul class="nav flex-column">
                    <li class="nav-item">
                            <button type="submit" class="btn btn-primary" href="#" style="margin-left: 10px">Create Budget</button>
                        </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Budget 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Budget 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Budget 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Budget 4</a>
                </li>
            </ul>
        </div>
        <div class="child2">
            <div class="grandchild1">
                <h2>Budget 1</h2>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <h3 style="margin-top:70px;">Travel Time-Frame</h3>
                <h5 style="margin-top: 20px;">From:</h5>
                <input id="datepicker" width="276" />
                <script>
                    $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                </script>
                <h5 style="margin-top: 20px;">To:</h5>
                <div class="gj-datepicker gj-datepicker-bootstrap gj-unselectable input-group" role="wrapper" style="width: 276px;">
                    <input width="276" class="form-control" id="datepicker" role="input" data-type="datepicker" data-guid="41c91770-0527-8d05-98db-0550018de8fc"
                        data-datepicker="true">
                    <span class="input-group-append" role="right-icon">
                        <button class="btn btn-outline-secondary border-left-0 waves-effect waves-light" type="button">
                            <i class="gj-icon">event</i>
                        </button>
                    </span>
                </div>

                <script>
                    $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                </script>
            </div>

            <div class="grandchild2">
                <h1 style="margin-bottom: 20px;">Spending by Category</h1>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

    </div>



    <script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/compiled-4.8.10.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/mdbBootstrap/js/mdb.js"></script>
    <script type="text/javascript">
        //pie
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ["Flight", "Food", "Hotel", "Activities", "Other"],
                datasets: [{
                    data: [300, 50, 100, 40, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>