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

    <!--Menu Starts Here-->
    <div class="menu">



        <a href="<?php echo SITEURL; ?>">Home</a>

        <?php
        //Displaying lists from dn in menu

        //Connect db 
        //Connect  the database
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
        //Select db
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        //Write the query to get list from dtatbase
        $sql2 = "SELECT * FROM tbl_lists";

        //Execute query
        $res2 = mysqli_query($conn2, $sql2);

        //Check if query executed successfully or not
        if($res2==true)
        {
            //Display lists on menu
            while($row2 = mysqli_fetch_assoc($res2))
            {
                $list_id = $row2['List_id'];
                $list_name = $row2['list_name'];
                ?>
                    <a href="<?php echo SITEURL; ?>list-task.php?List_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                <?php

            }
        }

        ?>

        

        <a href="<?php echo SITEURL; ?>manage-lists.php">Manage Lists</a>

    </div> 


    <!-- Menu Ends Here-->

    

    <!-- Task Starts Here -->

    <p>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['delete_fail']))
            {
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
        
        ?>
        </p>
    <div class="all-tasks">
        <a class="btn-primary" href="<?php SITEURL; ?>add-task.php">Add Task</a>
        <table class="tbl-full">

        <tr>
            <th>S/N</th>
            <th>Task Name</th>
            <th>Priority</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>

            <?php 
            //Connect  the database
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
            //Select db
            $db_select = mysqli_select_db($conn, DB_NAME);

            //Write the query to get list from dtatbase
            $sql = "SELECT * FROM tbl_tasks";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Check whether query executed successfully or not
            if($res==true)
            {
                //Display task from database
                //Count the tasks on the database
                $count_rows =  mysqli_num_rows($res);

                //Create serial number variable
                $sn = 1;

                //Check if there are tasks on db or not
                if($count_rows>0)
                {
                    //Data in database
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $task_id = $row['task_id'];
                        $task_name = $row['task_name'];
                        $priority = $row['priority'];
                        $deadline = $row['deadline'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                </td>    
                            </tr>        
                        <?php            


                                
                            
                        
                    }
                }
                else
                {
                    //No data in database
                    ?>

                    <tr>
                        <td colspan="5">No Task Added yet</td>
                    </tr>
                    <?php
                }
                
            }
            ?>
        


        </table>

    </div>


    <!-- Task Starts Here -->


    </div>
</body>
</html>