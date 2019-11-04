<?php 
	include 'connect.php';

		echo"
			<div id='formd' class='row col l12' method='post' 
			style='position:fixed; bottom: 98px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding-left:80px; padding-right:80px; padding-bottom:20px; padding-top:40px;'>
					<div class='row col l12' style='color:white; text-allign:center; font-size:20px'>
						  Apakah anda yakin untuk menghapus semua data?
					</div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:880px; '>
						  <div class='col l6' style=' padding-left:20px; '>
							<div id='canceld' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						  </div>
						  <div class='col l6' style='padding-right:60px;'>
							<div id='sure' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Yakin</div>
						  </div>
					</div>
					 
			</div>
			
			<form id='formc' class='row col l12' action='berkas.php?d=1' method='post' 
			style='position:fixed; bottom: 98px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding-left:80px; padding-right:80px; padding-bottom:20px; padding-top:5px; display:none;'>
				<div class='row col l12' style='padding-left:20px'>
						 <div class='input-field col l3' style='color: white; padding-top:24px; font-size:18px;'>
							Konfirmasi Password Anda
						  </div>
						  <div class='input-field col l3' style='color: white; padding-top:10px;'>
							<input placeholder='Password' name='password' type='password' style='background:transparent;' required>
						  </div>	
				</div>		 
					<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:880px; '>
						  <div class='col l6' style=' padding-left:20px; '>
							<div id='canceldc' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						  </div>
						  <div class='col l6' style='padding-right:60px;'>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Yakin'>
						  </div>
					</div>
					 
			</form>
		
					
					<script>
						$(document).ready(function(e){
							$('#canceld').click(function(e) {
								$('#formd').hide();
							});
							$('#sure').click(function(e) {
								$('#formd').hide();
								$('#formc').show();
							});
							$('#canceldc').click(function(e) {
								$('#formc').hide();
							});
							
						e.preventDefault();
					});
					</script>
					";
?>