<?php

    //defining namespace, it should bt the top of a php file 
    namespace mrg;
    

    //include headers
    require_once('header.php');

    //checking  the connection by including the file 
    require_once('connect.php');

    //decoding and reading the contents of a file into the string
    $data = json_decode(file_get_contents("php://input"));

    //getting the value of the option for the different function 
    $option = $data->option;

    //converting the special characters into the string
    $id = mysqli_real_escape_string($conn,$data->id);
    $firstname = mysqli_real_escape_string($conn,$data->firstname);
    $lastname = mysqli_real_escape_string($conn,$data->lastname);
    $email= mysqli_real_escape_string($conn,$data->email);
    
    //defining a class
    class merged
    {
        //defining a function for the insert operation
        public function insert($id,$firstname,$lastname,$email,$conn)
        {
            //executing the insert statement repeatedly
            $sql = $conn->prepare("INSERT INTO detail (id,firstname,lastname,email) VALUES (?,?,?,?)");

            //binding the variables to a prepared statement as a parameter
            $sql->bind_param("isss",$id,$firstname,$lastname,$email);
            
            $sql->execute();
            $conn->close();
        }

        //function for the update operation    
        public function update($firstname,$lastname,$email,$id,$conn)
        {
            $sql = $conn->prepare("UPDATE detail SET firstname= ?,lastname= ?,email = ? WHERE id= ?");
            $sql->bind_param("sssi",$firstname,$lastname,$email,$id);
            $sql->execute();
            $conn->close();
        }

        //function for the delete operation
        public function delete($id,$conn)
        {
            $sql = $conn->prepare(" DELETE FROM students.detail WHERE detail.id =(?)");
            $sql->bind_param("i",$id);
            $sql->execute();
            $conn->close();
        }

        //function for fetching and displaying data on the app
        public function fetching($conn)
        {
            //performing the selecr * query against the database
            $qry = mysqli_query($conn,"select * from detail");

            //fetching the result row
            while ($row = mysqli_fetch_array($qry)) 
            {
                //storing the data in an array
                $obtaindata[]=$row;
            }

            //returning thee fetched data
            return $obtaindata;
        }

    }

    //object & function calls
    $obj=new merged();

    //creating the object to display the data
    $display=$obj->fetching($conn);

    //echoing or printing the data stored in the display variable
    echo json_encode($display);

    switch ($option) 
    {
        case 1:
            mrg/merged::insert($data->id,$data->firstname,$data->lastname,$data->email,$conn);
            //$obj->insert($data->id,$data->firstname,$data->lastname,$data->email,$conn);
        break;

        case 2:
            merg/merged::update($data->firstname,$data->lastname,$data->email,$data->id,$conn);
            //$obj->update($data->firstname,$data->lastname,$data->email,$data->id,$conn);
        break;

        case 3:
            merg/merged::delete($data->id,$conn);
            //$obj->delete($data->id,$conn);
        break;     
    }        
?>