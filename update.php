<?php
$page_title="Update";
include_once "header.php";
include 'config/database.php';
?>

<?php if(!isset($_SESSION['admin']) && $_SESSION['admin']==admin): ?>
<div class='alert alert-danger'>This page to you close</div>
<?php else: ?>

<?php
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
        $user_id = $row['user_id'];
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }

    if($_POST){       
        try{
            $query = "UPDATE tasks SET name=:name, email=:email, description=:description, image=:image, done=:done, user_id=:user_id WHERE id=:id";
            // prepare query for excecution
            $stmt = $con->prepare($query);
            // posted values
            $name=htmlspecialchars(strip_tags($_POST['name']));
            $email=htmlspecialchars(strip_tags($_POST['email']));
            $description=htmlspecialchars(strip_tags($_POST['description']));
            $done = isset($_POST['done']) ? 1 : 0;
            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':done', $done);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':id', $id);           
            // Execute the query
            if($stmt->execute()){
                echo "<div class='alert alert-success'>Record was updated.</div>";
            }else{
                echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
            }
        }
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }
    ?>
 
    <img class="img-responsive" src="<?php echo $image ?>" alt="image">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" enctype="multipart/form-data" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type='email' name='email' value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
            </tr>
            <tr>
                <td>Done</td>
                <?php if($done != 0): ?>
                <td><input type='checkbox' checked name='done' value="<?php echo htmlspecialchars($done, ENT_QUOTES); ?>" class='form-control' /></td>
                <?php else: ?>
                <td><input type='checkbox' name='done' value="<?php echo htmlspecialchars($done, ENT_QUOTES); ?>" class='form-control' /></td>
                <?php endif ?>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save Changes' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read tasks</a>
                </td>
            </tr>
        </table>
    </form>
         
    <?php include_once "footer.php"; ?>
    
<?php endif ?> 