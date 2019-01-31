
<html>

<head>
  <title>Administration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<?php
        mb_internal_encoding("UTF-8");

        function loadClass($class)
        {
            require("$class.php");
        }

        spl_autoload_register("loadClass");

		$userManager = new UserManager('localhost', 'root1', '123456789', 'userAdministration');
		
        ?>

  <div class="header">
  	<h2>User administration</h2>
  </div>

<form action="add.php" method="post">
  	
</form>

<div class='buttons'>


  	<form action="index.php" method="post">
  	  <button type="submit" class="btn" name="add_user">add new user</button>
  	
</form>

	<form action="index.php" method="post">
		
  	  <button type="submit" class="btn" name="show_user" value="ukaz">show users</button>
	</form>
	
</div>


<?php

if(isSet($_POST['add_user']))
{
	if(isSet($_POST['successful']))
	{
		echo ('<div class="messageAdd">User was succesfully added.</div>');
	}
	
	include ('add.html');
}
	
if(isSet($_POST['name']) && isSet($_POST['surname']) && isSet($_POST['age']) && isSet($_POST['password']) && isSet($_POST['city']) && isSet($_POST['add_user']))
	{
		
		$name = $_POST['name'];
		$surname  = $_POST['surname'];
		$password = $_POST['password'];
		$age = $_POST['age'];
		$city = $_POST['city'];
		$userManager->addUser($name, $surname, $password, $age, $city);
		
	}

if(isSet($_POST['delete_user']))
{
	$userManager->deleteUser($_POST['userId']);
}	

if(isSet($_POST['edit_user']))
{
	$userManager->editUser($_POST['userId'], $_POST['name'], $_POST['surname'], $_POST['password'], $_POST['age'] , $_POST['city']);
}		
		
if(isSet($_POST['show_user']) || isSet($_POST['edit_user']) || isSet($_POST['delete_user']))
{
	$userManager->showUsers();
}

?>

</body>
</html>

