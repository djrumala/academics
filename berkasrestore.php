<?php 
	include 'connect.php';
	$vup=$_GET['mark'];
	$sort=$_GET['sort'];
	$page=$_GET['pg'];
	$b=1;	
	$vup=$vup+$page*5; //penanda bernilai sama dengan posisi dari baris keseluruhan
	
	if($sort=='nm'){
		$queri="SELECT * from tb_mhs WHERE flag =1 order by nama";
	}
	if($sort=='id'){
		$queri="SELECT * from tb_mhs WHERE flag =1 order by nrp";
	}
	if($sort=='pf'){
		$queri="SELECT * from tb_mhs WHERE flag =1 order by nip";
	}
	if($sort=='dt'){
		$queri="SELECT * from tb_mhs WHERE flag =1 order by tgl";
	}
	if($sort=='vc'){
		$queri="SELECT * from tb_mhs WHERE flag=1 order by ids";
	}
	
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$id=$data['nrp'];
		$nama=$data['nama'];
		if($b==$vup){ //
		echo"
			<form id='form' class='row col l12' action='berkas.php?r=1' method='post' 
			style='position:fixed; bottom: 80px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding-left:40px; padding-bottom:20px; padding-top:20px;'>
					<div class='row col l12' style='padding-left:-20px;'>
						  <div class='input-field col l10' style='color: white; font-size: 20px;'>
							Apakah Anda ingin mengembalikan data '$id $nama'?
						  </div>
						  <div class='input-field col l2' style='color: white; display:none;'>
							<input placeholder='NRP' value='".$data['nrp']."' name='nrp' type='text' style='background:transparent;' readonly>
						  </div>
					</div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:20px; '>
						<div class='col l2' style=' '>
							<div id='canceledit' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						</div>
						<div class='col l2' style=''>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Ya'>
						</div>
					</div>
					 
			</form>
			
			
			
			<script>
				$(document).ready(function(e){
				$('#canceledit').click(function(e) {
					$('#form').hide();
					});			
					e.preventDefault();
				});
			</script>
			";		
		}
	$b++;
	}
?>