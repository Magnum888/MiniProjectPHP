<?php 
include_once "header.php";
include 'config/database.php';
?>
      
<?php
if($_POST){
    try{
        $query = "INSERT INTO tasks SET name=:name, email=:email, description=:description, image=:image, user_id=:user_id, done=:done";
        $stmt = $con->prepare($query);
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $email=htmlspecialchars(strip_tags($_POST['email']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $user_id=rand(1000, 99999);
        $done=0;
        if($_FILES['image']['size'] > (2 * 1024 * 1024)) {echo "<div class='alert alert-success'>The file size should not exceed 2Mb.</div>";}
        $imageinfo = getimagesize($_FILES['image']['tmp_name']);
        $arr = array('image/jpeg','image/gif','image/png');
        if(!in_array($imageinfo['mime'],$arr)){echo ('The picture must be a format JPG, GIF or PNG');} 
        else {
            $upload_dir = './images/';
            $image = $upload_dir.date('YmdHis').basename($_FILES['image']['name']);
            include('resize.php');
            $res_image = new SimpleImage();
            $res_image->load($_FILES['image']['tmp_name']);
            $res_image->resize(320, 240);
            $res_image->save($image);
            $image = stripslashes(strip_tags(trim($image)));
        }
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':done', $done);
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

    <form id="task" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type='email' name='email' class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Image</td>
                <td><input type='file' id="save-img" name='image' class='form-control'></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read tasks</a>
                    <button type="button" class="btn btn-info modall" data-toggle="modal" data-target="#showTask">Show Task</button>
                </td>
            </tr>
        </table>
    </form>
     <!-- Modal -->
    <div class="modal fade" id="showTask" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Task</h4>
                </div>
                <div class="modal-body">
                    <div><strong>User:</strong><p data-input='name'></p></div>
                    <div><strong>Email: </strong><p data-input='email'></p></div>
                    <div><strong>Description: </strong></div>
                    <p data-input='description'></p>
                    <div class="modal-show-img"></div>
                </div>
            </div>
        </div>
    </div>
          
    <?php include_once "footer.php"; ?>
    <script src="js/scriptCreate.js" type='text/javascript'></script> 
    <script src="js/showImg.js" type='text/javascript'></script> 