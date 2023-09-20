<?php
    include('constants.php');

    //Get the current values of selected lists
    if(isset($_GET['List_id']))
    {
        //Get list id value
        $List_id = $_GET['List_id']; 

        //Connect to database

//Connect  the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));

    //Select db
    $db_select = mysqli_select_db($conn, DB_NAME);

    //Write the query to get the values from dtatbase
    $sql = "SELECT * FROM tbl_lists WHERE List_id = $List_id ";


    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether query executed successfully or not
    if($res==true)
    {
        //Get value from database
        $row = mysqli_fetch_assoc($res); //Value is in array

        //Printing $row array
        //print_r($row);

        //Create individual variable to save data
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
        
    }
    else
    {
        //Failed to delete list
        
        header('location:'.SITEURL.'manage-lists.php');

    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumeIKOMI TASK MANAGER</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>style.css">
</head>
<body>
    <div class="wrapper">
    <h1>MyTaskManager</h1>

    

    <a class="btn-secondary" href="<?php echo SITEURL ?>">Home</a>
    <a class="btn-secondary" href="<?php echo SITEURL ?>manage-lists.php">Manage List</a>

    

    <h3>Update List Page</h3>

    <p>
        <?php
        //Check if session is set
        if(isset($_SESSION['update_fail']))
        {
            echo $_SESSION['update_fail'];
            unset($_SESSION['update_fail']);
        }
        ?>
    </p>

    <form method="POST" action="">
        <table class="tbl-half">
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" value="<?php echo $list_name ?>" required="required"></td>
            </tr>
            <tr>
                <td>List Description:</td>
                <td>
                    <textarea name="list_description" id="" cols="30" rows="10">
                        <?php echo $list_description ?>

                    </textarea>
            </td>
            </tr>

            <tr>
                <td><input class="btn-lg btn-primary" type="submit" name="submit" value="UPDATE"></td>


            </tr>
        </table>


    </form>

    </div>
</body>
</html>

<?php
    //Check if update button is set 
    if(isset($_POST['submit']))
    {
        // echo "Button clicked";

        //Get the updated values from form
        $list_name = $_POST['list_name'] ;
        $list_description = $_POST['list_description'];

        //Connect database
       
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));

        //Select db
        $db_select = mysqli_select_db($conn2, DB_NAME);

        //Write the query to delete list from dtatbase
        $sql2 = "UPDATE tbl_lists SET
        list_name = '$list_name',
        list_description = '$list_description'
        WHERE list_id = $List_id
        
         ";

        //Execute the query
        $res2 = mysqli_query($conn2, $sql2);

        //Check whether query executed successfully or not
        if($res2==true)
        {
            //Update Successful
            //Set the message
            $_SESSION['update'] = "List Updated Successfully";
            //Redirect to manage list page
            header('location:'.SITEURL.'manage-lists.php');
        }
        else
        {
            //Failed to Update
            
            $_SESSION['update_fail'] = "Failed to update list";
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
        }

    
    
    }



?>
























