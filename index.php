<html>
	<head>
		<style>
			body {
				margin: 20px;
			}
			
			#knjigaUtisaka {
				margin: auto;
				width: 650px;
			}
			
			#tekst, #forma {
				float: left;
			}
			
			#tekst {
				font-size: 20px;
				text-align: right;
				width: 100px;
			}
			
			#forma {
				width: 500px;
			}
			
			#ime, #mail {
				height: 27px;
				width: 500px;
			}
			
			#kom {
				height: 200px;
				width: 500px;
			}
			
			#dugme {
				font-size: 20px;
			}
		</style>
	</head>
	<body>
		<div id="knjigaUtisaka"> 
		
			<h1> Knjiga utisaka </h1>
			<div id="tekst">
				Ime: <br> <br>
				Email: <br> <br>
				Komentar: <br> <br>
			</div>
			<div id="forma">
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
				<input id="ime" type="text" name="ime"> <br> <br>
				<input id="mail" type="text" name="mail"> <br> <br>
				<input id="kom" type="text" name="komentar"> <br> <br>
				<input id="dugme" type="submit" value="Dodaj komentar"> 
				</form>
			</div>
		</div>
		
		<?php
			include 'config.php';
			if ($_SERVER['REQUEST_METHOD']=='POST'){
				$name = $_POST['ime'];
				$email= $_POST['mail'];
				$comment = $_POST['komentar'];
				$date = date("Y-m-d");
				$query = "INSERT INTO utisak (Ime, Email, Komentar, Datum) VALUES ('".$name."', '".$email."', '".$comment."', '".$date."')";
				if (($name!='') || ($email!='') || ($comment!='')){
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
						echo "Morate pravilno uneti vaš e-mail!";
					}
					else{
						if(mysqli_query($db, $query)){
							echo "Uspešno uneto u bazu!";
							$db->close();
						}
						else{
							echo "Nije uspešno uneto u bazu";
						}
					}
				}
				else{
					echo "Morate popuniti sva polja!";
				}
			}
		?>
	</body>
</html>