<?php
//Include Constants.php
include('constants.php');
echo "DeleteListPAge";

//Check if the list_id is assigned or not
if(isset($_GET['List_id']))
{
    //DELETE LIST FROM DATABASE

    //Get the list_id value from URL or Getmethod
    $List_id = $_GET['List_id']; 


//Connect  the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($mysqli->error));

    //Select db
    $db_select = mysqli_select_db($conn, DB_NAME);

    //Write the query to delete list from dtatbase
    $sql = "DELETE FROM tbl_lists WHERE List_id = $List_id ";

    //Execute the query
    $res = mysqli_query($conn, $sql);
    
    //Check whether query executed successfully or not
    if($res==true)
    {
        //Query executed successfully means list has been deleted
        $_SESSION['delete'] = "List Deleted Successfully";
        //Redirect to manage list page
        header('location:'.SITEURL.'manage-lists.php');
    }
    else
    {
        //Failed to delete list
        $_SESSION['delete_fail'] = "Failed to delete list";
        header('location:'.SITEURL.'manage-lists.php');

    }
}
else
{
    //Regirect to manage list page
    header('location:'.SITEURL.'manage-lists.php');
}





            
?>