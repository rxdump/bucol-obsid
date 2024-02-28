<?php session_start();
include ("config.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>

  <style>
    body{
      background-image: linear-gradient(to right, black, white);
      margin: 0;
      padding: 0;
    }
  </style>
  <body>

 <div class="container-fluid mt-4">
 <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Tasks</h5>

              <a href="create_task.php" style="float: right;" class="btn btn-primary">Add Task</a>
              <form action="process.php">
              <a type="button" style="float: right; margin-right: 15px" class="btn btn-primary">Sort</a>
              </form>
              <!-- Table with stripped rows -->
  
  <!-- E line ug tarong ang row parehas sa pag linya sa pag kuha sa data sa database -->

              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="text-align:center;">Priority</th>
                    <th scope="col">Due Date</th>
                  </tr>
                </thead>
                <tbody>

  <!-- Kuhaon ang data gikan sa database under sa tasks column -->

                <?php
                $query = "SELECT * FROM `tasks`";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                foreach($query_run as $row)
                {
                ?>
  
  <!-- E han ay kada row ang data same sa pag set sa th -->

                    <tr>
                
                <td><?= $row['title']; ?></td>
                <td style="word-wrap: break-word; max-width: 200px; text-align: justify;"><?= $row['description']; ?></td>
                <td style="text-align: center;"><?= $row['priority']; ?></td>
                <td><?= $row['due_date']; ?></td>

                <td class="text-center">
                
                <a type="button" style="margin-bottom: 10px; margin-top:10px;" class="btn btn-info" href="edit_task.php?id=<?=$row['id'];?>">Update</a>

                <a type="button" style="position: absolute; margin-left: 10px; margin-top:10px; height: 86px; padding-top: 27px; text-align:center;" class="btn btn-success" href="view_task.php?id=<?=$row['id'];?>">View</a>

                <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <a type="button"  class="btn btn-danger" href="delete_task.php?id=<?=$row['id'];?>">Delete</a>
                </form>
                
               </td>
                    </tr>

                    <?php
                } 
                } else
                {
                ?>
                <tr>
                <td colspan="6">No Task Found!</td>
                </tr>
                <?php
                }
                ?>

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
 </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


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