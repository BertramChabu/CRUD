<?php
$connection = mysqli_connect("localhost:3308", "root", "", "student");

if (!$connection) {
    echo "<script>alert('error connecting to database')</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submit'])) {
        $tire_quanity = isset($_POST['tireqty']) ? $_POST['tireqty'] : 0;
        $oil_quanity = isset($_POST['oilqty']) ? $_POST['oilqty'] : 0;
        $spark_quanity = isset($_POST['sparkqty']) ? $_POST['sparkqty'] : 0;

        $sql = "INSERT INTO `order` (tire_quantity, oil_quantity, spark_quantity)
            VALUES ('$tire_quanity', '$oil_quanity', '$spark_quanity')";

        $result = mysqli_query($connection, $sql);

        if (!$result) {
            echo "Error in query submission: " . mysqli_error($connection);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        td {
            padding: 10px;
            border: 2px solid black;
            color: black;
        }
    </style>
</head>

<body style="background: rgb(238,174,202);background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);">
    <div class="container">
        <div class="row">
            <h1 class="text-center">CRUD</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 mt-3">
                <form action="" method="POST">
                    <table style="border: 2px solid black;">
                        <tr style="background:#3457D5">
                            <td style="width: 150px; text-align: center; font-weight: bold;">Item</td>
                            <td style="width: 150px; text-align: center; font-weight: bold;">Quantity</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Tires</td>
                            <td><input class="form-control" type="text" name="tireqty" size="3" maxlength="3" style="width: 150px;"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Oil</td>
                            <td><input class="form-control" type="text" name="oilqty" size="3" maxlength="3" style="width: 150px;"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Spark Plugs</td>
                            <td><input class="form-control" type="text" name="sparkqty" size="3" maxlength="3" style="width: 150px;"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;"></td>
                            <td><button class="btn btn-primary" type="submit" name="submit" style="width: 150px; margin-left: 3px;">Add</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-lg-9">
                <table style="border:2px solid black;">
                    <tr style="background:#3457D5; margin-bottom: 20px;">
                        <td style="width: 150px; text-align:center; font-weight: bold;">TIRE</td>
                        <td style="width: 150px; text-align:center; font-weight: bold;">OIL</td>
                        <td style="width: 150px; text-align:center; font-weight: bold;">SPARK</td>
                        <td style="width: 150px; text-align:center; font-weight: bold;">ACTION</td>
                        <td style="width: 150px; text-align:center; font-weight: bold;">ACTION</td>

                    </tr>
                    <?php
                    $sql = "SELECT * FROM `order`";
                    $query = mysqli_query($connection, $sql); ?>

                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row['tire_quantity']; ?></td>
                            <td style="text-align: center;"><?php echo $row['oil_quantity']; ?></td>
                            <td style="text-align: center;"><?php echo $row['spark_quantity']; ?></td>
                            <td style="text-align: center;">
                                <!-- Delete Button -->
                                <form method="post" action="">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['tire_quantity']; ?>">
                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                </form>
                                <?php
                                if (isset($_POST['delete'])) {
                                    $delete_id = $_POST['delete_id'];
                                    $sql = "DELETE FROM `order` WHERE tire_quantity = $delete_id";
                                    $result = mysqli_query($connection, $sql);
                                }
                                ?>


                                <!-- Update Button (Redirects to Update Form) -->

                            </td>
                            <!-- modal -->
                            <!-- Button trigger modal -->


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="tire_qty" value="<?php echo $row['tire_quantity']; ?>">
                                                <input type="hidden" name="oil_qty" id="oil" value="<?php echo $row['oil_quantity']; ?>">
                                                <input type="hidden" name="spark_qty" id="spark" value="<?php echo $row['spark_quantity']; ?>">
                                                <input name="tireqty" class="form-control mb-2" type="text" placeholder="Tire Quantity">
                                                <input name="oilqty" class="form-control mb-2" type="text" placeholder="Oil Quantity">
                                                <input name="sparkqty" class="form-control mb-2" type="text" placeholder="Sparks Quantity">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['update'])) {
                                            $tq = $_POST['tire_qty'];
                                            $oq = $_POST['oil_qty'];
                                            $sq = $_POST['spark_qty'];
                                            $tireqty = $_POST['tireqty'];
                                            $oilqty = $_POST['oilqty'];
                                            $sparkqty = $_POST['sparkqty'];

                                            $sql = "UPDATE `order`  SET tire_quantity = '$tireqty', oil_quantity = '$oilqty', spark_quantity = '$sparkqty' WHERE tire_quantity = '$tq' AND oil_quantity = '$oq' AND spark_quantity = '$sq'";

                                            $result = mysqli_query($connection, $sql);

                                            if ($result) {
                                                echo "<script>alert('Record updated successfully!')</script>";
                                            } else {
                                                echo "Error updating record: " . mysqli_error($connection);
                                            }
                                        }
                                    ?>



                                    </div>
                                </div>
                            </div>
                            <td style="text-align: center;">
                                <button class="btn btn-warning" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>




    <script>



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>



<?php
mysqli_close($connection);
?>
