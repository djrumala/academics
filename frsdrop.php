<?php 
	include 'connect.php';
	session_start();
		
	$semester = $_SESSION['smt'];
	$tahun = $_SESSION['thn'];
	$nrp = $_SESSION['nrp'];
	if($semester == 'Gasal') { $periode=1;}
	else {$periode=0;}
	
	$sort=$_GET['sort'];
	$vup=$_GET['mark'];
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*10;
	$vup=$awal+$vup;
	
	$queri="SELECT * FROM tb_kelas where nrp='$nrp' AND periode='$periode' AND tahun='$tahun' order by kdmatkul";
	
	$totalsks=0;
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_assoc ($proses)){
		$id=$data['kdmatkul'];
		
		$query="SELECT * from tb_matkul where kdmatkul = '$id'";
		$process=mysqli_query($con,$query);
		while ($dep = mysqli_fetch_assoc ($process)){
			$nama=$dep['nmmatkul'];
			$totalsks=$totalsks+$dep['sks'];
			if(($b>$awal) && ($b<=($awal+10))){
				if($b==$vup){
		echo"
			<form id='formminus' class='row col l12' action='frsdata.php?m=1' method='post' 
			style='background-color:#236B8E; opacity:0.9;  padding-right:80px; padding-top:20px; text-allign:left;'>
			
					<div class='row col l6' style='color:white; text-allign:left; font-size:18px; '>
						  Apakah anda yakin untuk drop materi '$id $nama' ?
					</div>
					<div class='input-field col l2' style='color: white;'>
							<input placeholder='Kode Materi' name='kdmatkul' type='text' value='$id' style='background:transparent; display:none;'>
					</div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; margin-left: 80px; padding-right:880px;'>
						  <div class='col l6' style=' padding-left:20px;'>
							<div id='cancelminus' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						  </div>
						  <div class='col l6' style='padding-right:60px;'>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Yakin'>
						  </div>
					</div>
					 
			</form>

		
					
					<script>
						$(document).ready(function(e){
							$('#cancelminus').click(function(e) {
								$('#formminus').hide();
							});
							$('#yakin').click(function(e) {
								$('#formminus').hide();
								$('#formconfirm').show();
							});
							$('#cancelconfirm').click(function(e) {
								$('#formconfirm').hide();
							});
							
						e.preventDefault();
					});
					</script>
					";
					
		}
	}
		}
	$b++;
	}
?>