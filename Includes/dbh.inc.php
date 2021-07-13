<?php 

    function createdb(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "todo";

        // create connection
        $conn = mysqli_connect($servername, $username, $password);
            //check connection
            if(!$conn){
                die("connection failed :" . mysqli_connect_error());
                exit();
            }
        

        //create database
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            if(mysqli_query($conn, $sql)){
                $conn = mysqli_connect($servername, $username, $password,$dbname);
                    $sql = "CREATE TABLE IF NOT EXISTS todo_task(
                        todo_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        todo_title VARCHAR(25) NOT NULL,
                        todo_date DATE,
                        todo_decription TEXT(200) NOT NULL
                    );
                    ";

                    if(mysqli_query($conn, $sql)){
                        return $conn;
                    }else{
                        echo "Table cannot be create : " . mysqli_connect_error($conn);
                    }

            }else{
                echo "Error why create database" . mysqli_connect_error($conn);
            }

    }



