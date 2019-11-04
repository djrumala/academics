<?php 
	include 'connect.php';
	$vup=$_GET['mark'];
	$sort=$_GET['sort'];
	$page=$_GET['pg'];
	$b=1;	
	$vup=$vup+$page*5; //penanda bernilai sama dengan posisi dari baris keseluruhan
	
	if($sort=='nm'){
		$queri="SELECT * from tb_dosen where flag=0 order by dosen";
	}
	if($sort=='id'){
		$queri="SELECT * from tb_dosen where flag=0 order by nip";
	}
	
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$id=$data['nip'];
		$nama=$data['dosen'];
		
		if($b==$vup){ //
		echo"
			<div id='formminus' class='row col l12' method='post' 
			style='position:fixed; bottom: 98px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding-left:80px; padding-right:80px; padding-bottom:20px; padding-top:40px;'>
					<div class='row col l12' style='color:white; text-allign:center; font-size:20px'>
						  Apakah anda yakin untuk menghapus data '$id $nama' ?
					</div>
					<div class='input-field col l2' style='color: white;'>
							<input placeholder='NIP' name='nip' type='text' value='$id' style='background:transparent; display:none;'>
					</div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:880px; '>
						  <div class='col l6' style=' padding-left:20px; '>
							<div id='cancelminus' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						  </div>
						  <div class='col l6' style='padding-right:60px;'>
							<div id='yakin' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Yakin</div>
						  </div>
					</div>
					 
			</div>
			
			<form id='formconfirm' class='row col l12' action='pelatih.php?m=1' method='post' 
			style='position:fixed; bottom: 98px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding-left:80px; padding-right:80px; padding-bottom:20px; padding-top:5px; display:none;'>
				<div class='row col l12' style='padding-left:20px'>
						 <div class='input-field col l3' style='color: white; padding-top:24px; font-size:18px;'>
							Konfirmasi Password Anda
						  </div>
						  <div class='input-field col l3' style='color: white; padding-top:10px;'>
							<input placeholder='Password' name='password' type='password' style='background:transparent;' required>
						  </div>
						  <div class='input-field col l3' style='color: white; padding-top:10px;'>
							<input placeholder='NIP' name='nip' type='text' value='$id' style='background:transparent; display:none;' required>
						  </div>		
				</div>		 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:880px; '>
						  <div class='col l6' style=' padding-left:20px; '>
							<div id='cancelconfirm' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
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
	$b++;
	}
?>