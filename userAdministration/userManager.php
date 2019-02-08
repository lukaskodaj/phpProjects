<?php

mb_internal_encoding("UTF-8");

		
class UserManager
{

	public function __construct($host, $user, $password, $database)
	{
		Database::connect($host, $user, $password, $database);
	}
	
	public function drawLabelIf($name, $number)
	{		
		if(($number % 10) === 0)
		{
			return '<label>'.$name.'</label>
							<br>';
		} else {
			return '';
		}		
	}
	
	public function showUsers()
	{	
		$message = "Are you sure you want to delete this item?";
		$items = $this->getUsers();

		$number = 10;
		
		foreach($items as $key => $item)
		{
			echo('<table>');
			echo '
				<link rel="stylesheet" type="text/css" href="style.css">
				
					<div class="addForm">
						<form action="index.php" method="post">
							
							<div class="input-group">
							'.$this->drawLabelIf("name", $number).'
							<input type="text" name="name" value='.$item['name'].' required>
							</div>
							
							<div class="input-group">
							'.$this->drawLabelIf("surname", $number).'
							<input type="text" name="surname" value='.$item['surname'].' required>
							</div>
							
							<div class="input-group">
							'.$this->drawLabelIf("password", $number).'						
							<input type="password" name="password" placeholder="password">
							</div>
							
							<div class="input-group">
							'.$this->drawLabelIf("age", $number).'							
							<input type="text" name="age" value='.$item['age'].' required>	  
							</div>
							
							<div class="input-group">	
							'.$this->drawLabelIf("city", $number).'
							<input type="text" name="city" value='.$item['city'].' required>	  
							</div>	
							
							<div class="input-group">	
							'.$this->drawLabelIf("creation date", $number).'
							<input type="text" name="dateCreation" value='.$item['dateCreation'].' disabled="true" required>	  
							</div>
							
							<input  type="hidden" name="userId" value='.$item['id'].'>
							
							<div class="input-group">
							'.$this->drawLabelIf("", $number).'
							<button type="submit" class="btn" name="edit_user">edit</button>
							</div>
							
							<div class="input-group">
							'.$this->drawLabelIf("", $number).'
							<button type="submit" class="btn" name="delete_user" onclick="return confirm(`.$message.`)";>delete</button>
							</div>
							
						</form>
				</div>';

			echo('</table>');
			
			$number++;
		}
	}
	
	public function getUsers()
	{
		$result = Database::query('SELECT * FROM user');
        return $result;
	}
	
	
	public function deleteUser($userId)
	{
		$result = Database::query("DELETE FROM user WHERE id=".$userId);
	}
	
	public function editUser($userId, $name, $surname, $password, $age, $city)
	{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		
		Database::query("UPDATE user SET id="."'".$userId."'".",name="."'".$name."'".",surname="."'".$surname."'".",password="."'".$hashed_password."'".",age="."'".$age."'".",city="."'".$city."'"."where id=".$userId);									
	}
	
	public function addUser($name, $surname, $password, $age, $city)
	{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$date = date("Y-m-d",time());
		Database::query('
            INSERT INTO `user`
            (`name`, `surname`, `password`, `age`, `city`, `dateCreation`)
            VALUES (?, ?, ?, ?, ?, ?)', array($name, $surname, $hashed_password, $age, $city, $date));
		
	}
	
}

?>