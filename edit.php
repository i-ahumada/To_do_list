<?php
    include('db.php');
    include('includes/header.php');
    $title = '';
    $description = '';
    if(isset($_GET['id'])) { // Si recibo id por GET consulta
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id=$id"; // Consulta
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)) { // Ordeno los datos de la fila (id, title, description)   
            $row = mysqli_fetch_array($result);
            $title = $row['title'];
            $description = $row['description'];
        }
    }

    if(isset($_POST['update'])) {
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = "UPDATE task set title='$title', description='$description' WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query failed");
            $_SESSION['message'] = 'La tarea no ha podido ser actualizada';
            $_SESSION['message_type'] = 'danger';
            header("Location: index.php");
        }
        $_SESSION['message'] = 'Tarea actualizada    exitosamente';
        $_SESSION['message_type'] = 'success';

        header("Location: index.php");
    }
?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $_GET['id']?>" method="post">
                    <div class="form-group">
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $title?>">
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control" placeholder="Task Description"><?php echo $description?></textarea>
                    </div>
                    <button class="btn btn-success" type="submit" name="update">Update task</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>