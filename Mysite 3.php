<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    $database=new mysqli('localhost','root','','student');
      // if(!empty($_POST)){
        $name=$_POST["name"];
        $id=$_POST["id"];
        
     //  } 
        
    $result=$database->query("select * from student_details where ID='{$id}' or Name='{$name}'");
    $row=$result->fetch_object();
    $chkid=$row->ID;
    $chkname=$row->Name;
    $chkaddress=$row->Address;
    $chkdob=$row->DOB;
    $chkmobile=$row->Mobile_Number;
    $chkgender=$row->Gender;
    echo $chkid."<br>";
    echo $chkname."<br>";
    echo $chkaddress."<br>";
    echo $chkdob."<br>";
    echo $chkmobile."<br>";
    echo $chkgender."<br>";
    //echo $result;
       //$database->query("select * from student_details where Name=$name");
    ?>
</body>
</html>