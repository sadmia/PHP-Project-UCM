<?php require('connectDB.php');


    $sqlData = "SELECT `ID`, `FullName`, `EmailAddress`, `PhoneNumber`, `Password`, `Gender` FROM data";
    $sqlDataQuery = mysqli_query($connectDB, $sqlData);


    if (isset($_POST['deleteOk'])) {
        $id = $_POST['deleteOk'];
        $deletesSQL = "DELETE FROM data WHERE ID = $id";
        $deletesSQL = mysqli_query($connectDB, $deletesSQL);
        header("Refresh:0");
    }

?>



<!DOCTYPE html>
<html>
    <head>

        <title>PHP Project</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>

    <body>

    <h1>A User Infarmation Table</h1> <br>

        <table id="customers">

          <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Password
            </th>
            <th>Gender</th>
            <th><a href="add_data.php" class="addDataBtn"><i class="fa-solid fa-user-plus"></i> Add Data</a></th>
          </tr>

          
                <?php while ($sqlDataQueryArrayData = mysqli_fetch_array($sqlDataQuery)) {
                    $idDB = $sqlDataQueryArrayData['ID'];
                    $fullNameDB = $sqlDataQueryArrayData['FullName'];
                    $emailDB = $sqlDataQueryArrayData['EmailAddress'];
                    $phoneNumberDB = $sqlDataQueryArrayData['PhoneNumber'];
                    $passwordDB = $sqlDataQueryArrayData['Password'];
                    $genderDB = $sqlDataQueryArrayData['Gender'];
                ?>

                <tr>
                    <td><?php echo $fullNameDB; ?></td>
                    <td><?php echo $emailDB; ?></td>
                    <td>0<?php echo $phoneNumberDB; ?></td>
                    <td><?php echo $passwordDB; ?></td>
                    <td><?php echo $genderDB; ?></td>
                    <td style="display: flex;">
                        <a href="edit_data.php?id=<?php echo $idDB; ?>">
                            <button class="button">Edit</button>
                        </a>
                        <form method="post" action="">
                            <button name="deleteOk" value="<?php echo $idDB; ?>" class="button deleteBtn dlBtn">Delete</button>
                        </form>
                    </td>
            </tr>
            <?php } ?>

        </table>

        <div class="deleteWorningDiv">
            <div class="deleteDiv">

                <h3>Confarm Delete</h3>
                <p>Are you sure you want to delete infarmation.</p>
                <div>
                    <button id="canselBtn" class="button">Cancel</button>
                    <form method="post" action="index.php">
                        <button name="valueId" id="ConfarmDeleteBtn" class="button deleteBtn" value="<?php echo $idDB; ?>">Delete</button>
                    </form>
                </div>
            </div>
        </div>


    <script src="js/castom.js"></script>
    </body>
</html>


