
<?php

if(isset($_GET['submit'])){
	$selected_month=$_GET['Month'];
	$selected_date = $_GET['Date'];  
	$selected_year = $_GET['Year'];  
	$selected_class = $_GET['Class'];  
	//echo "You have selected :" .$selected_date."<br>";
	//echo "You have selected :" .$selected_month."<br>";
}


$db=new mysqli('localhost','root','','student');
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: ";
}



$str=strtolower($selected_month);
//echo $str."<br>";
$t_name="attendance_sheet_".$str;
$date="date_".$selected_date;
//echo $t_name.$date."<br>";
$n=sprintf("SELECT Students FROM %s",$t_name);
//echo $n."<br>";

$stu_array1=array();
if(!empty($_POST)){
	if($students=$db->query($n)){
		if($students->num_rows){
			while($row=$students->fetch_object()){
				$stu_array1[]=$row;
			}
			$students->free();
		}	
	} 


	$i1=0;
	foreach($stu_array1 as $s){
		$i1++;
		$value=$_POST["group".$i1];
		
		$name=$s->Students;
		//echo $name;
		//echo $value.$i1.'<br>';
		$n1=sprintf("UPDATE %s set $date='Abs' where Students='".$name."' ",$t_name);
		$n2=sprintf("UPDATE %s set $date='Pre' where Students='".$name."' ",$t_name);
		if($value==0){
			$db->query($n1);
		}else{
			$db->query($n2);
		}
		/*if($db->affected_rows){
			echo "Success!!!";
		} else{
			echo "Failiure???";
		}*/

	}
			
}			






$stu_array=array();
if($students1=$db->query($n)){
	if($students1->num_rows){
		while($row=$students1->fetch_object()){
			$stu_array[]=$row;	
		}
		$students1->free();
	}
} $i=0;
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Site</title>
</head>
<body>
	<style>
		body {
			background-image: url("employment.jpg");
			background-repeat: no-repeat;
		}
		table {
			font-family: arial;
			border-collapse: collapse;
			width: 100%;
			margin-left:auto; 
    		margin-right:auto; 
			margin-top: 80px;
		}

		td, th {
			border: 2px solid black;
			padding: 8px;
		}
		th {
			padding-top: 12px;
			padding-bottom: 12px;
			background-color: rgb(60,60,60);
			color: white;
		}

		td{
			color: white;
		}
		

		tr:hover {background-color: SlateBlue;}

		#submit {
		color: black;
		position: relative;
		font-size: 25px;
		font-weight: bold;
		font-family: 'Times New Roman';
		background-origin: border-box;
		left: 450px; width: 200px; position: absolute; top: 500px;
		}

		.date{
			border-style: solid;
			border-width: 5px;
			background-color: lightgrey;
			margin-right: 12cm;
			margin-left: 12cm; 
			text-align: center;
			font-size: 200%;
			font-weight: bold;
			font-family: 'Times New Roman';
			color: black;
		}

		h1{
			text-align: center;
			font-size: 225%;
			font-weight: bold;
			font-family: 'Times New Roman';
			color: rgba(255, 99, 91);
		}

	</style>
	<h1>Manage Student Attendance</h1>
	<?php
		echo "<h2 class='date'>".$selected_date." ".$selected_month."   ".$selected_year."<br>".$selected_class."</h2>";
		if(!count($stu_array)){
			echo "No records";
		}else{

		?>
	<table>
		<thead>
			<tr>
				<th align="left">Students</th>
				<th colspan="2" align="center">Status</th>
				
			</tr>
		</thead>
		<tbody>
		<form action="" method="post">
		<?php
			foreach($stu_array as $s){
				$i++;
		?>
			<tr>
				<td><?php echo $s->Students;?></td>
				<td><input type="radio" name="<?php echo "group".$i;?>"  value="1" >Present</td>
				<td><input type="radio" name="<?php echo "group".$i;?>" value="0" >Absent</td>
			</tr>
		<?php
		}
		?>
		
		
		</tbody>
	</table>
	<input type="submit" value="Submit" id="submit">
	</form>
	
	
	
	<?php
		}
	?>
	
	
</body>
</html>

