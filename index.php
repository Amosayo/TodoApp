
<?php

    require_once ("../week3/Includes/operation.inc.php");
?>

<?php
    include_once 'header.php';  
?> 


<!--------Edit data------>
        <?php
          if(isset($_GET['edit'])){
            $todo_id = $_GET['edit'];
            $update = true;
            $sql = "SELECT * FROM todo_task WHERE todo_id = ' ".$todo_id. "'";
            $result = mysqli_query($GLOBALS['conn'], $sql);
            while($row = mysqli_fetch_assoc($result)){
              $todo_id = $row['todo_id'];
              $todo_title = $row['todo_title'];
              $todo_date = $row['todo_date'];
              $todo_decription = $row['todo_decription'];
            }
          } 
        ?>
        
<!-----Todo Selection ------->
    <div class="container-fluid">
    <div class="container">
        <div class="row p-3">
  <div class="col-sm-3">
   
  </div>

  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center"> Todo Application </h5>
          <?php

          ?>
          <?php
                updateRecords();
          ?>
        <form action= " " method="POST">
        
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label"> </label>
          <input type="hidden" class="form-control" id="exampleFormControlInput1" value="<?php echo $todo_id; ?>" name ="taskid" placeholder="Task ID">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Task Title</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $todo_title; ?>" name ="tasktitle" placeholder="Enter your task title">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Date</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo $todo_date; ?>" name ="date" placeholder="">
        </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Task Description</label>
      <input type="text" class="form-control" value="<?php echo $todo_decription; ?>" name="Taskdescription" id="exampleFormControlTextarea1" rows="3"></input>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
    <div id="taskbtn">
      <!------condition for the button that we show of the page------>
      <?php if ($update == true): ?>
      <button type="submit" btnid= "btn-update" name="update" class="btn btn-warning">Update</button>
      <?php else: ?>
    <button type="submit" btnid= "btn-createtask" name="create" class="btn btn-info">Create Task</button>
    <button type="submit" btnid= "btn-addtask" name="read" class="btn btn-info">Add Task</button>
        <?php endif ?>
    </div>
    </div>
    </form>
        
      </div>
    </div>
  </div>

  <div class="col-sm-3">
   
  </div>
</div>
    </div>
    </div>

    <!-------Display------>
    <div class="container-fluid">
      <div class="container">
      <table class="table mb-3 mt-3">
  <thead class="table-primary">
    <tr>
      <th scope="col">Task ID</th>
      <th scope="col">Task Title</th>
      <th scope="col">Date</th>
      <th scope="col">Task Description</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>

    </tr>
  </thead>
  <tbody class="table-dark" id="tbody">

      <?php
          if(isset($_POST['read'])){
            
            $result = getData();
            if($result){
              while($row = mysqli_fetch_array($result)){?>
                
               <tr>
                  <td><?php echo $row['todo_id']; ?></td>
                  <td><?php echo $row['todo_title']; ?></td>
                  <td><?php echo $row['todo_date']; ?></td>
                  <td><?php echo $row['todo_decription']; ?></td>
                  <td><a href="index.php?edit=<?php echo $row['todo_id'];?>" type="submit" name="edit" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                  <td><a href="index.php?delete=<?php echo $row['todo_id'];?>" type="submit" name="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
               </tr> 
                
                <?php
              }
            }
          }
      ?>

      <?php
              if(isset($_GET['delete'])){
                $todo_id = $_GET['delete'];
                $sql = "DELETE FROM todo_task WHERE todo_id = $todo_id";
                $result = mysqli_query($GLOBALS['conn'], $sql);
                
              }
      ?>

  </tbody>
</table>
      </div>
    </div>

    
    <?php
    include_once 'footer.php';

    ?>
    