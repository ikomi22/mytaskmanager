<?php
    include('constants.php');
    //Check Task_id in URL
    if(isset($_GET['task_id']))
    {
        //Delete task from database 

        //Get Task_ID
        $task_id = $_GET['task_id'];

        //ConnectDatabase
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));

        //Select db
        $db_select = mysqli_select_db($conn, DB_NAME);

        //SQL Query to delete task
        $sql = "DELETE FROM tbl_tasks WHERE task_id = $task_id";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //Check if query executed successfully or not
        if($res==true)
        {
            //Query executed successfully and Task deleted
            $_SESSION['delete'] = "Task deleted successfully";

            //Redirect to homepage
            header('location:'.SITEURL);
        }
        else
        {
            //Failed to delete task
            $_SESSION['delete_fail'] = "Failed to delete task";

            //Redirect to homepage
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
    
    
        
      
    
    

?>