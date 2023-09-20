<?php
include('constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKOMI TASK MANGER</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>style.css">
</head>
<body>
    <div class="wrapper">
    <h1>MyTaskManager</h1>

    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>

    <h3>Manage Lists Page</h3>

    <p>
        <?php
        //Check if the session is created or not
        if(isset($_SESSION['add']))
        {
            //Display session message
            echo $_SESSION['add'];
            //Remove message after one time display
            unset($_SESSION['add']);
        }

        //Check the session if delete is created or not
        if(isset($_SESSION['delete']))
        {
            //Display session message
            echo $_SESSION['delete'];
            //Remove message after one time display
            unset($_SESSION['delete']);
        }

        //Check for update fail
        if(isset($_SESSION['update']))
        {
            //Display session message
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        //Check for delete fail
        if(isset($_SESSION['delete_fail']))
        {
            //Display session message
            echo $_SESSION['delete_fail'];
            //Remove message after one time display
            unset($_SESSION['delete_fail']);
        }
        
        ?>
    </p>


    <!-- Table to display list starts here -->
    <div class="all-lists">
        <a class="btn-primary" href="<?php echo SITEURL; ?>add-list.php">Add Lists</a>


        <table class="tbl-half">
            <tr>
                <th>S/N</th>
                <th>List Name</th>
                <th>Actions</th>
            </tr>

            <?php
            //Connect the db
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));

            //Select db
            $db_select = mysqli_select_db($conn, DB_NAME);
            

            //SQL Query to display all data from database
            $sql = "SELECT * FROM tbl_lists";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Check if Query executed or not
            if($res == true)
            {
                //display data
                // echo "Executed"; 

                //Count the rows of data in database
                $count_rows = mysqli_num_rows($res);

                //Create a Serial Number Variable
                $sn = 1;

                //Check if there's data in database of not
                if($count_rows>0)
                {
                    //If there's data in database, Display in table

                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Getting data from database
                        $List_id = $row['List_id'];
                        $list_name = $row['list_name'];
                        ?>
                        <tr>
                            <td><?php echo $sn++;?>. </td>
                            <td><?php echo $list_name;?> </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-list.php?List_id=<?php echo $List_id; ?>">Update</a>
                                <a href="<?php echo SITEURL; ?>delete-list.php?List_id=<?php echo $List_id; ?>">Delete</a> 
                            </td>
                        </tr>    
            



                        <?php

                    }
                }
                else
                {
                    //No data in Database
                    ?>

                    <tr>
                        <td colspan="3">No List Added Yet</td>
                    </tr>

                    <?php

                    

                }


            }

            
            ?>

        </table>
    </div>  


    <!-- Table to display list ends here -->


    

    </div>
</body>
</html>