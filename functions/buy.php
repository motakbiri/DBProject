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

<form action="buy.php" method="post" class="container theme-showcase" role="main">
    <?php
    if ($conn->connect_error)
        echo '<div class="alert alert-danger" role="alert"><strong>ای بابا!</strong>بد شد.</div>';
    else {
        // Determine If Sensors remain is more than zero ======
        $remain = 0;
        if (isset($_POST['type'])) {
            $query = "Select Remain From Sensors WHERE TYPE =" . $_POST['type'] . " LIMIT 1;";
            $result = $conn->query($query);
            $remain = $result->fetch_row();
        }
        if(isset($_POST['type']) && (!isset($remain[0]) || $remain[0] < 1)){
            echo '<div class="alert alert-danger" role="alert">Mojood Nadarim</div>';
        }
        elseif (isset($_POST['type']) && isset($_POST['username'])) {
            // Get last Product Code ========
            $query = "SELECT ProductCode From orders order by ProductCode DESC limit 1";
            $result = $conn->query($query);
            $product_code = $result->fetch_row();
            if ($product_code && isset($product_code[0]))
                $product_code = $product_code[0] + 1;
            else
                $product_code = 1;
            // Insert Record To Orders ======
            $query = "INSERT INTO `orders`(`ProductCode`, `UserName`, `Type`, `BuyTime`) 
                      VALUES('" . $product_code . "', '" . $_POST['username'] . "', '" . $_POST['type'] . "','" . date('Y-m-d H:i:s') . "');";
            $result = $conn->query($query);
            // Decrease Record To Orders ======
            $query = "UPDATE Sensors SET Remain = Remain-1 WHERE TYPE =" . $_POST['type'] . ";";
            $result = $conn->query($query);
            //=================================
            if ($result)
                echo '<div class="alert alert-success" role="alert">Bought Successfully</div>';
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
                    echo '<td><input type="radio" name="type" value="' . $row['Type'] . '"></td>';
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
    }
    ?>

    <div class="form-group">
        <label for="usr">User:</label>
        <select name="username" id="usr">
            <?php
            $query = "select username from users;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
            };
            ?>
        </select>
    </div>
    <button type="button submit" class="btn btn-primary">Buy</button>

    <div class="page-header">
        <h1>Actions</h1>
    </div>

    <a href="../index.php" class="btn btn-default">Main Page</a>
    <a href="orders.php" class="btn btn-primary">Orders Of User</a>
    <a href="invoice.php" class="btn btn-info">Invoice Of Users</a>
    <a href="sensors_data.php" class="btn btn-success">Sensors Data</a>
    <a href="increase.php" class="btn btn-primary">Increase Sensors</a>
    <a href="buy.php" class="btn btn-danger">Buy</a>
</form>

<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
