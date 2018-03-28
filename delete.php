<?php
include 'config/database.php';
 
try {
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Task ID not found.');
    $query = "DELETE FROM tasks WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete task.');
    }
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>