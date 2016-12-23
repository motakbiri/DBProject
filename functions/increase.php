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

<form action="increase.php" method="post" class="container theme-showcase" role="main">
    <?php
        if ($conn->connect_error)
            echo '<div class="alert alert-danger" role="alert"><strong>ای بابا!</strong>بد شد.</div>';
        else{
            if(isset($_POST['type']) && isset($_POST['number'])){
                $query = "update sensors set remain = remain+".$_POST['number']." where type=".$_POST['type'].";";
                $result = $conn->query($query);
                if($result)
                    echo '<div class="alert alert-success" role="alert">Added Successfully</div>';
            }
            $query = "select * from Sensors;";
            $result = $conn->query($query);
            if (gettype($result) == 'object') {
                echo '<div class="page-header"><h1>Sensors</h1></div>';
                echo '<table class="table table-striped">';
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<thead>';
                    echo '<th>To Increase</th>';
                    foreach ($row as $key => $item) {
                        echo '<th>' . $key . '</th>';
                    }
                    echo '</thead><tbody>';
                    do {
                        echo '<tr>';
                        echo '<td><input type="radio" name="type" value="'.$row['Type'].'"></td>';
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

    <div class="form-group">
        <label for="usr">Number:</label>
        <input type="text" class="form-control" id="usr" name="number">
    </div>
        <button type="button submit" class="btn btn-primary">Increase</button>

    <div class="page-header">
        <h1>Actions</h1>
    </div>

    <a href="../index.php" class="btn btn-default">Main Page</a>
    <a href="orders.php" class="btn btn-primary">Orders Of User</a>
    <a href="invoice.php" class="btn btn-info">Invoice Of Users</a>
    <a href="sensors_data.php" class="btn btn-success">Sensors Data</a>
    <a href="increase.php" class="btn btn-primary">Increase Sensors</a>
</form>

<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
