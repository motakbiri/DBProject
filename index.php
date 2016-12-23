<?php
    require_once 'variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="favicon.ico"> -->

    <title>La Lay Lay Project</title>

    <!-- Bootstrap core CSS -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="node_modules/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="stylesheets/main.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="theme.css" rel="stylesheet"> -->
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
<!--         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bootstrap theme</a>
        </div>
 -->        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="about.php">About</a></li>
<!--                 <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<div class="container theme-showcase" role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>IOT Shop</h1>
        <p>Shop the Best And newest Sensor for Your Intelligent Home</p>
    </div>


    <?php
    if(isset($_POST['query']))
    {
        // Create connection
        $conn = new mysqli(SERVER_NAME, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

        // Check connection
        if ($conn->connect_error)
        {
            echo '
                <div class="alert alert-danger" role="alert">
                    <strong>ای بابا!</strong>بد شد.
                </div>
                ';
        }
        else
        {
            $result = $conn->query($_POST['query']);
            if(gettype($result)=='object')
            {
                echo '<div class="page-header"><h1>Tables</h1></div>';
                echo '<table class="table table-striped">';
                if ($result->num_rows > 0) 
                {
                    $row = $result->fetch_assoc();
                    echo '<thead>';
                    foreach ($row as $key => $item) 
                    {
                        echo '<th>' . $key . '</th>';
                    }
                    echo '</thead><tbody>';
                    do 
                    {
                        echo '<tr>';
                        foreach ($row as $item) 
                        {
                            echo '<td>' . $item . '</td>';
                        }
                        echo '</tr>';

                    } 
                    while ($row = $result->fetch_assoc());
                    echo '</tbody>';
                }
                echo '</table>';
            }
            else if($result == true)
            {
                // echo '<div class="alret alert-danger" role="alret">';
                // echo $result;
                // echo '</div>';

                echo '<div class="alert alert-success" role="alert">
                        <strong>Well done!</strong> Your Query Successfully Executed.
                    </div>';
            }
            else
            {
                echo '
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.
                    </div>
                ';
            }
        }
    }

    if(isset($_POST['showorders']))
    {
        // Create connection
        $conn = new mysqli(SERVER_NAME, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

        // Check connection
        if ($conn->connect_error)
        {
            echo '
                <div class="alert alert-danger" role="alert">
                    <strong>ای بابا!</strong>بد شد.
                </div>
                ';
        }
        else
        {
            $query = "select * from orders where username='" . $_POST['showorders'] . "'";
            $result = $conn->query($query);
            if(gettype($result)=='object')
            {
                echo '<div class="page-header"><h1>Table</h1></div>';
                echo '<table class="table table-striped">';
                if ($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                    echo '<thead>';
                    foreach ($row as $key => $item) 
                    {
                        echo '<th>' . $key . '</th>';
                    }
                    echo '</thead><tbody>';
                    do 
                    {
                        echo '<tr>';
                        foreach ($row as $item) 
                        {
                            echo '<td>' . $item . '</td>';
                        }
                        echo '</tr>';

                    } 
                    while ($row = $result->fetch_assoc());
                    echo '</tbody>';
                }
                echo '</table>';
            }
            else
            {
                echo '
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.
                    </div>
                ';
            }
        }


    }
    ?>

    <div class="page-header">
        <h1>Query</h1>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <!-- <div for="pwd">Query:</div> -->
            <textarea class="form-control" rows="6" name="query"></textarea>
        </div>
        <button type="button submit" class="btn btn-success">Execute</button>
    </form>


    <div class="page-header">
        <h1>Actions</h1>
    </div>

    <!-- <button type="button" class="btn btn-default">Default</button> -->

    <form action="index.php" method="post">
        <div class="form-group">
            <label for="usr">Username:</label>
            <input type="text" class="form-control" id="usr" name="showorders">
        </div>
        <button type="button submit" class="btn btn-primary">show orders for this user</button>
    </form>

    <br><br><br>
    <button type="button" class="btn btn-primary">Primary</button>
    <br>
    <button type="button" class="btn btn-success">Success</button>
    <br>
    <button type="button" class="btn btn-info">Info</button>
    <br>
    <button type="button" class="btn btn-warning">Warning</button>
    <br>
    <button type="button" class="btn btn-danger">Danger</button>
    <br>




<!-- 
    <div class="page-header">
        <h1>Labels</h1>
    </div>

    <p>
        <span class="label label-default">Default</span>
        <span class="label label-primary">Primary</span>
        <span class="label label-success">Success</span>
        <span class="label label-info">Info</span>
        <span class="label label-warning">Warning</span>
        <span class="label label-danger">Danger</span>
    </p>


    <div class="page-header">
        <h1>Badges</h1>
    </div>
    <p>
        <a href="#">Inbox <span class="badge">42</span></a>
    </p>
 -->
<!-- 
    <div class="page-header">
        <h1>Dropdown menus</h1>
    </div>
    <div class="dropdown theme-dropdown clearfix">
        <a id="dropdownMenu1" href="#" class="sr-only dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active"><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </div>
 -->
<!-- 
    <div class="page-header">
        <h1>Alerts</h1>
    </div>
    <div class="alert alert-success" role="alert">
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>
    <div class="alert alert-info" role="alert">
        <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
    </div>
    <div class="alert alert-warning" role="alert">
        <strong>Warning!</strong> Best check yo self, you're not looking too good.
    </div>
    <div class="alert alert-danger" role="alert">
        <strong>Oh snap!</strong> Change a few things up and try submitting again.
    </div>

 -->

<!-- 
    <div class="page-header">
        <h1>Panels</h1>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>
 -->

<!--     <div class="page-header">
        <h1>Wells</h1>
    </div>
    <div class="well">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
 -->
<br>
<br>
<br>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
