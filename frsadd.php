<?php 
	include 'connect.php';
	

		echo"
			<form id='formadd' class='row col l12' action='frsdata.php?a=1' method='post' 
			style='background-color:#236B8E; opacity:0.9; padding-left:80px; padding-right:80px; padding-top:40px; margin-top:20px;'>
					<div class='input-field col l6' style='background-color: transparent; color:black;'>
						<select class='browser-default' name='kdmatkul' style='font-size:16px;'>Tes";
							$que="SELECT * from tb_matkul";
							$procc=mysqli_query($con,$que);
							while ($voice = mysqli_fetch_array ($procc)){
								echo"<option value='".$voice['kdmatkul']."' style='color: black;'> ".$voice['kdmatkul']." | ".$voice['nmmatkul']." (".$voice['sks'].")</option>";
							}
			
						echo"
						</select>
					  </div>
						 
					<div class='row col l12 m12 s12' style='text-allign:left; padding: 20px; padding-right:880px;'>
						  <div class='col l6' style=' padding-left:20px; '>
							<div id='canceladd' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</div>
						  </div>
						  <div class='col l6' style='padding-right:60px;'>
							<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Simpan'>
						  </div>
					</div>
					 
			</form>

		
					
					<script>
						$(document).ready(function(e){
							$('#canceladd').click(function(e) {
								$('#formadd').hide();
							});
							$('#yakin').click(function(e) {
								$('#formadd').hide();
								$('#formconfirm').show();
							});
						e.preventDefault();
					});
					</script>
		";

?>