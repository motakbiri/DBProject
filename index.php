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
    <title>La Lay Lay Project</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="node_modules/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="stylesheets/main.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container theme-showcase" role="main" style="margin-bottom: 100px">
    <div class="jumbotron">
        <h2>IOT Shop</h2>
        <p>Shop the Best And newest Sensor for Your Intelligent Home</p>
        <div class="page-header">
            <h3>Actions</h3>
        </div>
        <a href="functions/orders.php" class="btn btn-primary">Orders Of User</a>
        <a href="functions/invoice.php" class="btn btn-info">Invoice Of Users</a>
        <a href="functions/sensors_data.php" class="btn btn-success">Sensors Data</a>
        <a href="functions/increase.php" class="btn btn-primary">Increase Sensors</a>
    </div>
    <?php
    if (isset($_POST['query'])) {
        // Create connection
        $conn = new mysqli(SERVER_NAME, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

        // Check connection
        if ($conn->connect_error) {
            echo '
                <div class="alert alert-danger" role="alert">
                    <strong>ای بابا!</strong>بد شد.
                </div>
                ';
        } else {
            $result = $conn->query($_POST['query']);
            if (gettype($result) == 'object') {
                echo '<div class="page-header"><h1>Tables</h1></div>';
                echo '<table class="table table-striped">';
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<thead>';
                    foreach ($row as $key => $item) {
                        echo '<th>' . $key . '</th>';
                    }
                    echo '</thead><tbody>';
                    do {
                        echo '<tr>';
                        foreach ($row as $item) {
                            echo '<td>' . $item . '</td>';
                        }
                        echo '</tr>';

                    } while ($row = $result->fetch_assoc());
                    echo '</tbody>';
                }
                echo '</table>';
            } else if ($result == true) {
                // echo '<div class="alret alert-danger" role="alret">';
                // echo $result;
                // echo '</div>';

                echo '<div class="alert alert-success" role="alert">
                        <strong>Well done!</strong> Your Query Successfully Executed.
                    </div>';
            } else {
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
            <textarea class="form-control" rows="6" name="query"></textarea>
        </div>
        <button type="button submit" class="btn btn-success">Execute</button>
    </form>


</div>

<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
