<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel | Formulir Rencana Studi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="icon" href="images/favicon.ico">
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
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		$idu=$_COOKIE['id'];
		
		session_start();
		if(isset($_POST['smt']) && isset($_POST['thn']) && isset($_POST['nrp']) && isset($_GET['go'])){
			$_SESSION['smt'] = $_POST['smt'];
			$_SESSION['nrp'] =  $_POST['nrp'];
			$_SESSION['thn'] = $_POST['thn'];
			header("location:frsdata.php");
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
		#head{
			background-color:#00111a;
			color:white;
		}
		#head:hover{
			background-color:white;
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

        
	<!--UI Web-->	

			<div class="col l12 m12 s12" style="background-color:#00546c; opacity:0.9; margin-right:80px; margin-left:80px; border-bottom: 3px solid white;">
				<div class="col l12 m12 s12" style="text-align:center; font-family: 'Spectral SC', sans-serif; font-size:36px; padding: 16px; color:white;">PADUAN SUARA MAHASISWA</div>
			</div >
			<div class="row col l12 m12 s12" style="opacity:0.9; margin-right:80px; margin-left:80px; text-align:center; ">
					<a id="head" href="mhs.php" class="col l2" style="padding:6px; border-bottom:3px solid white; border-right:1px solid white;">Mahasiswa</a>
					<a id="head" href="pelatih.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">Pelatih</a>
					<a id="head" href="matkul.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Kurikulum</a>
					<a id="head" href="frs.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">FRS</a>
					<a id="head" href="nilaiawal.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Nilai</a>
					<a id="head" href="profil.php" class="col l2 dropdown-button" style="padding:6px; border-bottom:3px solid white;" >Profil Admin</a>
			</div>
			
			
			<div class="col l12 m12 s12" style="position:fixed; top:123px; bottom:0; background-color:white; opacity:0.3; left:80px; right:80px; padding:20px; padding-bottom:600px; text-align:right;">
				<div class="row col l12" style="padding-left:1160px; text-align:center; color:#000">
					
				</div>
			</div>
		
			
			
			<div id="edit"></div>
			<div id="add"></div>
			<div id="minus"></div>
			<div id="deleteall"></div>

			<div class="col l12 m12 s12" style="position:fixed; top:130px; bottom:0 left:80px; right: 1030px; font-size: 26px; font-family: 'Russo One'; color:#000; text-align:center;">
			FORMULIR RENCANA STUDI</div>
			
			<form class="row col l12" action="frs.php?go=1" method="post" 
			style="position:fixed; top: 130px;  opacity:0.9; left:80px; right:80px; padding:20px;">
				<div class="col l12" style="padding-left:20px; margin-left:510px; ">
					  <div class="input-field col l4" style="background-color: transparent; color:black;">
						<select class="browser-default" name="nrp" style="font-size:16px;">
						<?php
							$cek="SELECT * from tb_mhs";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['nrp']."' style='color: black;'>".$mhs['nrp']." | ".$mhs['nama']."</option>";
							}
						?>
						</select>
					  </div>
					  
					  <div class="input-field col l1" style="background-color: transparent; color:black;">
						<select class="browser-default" name="smt" style="font-size:14px;">
							<option value="Genap" style="color: black;">Genap</option>
							<option value="Gasal" style="color: black;">Gasal</option>
						</select>
					  </div>
					  
					  <div class="input-field col l1" style="background-color: transparent; color:black;">
						<select class="browser-default" name="thn" style="font-size:14px;">
							<option value="2017" style="color: black;">2017</option>
							<option value="2013" style="color: black;">2013</option>
							<option value="2014" style="color: black;">2014</option>
							<option value="2015" style="color: black;">2015</option>
							<option value="2016" style="color: black;">2016</option>
							<option value="2017" style="color: black;">2017</option>
							<option value="2018" style="color: black;">2018</option>
						</select>
					  </div>
					  
					  
					  <div class="col l2" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="border:1px #00334d solid;" type="submit" size="6" value="Pilih">
					</div>
					 
				</div>
					 
				<div class="row col l6" style="text-allign:left;">
					
				</div>
					 
			</form>
		

</body>
</html>

