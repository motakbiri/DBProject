<?php
require_once '../variables.php';
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
    <link href="../node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="../node_modules/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="../stylesheets/main.css" rel="stylesheet">
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

<div class="container theme-showcase" role="main">
    <?php
        if ($conn->connect_error)
            echo '<div class="alert alert-danger" role="alert"><strong>ای بابا!</strong>بد شد.</div>';
        elseif(isset($_POST['username'])){
            $query = "select sum(price) as totalSum from (select price from orders natural join sensors where orders.username='" . $_POST['username'] . "') as prices";
            $result = $conn->query($query);
            if (gettype($result) == 'object') {
                echo '<div class="page-header"><h1>sum of orders for ' . $_POST['username'] . '</h1></div>';
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
            }
            else
                echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.</div>';
        }
    ?>

    <form action="invoice.php" method="post">
        <div class="form-group">
            <label for="usr">Username:</label>
            <input type="text" class="form-control" id="usr" name="username">
        </div>
        <button type="button submit" class="btn btn-primary">show sum of orders for this user</button>
    </form>

    <div class="page-header">
        <h1>Actions</h1>
    </div>

    <a href="../index.php" class="btn btn-default">Main Page</a>
    <a href="orders.php" class="btn btn-primary">Orders Of User</a>
    <a href="." class="btn btn-info">Invoice Of Users</a>
    <a href="sensors_data.php" class="btn btn-success">Sensors Data</a>
    <a href="increase.php" class="btn btn-primary">Increase Sensors</a>

</div>

<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
