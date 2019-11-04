<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel | Nilai Mahasiswa</title>
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

<body background="images/cityup.jpg" style="background-size:cover; opacity:0.9; background-repeat: no-repeat; background-attachment: fixed;">
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		$nrp = $_SESSION['nrp'];
		if(isset($_POST['nrp']) && isset($_GET['go'])){
			$_SESSION['nrp'] =  $_POST['nrp'];
			$_SESSION['smt'] =  "Genap";
			$_SESSION['thn'] =  "2017";
			header("location:nilai.php");
		}
		
		if (isset($_GET['a'])){
			$kd = $_POST['kdmatkul']; 
			$query2="SELECT * FROM tb_kelas WHERE nrp = '$nrp' AND periode = '$periode' AND tahun = '$tahun' AND kdmatkul ='$kd'";
			$process2=mysqli_query($con,$query2);
			$row=mysqli_num_rows($process2);
			if($row==0){
				$query="INSERT INTO tb_kelas (nrp,periode,tahun,kdmatkul) VALUES ('$nrp','$periode','$tahun','$kd')";
				$process=mysqli_query($con,$query);
				if($process){
					header("location:nilai.php");
				}
				else{
					echo "<script>Materialize.toast('Materi gagal ditambahkan', 3000)</script>";
				}	
			}
			else{
				echo "<script>Materialize.toast('Materi sudah diambil Semester ini', 3000)</script>";
			}
		}
			
		else if (isset($_GET['m'])){
			$kd = $_POST['kdmatkul']; 
			$query2="DELETE FROM tb_kelas WHERE nrp = '$nrp' AND periode = '$periode' AND tahun = '$tahun' AND kdmatkul ='$kd'";
			$process2=mysqli_query($con,$query2);
				if($process2){
					//echo "<script>Materialize.toast('Mata Kuliah Berhasil di Hapus', 1000)</script>";
					header("location:nilai.php");
				}
				else{
					echo "<script>Materialize.toast('Matateri gagal dihapus', 3000)</script>";
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
					<a id="head" href="nilai.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Nilai</a>
					<a id="head" href="profil.php" class="col l2 dropdown-button" style="padding:6px; border-bottom:3px solid white;" >Profil Admin</a>
			</div>
			
			
		<div class="col l12 m12 s12" style="background-color:rgba(255,255,255,0.5); margin-top:-20px; margin-left:80px; margin-right:80px; padding:20px; text-align:center;">
			<div class="col l12 m12 s12" style=" margin-left:80px; opacity:1; font-size: 26px; font-family: 'Russo One'; color:#000; text-align:left;">NILAI MAHASISWA</div>
			<form class="row col l12" action="nilai.php?go=1" method="post" style="margin-right:160px;">
				<div class="col l12" style="margin-left:400px;">
					  
					  <div class="input-field col l4" style="background-color: transparent; color:black;">
						<select class="browser-default" name="nrp" style="font-size:16px;">
						<option value="<?php echo $nrp;?>" style="color: black;"> 
							<?php echo $nrp;
								$cari="SELECT * from tb_mhs WHERE nrp = '$nrp'";
								$procari=mysqli_query($con,$cari);
								while ($mhs = mysqli_fetch_array ($procari)){
								echo" | ".$mhs['nama']."";
							}
							?>
						</option>
						<?php
							$cek="SELECT * from tb_mhs";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['nrp']."' style='color: black;'>".$mhs['nrp']." | ".$mhs['nama']."</option>";
							}
						?>
						</select>
					  </div>
					  			
					  
					  <div class="col l2" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="border:1px #00334d solid;" type="submit" size="6" value="Pilih">
					</div>
					
				</div>					 
			</form>
			<div class="col l12" style="padding:10px;">
					 <a href="transkip.php" target="_blank" class="waves-effect waves-light btn ts" style="border:1px #00334d solid; margin-right:20px;"  >Cetak Transkip</a>
					 <a href="nilaiadd.php" class="waves-effect waves-light btn ts" style="border:1px #00334d solid;"  >Entry Nilai</a>
					 </div>
			<div class="col l12 m12 s12" style="margin-left:80px; margin-right:80px; padding-top:10px;">
				<div id="data"></div>
				
			</div>
			
			<div class="col l12 m12 s12" style="margin-left:80px; margin-right:80px; padding-top:10px;">
				<a id="head" href="graph.php" target="_blank"  class="col l4 " style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">Grafik</a>
			</div>
		</div>
		
		

	<script>

	//FUNGSI UNTUK MEMBUKA DATA SESUAI DENGAN HEADER TABLE YANG DIKLIK
	//var loadingdata = function(){
		$(document).ready(function(){
				$("#data").load("nilaidata.php"); //membuka data.php untuk isi table
		});
	//}
	//setInterval(loadingdata, 000);//2000 miliseconds to auto refresh 
	
	</script>
	
</body>
</html>

