<?php session_start();
include ("config.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

    <style>

    </style>
<body>

<h1 class="text-center" style="margin-top: 150px">Delete Task</h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">

        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $tasks = "SELECT * FROM `tasks` WHERE `id` = '$id'";
            $tasks_run = mysqli_query($con, $tasks);

            if(mysqli_num_rows($tasks_run) > 0)
            {
                foreach($tasks_run as $tasks)
                {
                ?>

            <form action="process.php" method="POST">

            <input type="hidden" name="id" value="<?=$tasks['id'];?>">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5 style="text-align: center; background-color: red; border-top-right-radius: 100px; border-top-left-radius: 100px; height: 40px; padding:7px;">Are you sure you want to delete this Task?</h5>
                        <label for="title" class="form-label">Title</label>
                        <h5 style="border-color:red;" type="none" class="form-control" id="title" name="delete_title"><?=$tasks['title'];?></h5>
                        <h5 style="text-align: center; background-color: red; border-bottom-right-radius: 100px; border-bottom-left-radius: 100px; height: 40px; padding:7px; margin-top: 15px;"></h5>
                    </div>

                    <div class="col-md-12 mb-3 text-center">
                        <a type="button" style="float: right; margin-left: 10px;" class="btn btn-success" href="index.php">Cancel</a>
                        <button type="submit" class="btn btn-danger" style="float: right;" name="delete">Delete Task</button>                       
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
                }
            }
            else
            {
                ?>
                <h4>No Record Found!</h4>
                <?php
            }
        }
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '' )
{
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
        });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>
</body>
</html>
