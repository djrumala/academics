<html>
<head>
 <script src = "js/jquery-3.3.1.min.js"></script>
</head>


<body>
<?php 
	include 'connect.php';
	
	echo"
		<form id='formadd' autocomplete='off' class='row col l12' action='mhs.php?a=1' method='post' 
			style='position:fixed; bottom: 80px; background-color:#236B8E; opacity: 0.9; left:80px; right:80px; padding:10px;'>
				<div class='row col l12' style='padding-left:20px'>
						 <div class='input-field col l2' style='color: white;'>
							<input id='username' placeholder='No Induk Mahasiswa' name='nrp' type='text' style='background:transparent;' required>
							<span id='availability' style='padding-top:-20px;'></span> 
						  </div>
						  <div class='input-field col l2' style='color: white;'>
							<input placeholder='Nama' name='nama' type='text' style='background:transparent;' required>
						  </div>
						  <div class='input-field col l2' style='color: white;'>
							<input placeholder='Tanggal Lahir' name='tgl' type='date' style='background:transparent;' required>
						  </div>
						  <div class='input-field col l2' style='background-color: transparent; color:black;'>
							<select class='browser-default' name='ids' style='font-size:16px;'>
								<option value='' disable selected>---Pilih Suara---</option>
								";
								$que="SELECT * from tb_suara order by suara";
								$procc=mysqli_query($con,$que);
								while ($voice = mysqli_fetch_array ($procc)){
									echo"<option value='".$voice['ids']."' style='color: black;'>".$voice['suara']."</option>";
								}
							echo"
							</select>
						  </div>
						  <div class='input-field col l2' style='color:black;'>
							<select class='browser-default' name='nip' style='font-size:16px;'>
								<option value=''disable selected>---Pilih Pelatih---</option>
								";
								$quer="SELECT * from tb_dosen WHERE flag =0 order by dosen";
								$pro=mysqli_query($con,$quer);
								while ($dat = mysqli_fetch_array ($pro)){
									echo"<option value='".$dat['nip']."' style='color: black;'>".$dat['dosen']."</option>";
								}
							echo"
							</select>
						  </div>
						  <div class='input-field col l2' style='color: white;'>
							<input placeholder='Tahun masuk' name='tahun' type='text' style='background:transparent;' required>
						  </div>
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
					
		
	";
?>
</body>
<script>
			$(document).ready(function(e){
				$('#canceladd').click(function(e) {
				$('#formadd').hide(); //menyembunyikan form setelah diklik batal
				});
							
				e.preventDefault();
			});
			$(document).ready(function(){
				$('#username').blur(function(){
				var username = $(this).val();
				$.ajax({
					url:'nrp_check.php',
					method:'POST',
					data:{user_name:username},
					dataType:'text',
					success:function(html){
						$('#availability').html(html);
					}
				});
				});
			});
		</script>