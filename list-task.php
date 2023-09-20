<?php
include('constants.php');
//Get List_id from url

$list_id_url = $_GET['List_id'];
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

    <div class="all-task">
        <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add Task</a>


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

                    //Write the query to display task by list selected
                    $sql = "SELECT * FROM tbl_tasks WHERE List_id =$list_id_url ";

                    //Execute query
                    $res = mysqli_query($conn, $sql);

                    //Check if Query executed successfully
                    if($res==true)
                    {
                        //Display tasks based on lists
                        //Count the rows
                        $count_rows = mysqli_num_rows($res);

                        if($count_rows>0)
                        {
                            //There are tasks on the list
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];

                                ?>
                                <tr>
                                    <td>1. </td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline ?></td>
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
                            //No tasks on this list
                            ?>
                                <tr>
                                    <td colspan="5"> No Task Added on this List.</td>
                                </tr>



                            <?php
                        }
                    }
                ?>
            
        </table>

    </div>

    </div>
    
</body>

</html>