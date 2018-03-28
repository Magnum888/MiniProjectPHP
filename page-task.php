<?php
$page_title="Task";
$require_login=true;
include_once "login_checker.php"; 
include_once "header.php";
include 'config/database.php';
?>
         
<?php
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    try {
        $query = "SELECT id, name, email, description, image, user_id, done FROM tasks WHERE id = ? LIMIT 0,1";
        $stmt = $con->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);  
        // values to fill up our form
        $name = $row['name'];
        $email = $row['email'];
        $description = $row['description'];
        $image = $row['image'];
        $done = $row['done'];
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
?>
 
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Image</td>
                <td><?php echo $image ? "<img class='img-responsive' src='{$image}' alt='image'>" : "No image found."; ?> </td>
            </tr>
            <tr>
                <td>Done</td>
                <?php if($done !=0){?>
                <td class='green'>&#10004;</td>
                <?php } else{?>
                <td class='red'>&#10008;</td>
                <?php } ?>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Back to read tasks</a>
                </td>
            </tr>
        </table>
 
<?php include_once "footer.php"; ?>