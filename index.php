<?php
// set page title
$page_title="Tasks List";
$require_login=true;
include_once "login_checker.php";
include_once "config/core.php";
include_once "header.php";
include 'config/database.php';
?>
     
<?php
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    // if it was redirected from delete.php
    if($action=='deleted'){
        echo "<div class='alert alert-success'>Record was deleted.</div>";
    }
    // if login was successful
    if($action=='login_success'){
        echo "<div class='alert alert-info'>";
            echo "<strong>&#9745; User: " . $_SESSION['name'] . ". You can to create a task</strong>";
        echo "</div>";
    }
    // if user is already logged in, shown when user tries to access the login page
    else if($action=='already_logged_in'){
        echo "<div class='alert alert-info'>";
            echo "<strong>You are already logged in.</strong>";
        echo "</div>";
    }
    $query = "SELECT id, name, email, description, image, user_id, done FROM tasks ORDER BY id DESC LIMIT :from_record_num, :records_per_page";
    $stmt = $con->prepare($query);
    $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $num = $stmt->rowCount();

    // link to create record form
    echo "<p class='create-task'><a href='create.php' class='btn btn-primary m-b-1em'>Create New Task</a></p>";
    if($num>0){
        echo "<div class='container'>";
        // echo "<p1 class='create-task'>All Tasks</p1>";
        echo "<div class='input-group'>";
            echo "<span class='input-group-addon'>Filter</span>";
            echo "<input id='filter' type='text' class='form-control' placeholder='Type here...'>";
        echo "</div>";
        echo "<table id='table' class='table table-hover table-responsive table-bordered' data-toggle='table' data-search='true' data-filter-control='true' data-click-to-select='true' data-toolbar='#toolbar'>";
        echo "<thead class='head-table'>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th data-sortable='true'>Name</th>";
                echo "<th data-sortable='true'>Email</th>";
                echo "<th>Description</th>";
                echo "<th>Image</th>";
                echo "<th>Action</th>";
                echo "<th data-sortable='true'>Done</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody class='searchable'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$description}</td>";
                echo "<td><img class='img-responsive' src='{$image}' alt='image'></td>";
                echo "<td>";
                    echo "<a href='page-task.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
                    if(isset($_SESSION['admin']) && $_SESSION['admin']=="admin"){
                        echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
                        echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                    }
                echo "</td>";
                if($done !=0){
                    echo "<td class='green'>&#10004;</td>";
                }else{
                    echo "<td class='red'>&#10008;</td>";
                }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        $query = "SELECT COUNT(*) as total_rows FROM tasks";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_rows = $row['total_rows'];
    }
    else{
        echo "<div class='alert alert-danger'>No tasks found.</div>";
    }

    $page_url="index.php?";
    include_once "paging.php";
?>
         
<?php include_once "footer.php"; ?>