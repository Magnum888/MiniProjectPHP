<?php
$page_title="Task List";
$require_login=true;
include_once "login_checker.php";
include_once "config/core.php";
include_once "header.php";
include 'config/database.php';
?>
     

    <?php $action = isset($_GET['action']) ? $_GET['action'] : "";?>
    <!-- if it was redirected from delete.php -->
    <?php if($action=='deleted'): ?>
        <div class='alert alert-success'>Record was deleted.</div>
    <?php endif ?>
    <!-- if login was successful -->
    <?php if($action=='login_success'): ?>
        <div class='alert alert-info'>
            <strong>&#9745; User: <?php echo $_SESSION['name'] ?>. You can to create a task</strong>
        </div>
     <!-- if user is already logged in, shown when user tries to access the login page -->
    <?php elseif($action=='already_logged_in'): ?>
        <div class='alert alert-info'>
            <strong>You are already logged in.</strong>
        </div>
    <?php endif ?>
    <?php 
    $query = "SELECT id, name, email, description, image, user_id, done FROM tasks ORDER BY id DESC";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    ?>
    
    <p class='create-task'>
        <a href='create.php' class='btn btn-primary m-b-1em'>
            Create New Task
        </a>
    </p>
    
     
    <?php if($num>0): ?>
        <table id='table' class='table table-hover table-responsive table-bordered'>
        <thead class='head-table'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
                <th>Done</th>
            </tr>
        </thead>
        <tbody class='searchable'>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <?php extract($row); ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $description ?></td>
                <td>
                    <img class='img-responsive' src='<?php echo $image ?>' alt='image'>
                </td>
                <td>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="admin"):?>
                        <a href='page-task.php?id=<?php echo $id ?>'  class='btn btn-info m-r-1em'>Read</a>
                        <a href='update.php?id=<?php echo $id ?>' class='btn btn-primary m-r-1em'>Edit</a>
                        <a href='#' onclick='delete_user(<?php echo $id ?>)' class='btn btn-danger'>Delete</a>
                    <?php else: ?>
                        <a href='page-task.php?id=<?php echo $id ?>'  class='btn btn-info m-r-1em'>Read</a> 
                    <?php endif ?>
                </td>
                <?php if($done !=0): ?>
                    <td class='green'>&#10004;</td>
                <?php else: ?>
                    <td class='red'>&#10008;</td>
                <?php endif ?>
            </tr>
        <?php endwhile ?>
        </tbody>
        </table>
    <?php else: ?>
        <div class='alert alert-danger'>No tasks found.</div>
    <?php endif ?>
    <?php $page_url="index.php?"; ?>
         
<?php include_once "footer.php"; ?>