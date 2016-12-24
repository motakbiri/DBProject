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
        else if (isset($_POST['username'])) {
//        else if (1) {
    ?>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <?php
                    $query = "SELECT 
                                Sensors.Name,
                                Sensors.Type,
                                Sensors.Price,
                                Orders.ProductCode,
                                GasSensor.Time,
                                GasSensor.CO2,
                                GasSensor.CH4,
                                GasSensor.CO
                          FROM Sensors 
                          JOIN Orders ON Orders.Type=Sensors.Type
                          JOIN GasSensor ON Orders.ProductCode = GasSensor.ProductCode
                          WHERE Orders.Type = 1 AND Orders.UserName='" . $_POST['username'] . "'";
                    $result = $conn->query($query);
                    if (gettype($result) == 'object') {
                        echo '<div class="page-header"><h3>Information Of Gas Sensors for ' . $_POST['username'] . '</h3></div>';
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
                    } else
                        echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.</div>';
                    ?>
                </div>
                <div class="col-md-6 col-xs-12">
                    <?php
                    $query = "SELECT 
                                Sensors.Name,
                                Sensors.Type,
                                Sensors.Price,
                                Orders.ProductCode,
                                HumiditySensor.Time,
                                HumiditySensor.Soil,
                                HumiditySensor.Air
                          FROM Sensors 
                          JOIN Orders ON Orders.Type=Sensors.Type
                          JOIN HumiditySensor ON Orders.ProductCode = HumiditySensor.ProductCode
                          WHERE Orders.Type = 2 AND Orders.UserName='" . $_POST['username'] . "'";
                    $result = $conn->query($query);
                    if (gettype($result) == 'object') {
                        echo '<div class="page-header"><h3>Information Of Humidity Sensors for ' . $_POST['username'] . '</h3></div>';
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
                    } else
                        echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.</div>';
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <?php
                    $query = "SELECT 
                                Sensors.Name,
                                Sensors.Type,
                                Sensors.Price,
                                Orders.ProductCode,
                                LightSensor.Time,
                                LightSensor.Intensity,
                                LightSensor.BaseIntensity
                          FROM Sensors 
                          JOIN Orders ON Orders.Type=Sensors.Type
                          JOIN LightSensor ON Orders.ProductCode = LightSensor.ProductCode
                          WHERE Orders.Type = 3 AND Orders.UserName='" . $_POST['username'] . "'";
                    $result = $conn->query($query);
                    if (gettype($result) == 'object') {
                        echo '<div class="page-header"><h3>Information Of Light Sensors for ' . $_POST['username'] . '</h3></div>';
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
                    } else
                        echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.</div>';
                    ?>
                </div>
                <div class="col-md-6 col-xs-12">
                    <?php
                    $query = "SELECT 
                                Sensors.Name,
                                Sensors.Type,
                                Sensors.Price,
                                Orders.ProductCode,
                                TemperatureSensor.Time,
                                TemperatureSensor.Temperature
                          FROM Sensors 
                          JOIN Orders ON Orders.Type=Sensors.Type
                          JOIN TemperatureSensor ON Orders.ProductCode = TemperatureSensor.ProductCode
                          WHERE Orders.Type = 4 AND Orders.UserName='" . $_POST['username'] . "'";
                    $result = $conn->query($query);
                    if (gettype($result) == 'object') {
                        echo '<div class="page-header"><h3>Information Of Temperature Sensors for ' . $_POST['username'] . '</h3></div>';
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
                    } else
                        echo '<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> Your Query Wasn\'t Successfully Executed.</div>';
                    ?>
                </div>
            </div>
    <?php
        }
    ?>

    <form action="sensors_data.php" method="post">
        <div class="form-group">
            <label for="usr">Username:</label>
            <input type="text" class="form-control" id="usr" name="username">
        </div>
        <button type="button submit" class="btn btn-primary">Show Sensors Data</button>
    </form>

    <div class="page-header">
        <h1>Actions</h1>
    </div>

    <a href="../index.php" class="btn btn-default">Main Page</a>
    <a href="orders.php" class="btn btn-primary">Orders Of User</a>
    <a href="invoice.php" class="btn btn-info">Invoice Of Users</a>
    <a href="sensors_data.php" class="btn btn-success">Sensors Data</a>
    <a href="increase.php" class="btn btn-primary">Increase Sensors</a>
    <a href="buy.php" class="btn btn-danger">Buy</a>

</div>

<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
