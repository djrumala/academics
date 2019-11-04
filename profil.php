<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel</title>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		$idu=$_COOKIE['id'];
		
		//echo "<script>Materialize.toast('Selamat datang ".$idu."', 1000)</script>;";
		if(isset($_GET['e'])){ //mengedit data
			$kd=$_POST['kdadmin'];
			$nama=$_POST['nama'];
			$username=$_POST['username'];
			$pass=$_POST['password'];
			
			$queri="UPDATE tb_admin set nama='$nama', username='$username', password ='$pass' WHERE kdadmin='$kd'";
			$proses=mysqli_query($con,$queri);
			if($proses) header('location:profil.php');
			//echo "<script>Materialize.toast('Data diperbaharui', 1000)</script>;";
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
	
	<!-- Dropdown Structure -->
	<ul id='dropexit' class='dropdown-content'>
		<li><a href="#!">one</a></li>
		<li><a href="#!">two</a></li>
		<li class="divider"></li>
		<li><a href="#!">three</a></li>
		<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
		<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
	</ul>
        
	<!--UI Web-->	

			<div class="col l12 m12 s12" style="background-color:#00546c; opacity:0.9; margin-right:80px; margin-left:80px; border-bottom: 3px solid white;">
				<div class="col l12 m12 s12" style="text-align:center; font-family: 'Spectral SC', sans-serif; font-size:36px; padding: 16px; color:white;">PADUAN SUARA MAHASISWA</div>
			</div >
			<div class="row col l12 m12 s12" style="opacity:0.9; margin-right:80px; margin-left:80px; text-align:center; ">
					<a id="head" href="mhs.php" class="col l2" style="padding:6px; border-bottom:3px solid white; border-right:1px solid white;">Mahasiswa</a>
					<a id="head" href="pelatih.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">Pelatih</a>
					<a id="head" href="matkul.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Kurikulum</a>
					<a id="head" href="frs.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">FRS</a>
					<a id="head" href="nilai.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Nilai</a>
					<a id="head" href="profil.php" class="col l2 dropdown-button" style="padding:6px; border-bottom:3px solid white;" >Profil Admin</a>
			</div>
			<div class="col l12 m12 s12" style="position:fixed; top:123px; bottom:0; background-color:white; opacity:0.5; left:80px; right:80px; padding:20px; padding-bottom:600px; text-align:right;">
				<div class="row col l12" style="padding-left:1160px; text-align:center; color:#000">
					
				</div>
			</div>
			
			<?php
			include 'connect.php';
			$idu=$_COOKIE['id'];
			$que="SELECT * FROM tb_admin WHERE username='".$idu."'";
			$procc=mysqli_query($con,$que);
			while ($dat = mysqli_fetch_array ($procc)){
				echo"
				<form id='form' class='row col l12' action='profil.php?e=1' method='post' 
				style='position:fixed; bottom: 20px; background-color:#236B8E; opacity:0.9; left:400px; right:400px; padding:10px;'>
						<div class='row col l12' style='padding-left:20px;'>
							  <div class='input-field col l12' style='color: white;'>Kode Admin
								<input placeholder='Kode Admin' value='".$dat['kdadmin']."' name='kdadmin' type='text' style='background:transparent;' readonly>
							  </div>
							  <div class='input-field col l12' style='color: white;'>Username
								<input placeholder='Username' label='username' value='".$dat['username']."' name='username' type='text' style='background:transparent;' required>
							  </div>
							  <div class='input-field col l12' style='color: white;'>Nama
								<input placeholder='Nama' value='".$dat['nama']."' name='nama' type='text' style='background:transparent;' required>
							  </div>
							  <div class='input-field col l12' style='color: white;'>Kata sandi
								<input placeholder='Password' value='".$dat['password']."' name='password' type='password' style='background:transparent;' required>
							  </div>
							 
						</div>
							 
						<div class='row col l12 m12 s12' style='text-allign:right; padding-left:120px; padding-right:20px; '>
							<div class='col l6' style=''>
								<a  href='index.php' class='col l6 btn ts modal-trigger' style=''>Log Out</a>
							</div>
							
							<div class='col l6' style=''>
								<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Simpan'>
							</div>
							
							
						</div>
						
				</form>
				";
			}
			
			?>
			
			<div class="col l12 m12 s12" style="position:fixed; top:134px; bottom:0 left:80px; right: 900px; font-size: 26px; font-family: 'Russo One'; color:#000; text-align:center;">
			PROFIL ADMIN</div>
	
</body>
</html>

