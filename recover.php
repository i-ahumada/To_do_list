<?php
    include('db.php');
    include('includes/header.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "UPDATE task set deleted_at=NULL WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query failed");
            $_SESSION['message'] = 'La tarea no ha podido ser reinstaurada';
            $_SESSION['message_type'] = 'danger';
            header("Location: index.php");
        }
        $_SESSION['message'] = 'Tarea/s recuperada exitosamente';
        $_SESSION['message_type'] = 'success';
    }

    $order = "deleted_at";
    $direction = 'DESC';
    if(isset($_GET['order'])) {

    }
?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 p-4">
            <div class="table-container limit-size">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Deleted at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $query = "SELECT * FROM task  WHERE deleted_at IS NOT NULL ORDER BY $order $direction";
                                $result = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($result)){ ?>
                            <td style="width: 200px;"><?php echo $row['title']; ?></td>
                            <td style="width: 200px;"><?php echo $row['description']; ?></td>
                            <td style="width: 110px;"><?php echo $row['created_at']; ?></td>
                            <td style="width: 110px;"><?php echo $row['deleted_at']; ?></td>
                            <td class="d-flex justify-content-center">
                            <a href="recover.php?id=<?php echo $row['id']; ?>&sort_tag=<?php echo $order; ?>&sort_direction=<?php echo $direction; ?>" class="btn btn-info">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </a>   
                        </tr>
                        <?php } ?>                  
                    </tbody>  
                </table>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <a href="index.php" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?> 