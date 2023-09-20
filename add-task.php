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
    <a class="btn-secondary" href="<?php echo SITEURL;?>">Home</a>
    <h3>Add Task Page</h3>

    <p>
        <?php 
        if(isset($_SESSION['add_fail']))
        {
            echo $_SESSION['add_fail'];
            unset($_SESSION['add_fail']);
        }
        
        ?>
    </p>

    <form method="POST" action="">
        <table class="tbl-half">
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" placeholder="Type your task name" required = "required"></td>
            </tr>

            <tr>
                <td>Task Description:</td>
                <td><textarea name="task_description" placeholder="Type Task Description" id="" cols="30" rows="10"></textarea></td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td>
                    <select name="List_id" id="">
                    <?php 
                        //Connect  the database
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
                        //Select db
                        $db_select = mysqli_select_db($conn, DB_NAME);

                        //Write the query to get list from dtatbase
                        $sql = "SELECT * FROM tbl_lists";

                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        //Check whether query executed successfully or not
                        if($res==true)
                        {
                            //Create variable to count rows
                            $count_rows = mysqli_num_rows($res);

                            //If there's data in database then display all in dropdowns else display none as option
                            if($count_rows>0)
                            {
                                //Display all lists in dropdowns from database
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $List_id = $row['List_id'];
                                    $list_name = $row['list_name'];
                                    ?>
                                        <option value="<?php echo $List_id  ?>"><?php echo $list_name ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //Display nothng as option
                                ?>
                                <option value="0">None</option>
                                <?php
                            }
                        }
                            
                        
                        ?>
                        
                        
                    </select>

                </td>
            </tr>

            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority" id="">
                        


                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline"></td>
            </tr>

            <tr>
                <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE"></td>
            </tr>
        </table>

    </form>


    </div> 
</body>
        
</html>

<?php 
//Check if save button works
                        if(isset($_POST['submit']))
                        {
                            // echo "Button clicked";
                            //Get all values from form
                            $task_name = $_POST['task_name'];
                            $task_description = $_POST['task_description'];
                            $List_id = $_POST['List_id'];
                            $priority = $_POST['priority'];
                            $deadline = $_POST['deadline'];

                            //Connect  the database 2
                        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));
                        
                        //Select db
                        $db_select = mysqli_select_db($conn2, DB_NAME);

                        //Write the query to get list from dtatbase
                        $sql2 = "INSERT INTO tbl_tasks SET
                        task_name = '$task_name',
                        task_description = '$task_description',
                        List_id = $List_id,
                        priority = '$priority',
                        deadline = '$deadline'
                        ";

                        //Execute Query
                        $res2 = mysqli_query($conn2, $sql2);

                        //Check if query executed successfully or not
                        if($res2==true)
                        {
                            //Query executed and task inserted successfully
                            $_SESSION['add'] = "Task added successfully.";

                            //Redirect to Homepage
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            //Failed to add task
                            $_SESSION['add_fail'] = "Failed to add task";

                            //Redirect to add task page
                            header('location:'.SITEURL.'add-task.php');
                        }

                        
                        }

?>

















