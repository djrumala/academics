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
	
		if($b==$vup){ //
		echo"
			<form id='form' class='row col l12' action='pelatih.php?e=1' method='post' 
			style='position:fixed; bottom: 80px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding:20px;'>
					<div class='row col l12' style='padding-left:20px;'>
						  <div class='input-field col l3' style='color: white;'>
							<input placeholder='NIP' value='".$data['nip']."' name='nip' type='text' style='background:transparent;' readonly>
						  </div>
						  <div class='input-field col l3' style='color: white;'>
							<input placeholder='Nama' value='".$data['dosen']."' name='nama' type='text' style='background:transparent;' required>
						  </div>
					</div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:20px; '>
						<div class='col l2' style=' '>
							<div id='canceledit' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						</div>
						<div class='col l2' style=''>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Simpan'>
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