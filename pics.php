
<html>
<!--Steve Yoon-->
<!--2016-04-01-->
	<?php
		
		//Variables
		$username = "root";
		$password = "";
		$server = "localhost";
		$database = "pictures";
		$table = "eventpics";
		
		//Connection information
		$connection = new mysqli($server, $username, $password, $database);
		if(mysqli_connect_errno()){
			echo "Connection ERROR";//Prints error if there is error
			die();
		}
		if(isSet($_FILES['imageFile']['tmp_name'])){
			$file = $_FILES['imageFile']['tmp_name'];
			//tmp_name = temporary name for the image
			$image = addslashes(file_get_contents($_FILES['imageFile']['tmp_name']));
			//name = Image name that is used
			$image_name = addslashes($_FILES['imageFile']['name']);
			$image_size = getimagesize($_FILES['imageFile']['tmp_name']);
			
			if($image_size==FALSE)
				echo "Please upload a valid Image File";
			else{
				//Insert to Database
				if($insert = mysqli_query($connection, "INSERT INTO eventpics VALUES ('','$image_name','$image')")){
					echo "Image uploaded.<p/>";
				}
				else{
					//$lastid = mysqli_insert_id();
					echo "Problem uploading image";
				}
				//$connection->close();
			}
		}
		else{
			echo "Please select an image to upload<br>";
		}
		
		//Delete all the pictures
		if(isSet($_GET["cleanTRUEorFALSE"]) AND ($_GET['cleanTRUEorFALSE']=='clear'))
			mysqli_query($connection, "TRUNCATE eventpics");
		
		//reading from database	
		$result = mysqli_query($connection,"SELECT * FROM eventpics");
		echo "#of Pictures = " . mysqli_num_rows($result);
		
		//End Connection
		$connection->close();
	?>
	
	<body>
	
	
	<script>	
		function cleanUP()
		{//Clean Comments
			var cleanTRUEorFalse = "";
			window.location.href = "pics.php?cleanTRUEorFALSE=clear";
		}
	</script>
		<!--Title-->
		<div
			align = "center"
			style = "font-family: verdana;
					font-size: 30px;
					color: black"
		>
			Event Pictures
		</div>
			
		<form
			action="pics.php"
			method="POST"
			enctype="multipart/form-data"
		>
			Choose Image to Upload:
			<input
				type="file"
				name="imageFile"
			/>
			<input
				type="submit"
				value="Post it"
			/>
		</form>
		
		<!--Clean button-->
		<button
			style =
			"
				font-family: verdana;
				font-size: 20px;
				color: black;
				position: absolute;
					left: 550px;
					top: 190px;
			"
			type="button"
			onclick="cleanUP()"
			<!--method clean() already built in-->
		>Clear
		</button>
		
		<br><br><br><br><br>
			<!--post images-->
			<?php
				echo "<table>";
				
				$i=0;
				while($row = mysqli_fetch_array($result)){
					if($i%4==0){
						echo "<tr>".PHP_EOL;
					}
					echo "<td>";
					?>
					<img src="data:image/jpeg;base64,
					<?php
					echo base64_encode($row['img']);?>" height="300" width="300">
					<?php
					echo "</td>";
					
					echo "<td>";
					echo $row['img_Name'];
					echo "</td>";
					$i++;
					if($i%4==0){
						echo "</tr>".PHP_EOL;
					}
				}
				echo "</table>";
			?>
		
	</body>
	
</html>