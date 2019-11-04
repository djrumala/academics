<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Spectral+SC" rel="stylesheet"> 
</head>

<body background="images/cityup.jpg" style="background-size:cover; opacity:0.9">
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

	
	<!-- ////////////////////////////////////////////////////////////// -->
	 
	 <?php
		include 'connect.php';
		if(isset($_POST['username'])&&isset($_POST['pass'])){
			$idu=$_POST['username'];
			$pas=$_POST['pass'];
			
			$quer="SELECT * FROM tb_admin WHERE username='".$idu."' and password='".$pas."' ";
			$proses=mysqli_query($con,$quer);
			$row=mysqli_num_rows($proses);
			if($row==0){
				echo "
				<script> 
					Materialize.toast('username atau password yang Anda masukkan salah', 5000)
				</script>";
			}
			else{
				setcookie(id,$idu);
				header("location:mhs.php");
			}
				
		}
	  ?>

	<!--Style untuk tampilan-->
	<style>
		.ts{
			background:#00334d;
			color:white;
		}
		.ts:hover {
			background-color:#00546c;
			color:#ff0080;
		}
		#thead{
			background-color:#00334d;
			color:white;
		}
		#thead:hover{
			background-color:#00546c;
			color:#ff0080;
		}
		#vdata div{
			background-color: #236B8E; 
			padding: 5px;
		}
		#xdata:hover{
			color:#ff0080;
		}
	</style>
	  
	<div class="col l12 m12 s12" style="background:transparent; padding-left:120px; padding-right:120px; text-align:left;">
	<div id="background" class="row col l12 m12 s12" style="background:#00334d; opacity:0.8; padding-top:24px; padding-bottom:192px; padding-left:16px; padding-right:16px;">
	  <div class="col l12 m12 s12" style="text-align:right; font-family:'Spectral SC',sans-serif; font-size:64px; padding-top: 48px; padding-left:48px; padding-right:48px; color:white;">
		<p>Paduan Suara Mahasiswa</p>
	  </div>
	  <div class="col l16 m6 s6" style="text-align:right; font-family:'Josefin Sans', sans-serif; font-size:30px; padding-top:24px; color:white;">
		<p>"Keberhasilan diukur dengan ketekunan bukan kebetulan"</p>
	  </div>
	  <div class="col l16 m6 s6" style="padding-left:48px; padding-right:48px; text-align:center;">
		<form action="" method="post" style="border:2px white solid; border-radius:16px; padding:20px;">
		 <div class="row">
		  <div class="input-field col s12 m12 l12 xl12" style="color:white;">
			<input placeholder="Username" name="username" type="text" style="background:transparent;" required>
		  </div>
		  <div class="input-field col s12 m12 l12 xl12" style="color:white;">
			<input placeholder="Password" name="pass" type="password" class="validate" style="background:transparent;" required>
		  </div>
		 </div>
		 <div class="col l12 m12 s12" style="margin=2px; text-align=center;">
		  <input class="col l6 m6 s6 waves-effect waves-light btn ts" style="margin: 2px; font-family:'Josefin Sans', sans-serif; border:2px white solid; border-radius:8px;" type="submit" size="16" value="masuk">
		 </div>
		</form>
	   </div>
	</div>
	</div>
</body>
</html>

