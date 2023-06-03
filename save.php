<?php
include('db.php');

if(isset($_POST['save_task'])) {
    // variables creadas por los datos del form
    $title=$_POST['title']; 
    $description=$_POST['description'];
    $query = "INSERT INTO task(title, description)  VALUES('$title', '$description')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query failed");
        $_SESSION['message'] = 'La tarea no ha podido ser guardada';
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    }
    $_SESSION['message'] = 'Tarea guardada exitosamente';
    $_SESSION['message_type'] = 'success';
}

header("Location: index.php");
