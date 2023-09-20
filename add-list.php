<?php
include('constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKOMI TASK MANAGER</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>style.css">
</head>
<body>
<div class="wrapper">
    <h1>MyTaskManager</h1>

    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-lists.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
        <?php
        //Check if the session is created or not
        if(isset($_SESSION['add_fail']))
        {
            //Display session message
            echo $_SESSION['add_fail'];
            //Remove message after one time display
            unset($_SESSION['add_fail']);
        }
        
        ?>
    </p>

    <!-- Form to Add Lists Starts here -->

    <form method="POST" action="" >
        <table class="tbl-half">
            <tr>
                <td>List Name: </td>
                <td><input type="text" name="list_name" placeholder=" Type List Name Here" required = "required"></td>
            </tr>
            <tr>
                <td>List Description</td>
                <td><textarea name="list_description" id="" cols="30" rows="10" placeholder="Type Description Here"></textarea></td>
            </tr>

            <tr>
                <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE"></td>
            </tr>

        </table>

    </form>



     <!-- Form to Add Lists Ends here -->





     </div>
</body>
</html>

<?php

//Check whether the form is submitted or not
    if(isset($_POST['submit']))
    {
        //echo "Form Submitted";  

        //Get the values from form and save it in variables
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        //Connect database
        // $mysqli = new mysqli("LOCALHOST","DB_USERNAME","DB_PASSWORD","DB_NAME");
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
        

    // Check connection
    // if ($mysqli -> connect_errno) {
    //   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    //   exit();
    // }

    //Select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    //SQL Query to insert data into database

    $sql = "INSERT INTO tbl_lists SET
    list_name = '$list_name', 
    list_description = '$list_description'
    ";

    //Execute Query and insert into database
    $res = mysqli_query($conn, $sql);

    // //Check if query executed successfully of not
    if($res==true)
    {
        //Data inserted successfully
        // echo "Data Inserted Successfully";

        //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
        $_SESSION['add'] = "List Added Successfully";

        //Redirect to Manage lIST Page
        header('location:'.SITEURL.'manage-lists.php');

        
        
    }
    else
    {
        //Failed to insert data
        // echo "Failed to insert data";

        //CREATE A SESSION VARIABLE TO SAVE MESSAGE
        $_SESSION['add_fail'] = "Failed to Add List";

        //Redirect to same page
        header('location:'.SITEURL.'add-list.php');
    }


    }
    
    


















?>