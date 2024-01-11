<?php 

	include_once 'config.php'; 
	
		if (! empty($_POST["state"])) 
		{ 

			$z = "SELECT * FROM `locals` WHERE state_id = '".$_POST['state']."' ";
			$res = mysqli_query($conn,$z);
		
			while ($row = mysqli_fetch_array($res) ) 
			{
				?> 
		
				<option  value="<?php echo $row['local_id'] ?>"><?php echo $row['local_name'] ?></option>
<?php		
			} 
		} 

?>