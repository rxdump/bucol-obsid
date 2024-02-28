<?php
session_start();    
include("config.php");

//For Creating A Task

if(isset($_POST["insert"])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due = $_POST['due'];
    
    if($title == ''){
        $_SESSION['status'] = "Title cannot be empty";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    }

    if($due == ''){
        $_SESSION['status'] = "Due date cannot be empty";
        $_SESSION['status_code'] = "error";
        header("Location: create_task.php");
        exit();
    }

    $query = "INSERT INTO `tasks`(`title`, `description`, `priority`, `due_date`) VALUES ('$title', '$description', '$priority', '$due')";

    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Added!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}


//For Updating A Task

if(isset($_POST["update"])){

    $id = $_POST['id'];
    $new_title = $_POST['new_title'];
    $new_description = $_POST['new_description'];
    $new_priority = $_POST['new_priority'];
    $new_due = $_POST['new_due'];

    if($new_title == ''){
        $_SESSION['status'] = "Title cannot be empty";
        $_SESSION['status_code'] = "error";
        header("Location: edit_task.php");
        exit();
    }

    if($new_due == ''){
        $_SESSION['status'] = "Due date cannot be empty";
        $_SESSION['status_code'] = "error";
        header("Location: edit_task.php");
        exit();
    }

    $query = "UPDATE `tasks` SET `title`='$new_title',`description`='$new_description',`priority`='$new_priority',`due_date`='$new_due' WHERE `id` = '$id'";

    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Updated Successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}

//For Deleting A Task

if(isset($_POST["delete"])){
    
    $id = $_POST['id'];

    $query = "DELETE FROM `tasks` WHERE `id` = '$id'";

    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Deleted Successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
        }

}

?>