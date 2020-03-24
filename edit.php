<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$first_name = mysqli_real_escape_string($mysqli, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($mysqli, $_POST['last_name']);
	$town_name = mysqli_real_escape_string($mysqli, $_POST['town_name']);
	$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);	
	
	// checking empty fields
	// checking empty fields
	if(empty($first_name) || empty($last_name) || empty($town_name) || empty($gender)) {
				
		if(empty($first_name)) {
			echo "<font color='red'>First name field is empty.</font><br/>";
		}
		
		if(empty($last_name)) {
			echo "<font color='red'>Last name field is empty.</font><br/>";
		}
		
		if(empty($town_name)) {
			echo "<font color='red'>Town name field is empty.</font><br/>";
		}

		if(empty($gender)) {
			echo "<font color='red'>Gender field is empty.</font><br/>";
		}
	}
			
	 else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE customer SET first_name='$first_name',last_name='$last_name',town_name='$town_name',gender='$gender' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>First Name</td>
				<td><input type="text" name="first_name" value="<?php echo $first_name;?>"></td>
			</tr>
			<tr> 
				<td>Last Name</td>
				<td><input type="text" name="last_name" value="<?php echo $last_name;?>"></td>
			</tr>
			<tr> 
				<td>Town Name</td>
				<td><input type="text" name="town_name" value="<?php echo $town_name;?>"></td>
			</tr>
			<tr> 
				<td>Gender</td>
				<td><input type="text" name="town_name" value="<?php echo $town_name;?>"></td>
				<td>Gender</td>
				<td><select name="gender">
				<option value="male" <?php if($gender == "male"){?> selected="selected" <?php }?>>male</option>
				<option value="female" <?php if($gender == "female"){?> selected="selected" <?php }?>>female</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
