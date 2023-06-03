<?php
    include('db.php');

    if(isset($_GET['id'])) { // Si recibo id por GET consulta
        $id = $_GET['id'];
        $query_timestamp = "SELECT CURRENT_TIMESTAMP()";
        $result_timestamp = mysqli_query($conn, $query_timestamp);
        $timestamp = mysqli_fetch_array($result_timestamp)[0];
        $query = "UPDATE task set deleted_at='$timestamp' WHERE id=$id"; // Consulta
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query failed");
            $_SESSION['message'] = 'La tarea no ha podido ser eliminada';
            $_SESSION['message_type'] = 'danger';
            header("Location: index.php");
        }
        $_SESSION['message'] = 'Tarea eliminada exitosamente';
        $_SESSION['message_type'] = 'success';
    }
    header("Location: index.php");
