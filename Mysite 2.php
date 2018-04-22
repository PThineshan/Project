<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    $database=new mysqli('localhost','root','','student');
       if(!empty($_POST)){
        $name=$_POST["name"];
        $id=$_POST["id"];
        $dob=$_POST["dob"];
        $mobile_num=$_POST["mobile_num"];
        $gender=$_POST["gender"];
        $address=$_POST["address"];
       } 
        
       $database->query("insert into student_details (ID,Name,Address,DOB,
       Gender,Mobile_Number) values ('{$id}','{$name}','{$address}','{$dob}','{$gender}',
       '{$mobile_num}')");

       header('Location: Mysite 5.html');

       
    ?>
</body>
</html>