<?php 
	include 'connect.php';
	
	echo"
		<form id='formadd' autocomplete='off' class='row col l12' action='matkul.php?a=1' method='post' 
			style='position:fixed; bottom:80px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding:20px;'>
				<div class='row col l12' style='padding-left:20px'>
						 <div class='input-field col l3' style='color: white;'>
							<input placeholder='Kode Materi' name='kdmatkul' type='text' style='background:transparent;' required>
						  </div>
						  <div class='input-field col l3' style='color: white;'>
							<input placeholder='Nama Materi' name='nmmatkul' type='text' style='background:transparent;' required>
						  </div>	
						  <div class='input-field col l3' style='color: white;'>
							<input placeholder='SKS' name='sks' type='text' style='background:transparent;' required>
						  </div>	
						  <div class='input-field col l3' style='color: white;'>
							<input placeholder='Semester' name='smt' type='text' style='background:transparent;' required>
						  </div>		
				</div>
						 
				<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:20px; '>
						<div class='col l2' style=' '>
							<div id='canceladd' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						</div>
						<div class='col l2' style=''>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Simpan'>
						</div>
					</div>
		</form>			
					
		<script>
			$(document).ready(function(e){
				$('#canceladd').click(function(e) {
				$('#formadd').hide(); //menyembunyikan form setelah diklik batal
				});
							
				e.preventDefault();
			});
		</script>
	";
		
?>