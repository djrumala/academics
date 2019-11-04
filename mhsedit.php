<?php 
	include 'connect.php';

	$vup=$_GET['mark'];
	$sort=$_GET['sort'];
	$page=$_GET['pg'];
	$b=1;	
	$edit=0;
	$vup=$vup+$page*5; //penanda bernilai sama dengan posisi dari baris keseluruhan
	
	if($sort=='nm'){
		$queri="SELECT * from tb_mhs WHERE flag=0 order by nama";
	}
	if($sort=='id'){
		$queri="SELECT * from tb_mhs WHERE flag=0 order by nrp";
	}
	if($sort=='pf'){
		$queri="SELECT * from tb_mhs WHERE flag=0 order by nip";
	}
	if($sort=='dt'){
		$queri="SELECT * from tb_mhs WHERE flag=0 order by tgl";
	}
	if($sort=='vc'){
		$queri="SELECT * from tb_mhs WHERE flag=0 order by ids";
	}

		
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$nip=$data['nip'];
		$ids=$data['ids'];
		$nrp=$data['nrp'];
	
		$cek="SELECT * FROM tb_mhs WHERE nrp='$nrp'";
		$procek=mysqli_query($con,$cek);
		
		while ($datedit = mysqli_fetch_array ($procek)){
			$flag=$datedit['edit'];
		}
		
	
	if(($b==$vup)){
		if($flag==0){ //edit=0 pada database
				$change="UPDATE tb_mhs set edit=1 WHERE nrp = '$nrp'";
				$prochange=mysqli_query($con,$change);
		echo"
			<form id='form' class='row col l12' action='mhs.php?e=1' method='post' 
			style='position:fixed; bottom: 80px; background-color:#236B8E; opacity:0.9; left:80px; right:80px; padding:20px;'>
				<div class='row col l12' style='padding-left:20px;'>
					  <div class='input-field col l2' style='color: white;'>
						<input placeholder='NRP' value='".$data['nrp']."' name='nrp' type='text' style='background:transparent;' readonly>
					  </div>
					  <div class='input-field col l2' style='color: white;'>
						<input placeholder='Nama' value='".$data['nama']."' name='nama' type='text' style='background:transparent;' required>
					  </div>
					  <div class='input-field col l2' style='color: white;'>
						<input placeholder='Tanggal Lahir' value='".$data['tgl']."' name='tgl' type='date' style='background:transparent;' required>
					  </div>
					  <div class='input-field col l2' style='background-color: transparent; color:black;'>
						<select class='browser-default' name='ids' style='font-size:16px;'>Tes";
							$que="SELECT * from tb_suara where ids ='$ids'";
							$procc=mysqli_query($con,$que);
							while ($voice = mysqli_fetch_array ($procc)){
								echo"<option value='".$voice['ids']."' style='color: black;'>".$voice['suara']."</option>";
							}
							
							$selecting="SELECT * from tb_suara order by suara";
							$processing=mysqli_query($con,$selecting);
							while ($vc = mysqli_fetch_array ($processing)){
								echo"<option value='".$vc['ids']."' style='color: black;'>".$vc['suara']."</option>";
							}
						echo"
						</select>
					  </div>
					  <div class='input-field col l2' style='color:black; background:transparent;'>
						<select class='browser-default' name='nip' style='font-size:16px;'>Tes";
							$queer="SELECT * from tb_dosen where nip ='$nip'";
							$proo=mysqli_query($con,$queer);
							while ($daat = mysqli_fetch_array ($proo)){
								echo"<option value='".$daat['nip']."' style='color: black;'>".$daat['dosen']."</option>";
							}
							
							$quer="SELECT * from tb_dosen WHERE flag =0 order by dosen";
							$pro=mysqli_query($con,$quer);
							while ($dat = mysqli_fetch_array ($pro)){
								echo"<option value='".$dat['nip']."' style='color: black;'>".$dat['dosen']."</option>";
							}
						echo"
						</select>
					  </div>
				</div>
					 
				<div class='row col l12 m12 s12' style='text-allign:left; padding-left: 20px; padding-right:20px; '>
					<div class='col l2' style=' '>
						<a href='mhs.php?change=1&nrp=".$nrp."' id='canceledit' class='waves-effect waves-light btn ts' style='border:1px #00334d solid;'>Batal</a>
					</div>
					<div class='col l2' style=''>
						<input class='waves-effect waves-light btn ts' style='border:1px #00334d solid;' type='submit' size='6' value='Simpan'>
					</div>
				</div>
					 
			</form>
			
			
			";		
			
			
		}
		else{
			echo "
				<script> 
					Materialize.toast('Data sedang diedit', 2000)
				</script>";
		}	
	}
		
	$b++;
	}
?>