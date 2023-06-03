<?php include("db.php"); ?>
<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
    <!-- MENSAJES EMERGENTES -->
    <?php if(isset($_SESSION['message'])) {?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>     
      <?php session_unset();} ?>
      <!-- Form de tareas -->
      <div class="card card-body">
        <form action="save.php" method="POST">
          <div class="form-group">
            <input type="text" name="title"  class="form-control" placeholder="Task Title" autofocus>            
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Task Description"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block"  value="Save Task">
        </form>
        <a class="pt-4 text-center" href="recover.php">Recupera tareas eliminadas aquí.</a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="table-container limit-size">
        <table class="table table-bordered">
          <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
          </thead>
  
          <tbody>
            <?php
            $query = "SELECT * FROM task WHERE deleted_at IS NULL";
            $result_task = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result_task)){ ?>
            <tr>
              <td style="width: 200px;"><?php echo $row['title']; ?></td>
              <td style="width: 200px;"><?php echo $row['description']; ?></td>
              <td style="width: 110px;"><?php echo $row['created_at']; ?></td>
              <td class="d-flex justify-content-center">
                <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                  <i class="fa-solid fa-marker"></i>
                </a>
                &nbsp;
                <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </td>     
            </tr>
            <?php } ?>                  
          </tbody>  
        </table>
      </div>
    </div>
  </div>
</main>
<?php include('includes/footer.php'); ?>