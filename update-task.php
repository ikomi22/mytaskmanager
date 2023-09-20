<?php
include('constants.php');

//Check if task id is in url
if(isset($_GET['task_id']))
{
    //Get the values from database
    $task_id = $_GET['task_id'];

    //Connect  the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
    //Select db
    $db_select = mysqli_select_db($conn, DB_NAME);

    //Write the query to get tasks from dtatbase
    $sql = "SELECT * FROM tbl_tasks WHERE task_id = $task_id";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check whether query executed successfully or not
    if($res==true)
    {
        //Query executed successfully
        $row = mysqli_fetch_assoc($res);

        //Get the individual value
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['List_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    }
}
else
{
    //Redirect to homepage
    header('location:'.SITEURL);
}
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

    <p>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    </p>
    <h3>Update Task Page</h3>

    <p>
        <?php
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
                <td>Task Name:</td>
                <td><input type="text" name="task_name" value="<?php echo $task_name ?>" required="required"></td>
            </tr>

            <tr>
                <td>Task Description:</td>
                <td>
                    <textarea name="task_description" id="" cols="30" rows="10">
                        <?php echo $task_description ?>

                    </textarea>
                </td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td>
                    <select name="List_id">

                     <?php 
                        //Connect  the database
                        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
                        //Select db
                        $db_select = mysqli_select_db($conn2, DB_NAME);

                        //Write the query to get list from dtatbase
                        $sql2 = "SELECT * FROM tbl_lists";

                        //Execute query
                        $res2 = mysqli_query($conn2, $sql2);

                        //Check whether query executed successfully or not
                        if($res2==true)
                        {
                            //Display the list
                            //Count Rows
                            $count_rows2 = mysqli_num_rows($res2);

                            //Check whether list is added or not
                            if($count_rows2>0)
                            {
                                //List added
                                while($row2 = mysqli_fetch_assoc($res2))
                                {
                                    //Get individual values
                                    $list_id2 = $row2['List_id'];
                                    $list_name = $row2['list_name'];
                                    ?>
                                        <option <?php if($list_id2==$list_id){echo "selected ='selected'";} ?> value="<?php echo $list_id2; ?>"><?php echo $list_name; ?></option>
                                    <?php
                                }
                                
                            }
                            else
                            {
                                //None list added
                                ?>
                                <option <?php if($list_id = 0){echo "selected = 'selected'";} ?> value="0">None</option>
                                <?php
                            }
                        }
                        
                     ?>



                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Priority:</td>
                <td>
                <select name="priority">
                        <option <?php if($priority=="High"){echo "selected='selected'";} ?> value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                        <option <?php if($priority=="low"){echo "selected='selected'";} ?> value="low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline</td>
                <td><input type="date" name="deadline" value="<?php echo $deadline ?>" id=""></td>
            </tr>

            <tr>
                <td><input class="btn-primary btn-lg" type="submit" name="submit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php

    //Check if the submit button works
    if(isset($_POST['submit']))
    {
        //Get values from form
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['List_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline']; 
         
        // echo "CLICKED";
        //Connect  the database
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                            
        //Select db
        $db_select3 = mysqli_select_db($conn3, DB_NAME);

        //Write the query to get update task
        $sql3 = "UPDATE tbl_tasks SET
        task_name = '$task_name',
        task_description = '$task_description',
        List_id = '$list_id',
        priority = '$priority',
        deadline = '$deadline'
        WHERE 
        task_id = $task_id
        
        ";

        //Execute query
        $res3 = mysqli_query($conn3, $sql3);

        //Check whether query executed successfully or not
        if($res3==true)
        {
            //Query executed successfully and task updated 
            $_SESSION['update'] = "Task Updated Successfully.";

            //Redirect to homepage
            header('location:'.SITEURL);
        }
        else
        {
            //Failed to update task
            $_SESSION['update_fail'] = "Failed to update task";

            //Redirect to homepage
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
        }


    }
?>



