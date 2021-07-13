
<?php

    session_start();

    //initialize varaiable.
    $update = false;
    $todo_id = 0;
    $todo_title = "";
    $todo_date = "";
    $todo_decription = "";
    
    

    require_once ("dbh.inc.php");
    $conn = createdb();

    if(isset($_POST['create'])){
        createData();
    }

    //function to createData
        function createData(){
            $taskTitle = textBoxValue("tasktitle");
            $Date = textBoxValue("date");
            $TaskDescription = textBoxValue("Taskdescription");

            //Check if there is value inside the textbox

            if($taskTitle && $Date && $TaskDescription){
                $sql = "INSERT INTO todo_task (todo_title, todo_date, todo_decription) VALUES ('$taskTitle', '$Date', '$TaskDescription')";
                if(mysqli_query($GLOBALS['conn'], $sql)){
                    TextNote("success", "Record Successfully Inserted......!");
                }else{
                    echo "Error";
                }
            }else{
                    TextNote("error", "Please Enter Values In Your TextBox");
            }
        }

        function textBoxValue($value){

            $textBox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
                if(empty($textBox)){
                    return false;
                }else{
                    return $textBox;
                }
        }

        //function for message
        function TextNote($classname, $msg){
            $element = "<h6 class='$classname'> $msg</h6>";
            echo $element;
        }

        // Function to get data from mysqli database
        function getData(){
            $sql = "SELECT * FROM todo_task";
            $result = mysqli_query($GLOBALS['conn'], $sql);
            if(mysqli_num_rows($result) > 0){
                return $result;
            }

        }

        

        //function to update records. 
        function updateRecords(){
            if(isset($_POST['update'])){
            $todo_id = $_POST['taskid'];
            $todo_title = $_POST['tasktitle'];
            $todo_date = $_POST['date'];
            $todo_decription = $_POST['Taskdescription'];
            $sql = "UPDATE todo_task SET todo_title = '$todo_title', todo_date = '$todo_date', todo_decription = '$todo_decription' WHERE todo_id = $todo_id ";
            $edit = mysqli_query($GLOBALS['conn'], $sql);
            if($edit){
                mysqli_close($GLOBALS['conn']);
                header("location:index.php");
                exit();
            }else{
                echo mysqli_error($GLOBALS['conn']);
            }     
        }
    }
        