<?php
	include 'connect.php';
	session_start();	
	
	$nrp = $_SESSION['nrp'];
	$bio="SELECT * from tb_mhs WHERE nrp='$nrp'";
	$probio=mysqli_query($con,$bio);
	while ($dr = mysqli_fetch_assoc($probio)){
		$nama=$dr['nama'];
		$thn=$dr['thmasuk'];
	}
	
	$skslulus=0;
	$skstempuh=0;
	$i=0;
	$skskembar=0;
	$skskem=0;
	$cekmat="SELECT * FROM tb_kelas WHERE nrp='$nrp' ORDER by kdmatkul";
	$prmat=mysqli_query($con,$cekmat);
	while ($das = mysqli_fetch_assoc($prmat)){
			$score=$das['nilai'];	
			$matkul=$das['kdmatkul'];
			$takenyear=$das['tahun'];
			$takensmt=$das['periode'];
			
			$ceksks="SELECT * FROM tb_matkul WHERE kdmatkul='$matkul'";
			$prsks=mysqli_query($con,$ceksks);
			
			while ($ds = mysqli_fetch_assoc($prsks)){
				$jm_sks=$ds['sks'];
				$nm_matkul=$ds['nmmatkul'];
					if($score==null||$score=='nu'){
						$skstempuh=$skstempuh+$ds['sks'];
					}
					else{
						$skslulus=$skslulus+$ds['sks'];
					}
					
			}
			
			$cekmat1="SELECT * FROM tb_kelas WHERE nrp='$nrp' AND kdmatkul='$matkul' ORDER by kdmatkul";
			$prmat1=mysqli_query($con,$cekmat1);
			$row=mysqli_num_rows($prmat1);
			
			if($row>1){
				$ceksks="SELECT  * FROM tb_matkul WHERE kdmatkul='$matkul'";
				$prsks=mysqli_query($con,$ceksks);
			
				while ($ds = mysqli_fetch_assoc($prsks)){
					$skskembar=$skskembar+$ds['sks'];
				}
				
				$skskem=$skskembar/2;
			}
	}
	//echo"$skslulus $skskem";
	$skslulus=$skslulus-$skskem;
	$skstempuh=$skstempuh+$skslulus;
	
	echo"
	<div class='row col l12' style='margin-right: 270px; margin-left: 270px; background-color:white; text-align:left; font-size:16px; '>
				<div class='col l4' style=''>NRP / Nama  </div>
				<div class='col l8' style=''>: $nrp / $nama</div>
				<div class='col l4' style=''>SKS Tempuh / SKS Lulus</div>
				<div class='col l8' style=''>: $skstempuh / $skslulus</div>
				<div class='col l4' style=''>Suara</div>
				<div class='col l8' style=''>: Normal</div>
				<div class='col l4' style=''>Tahun Masuk</div>
				<div class='col l8' style=''>: $thn</div>
	</div>
	";
	
	
	$ceknrp="SELECT * FROM tb_kelas where nrp='$nrp'";
	$prceknrp=mysqli_query($con,$ceknrp);
	$row=mysqli_num_rows($prceknrp); //banyaknya data (baris table) di database
	
	if($row==0){
		echo "
			<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
				<div id='xdata' class='col l12' style='background-color:#33A1C9;'>Tidak Ada data</div>
			</div>	
		";
	}
	else{
		$minth=$thn;
		$qrx="SELECT * FROM tb_kelas where nrp='$nrp' AND tahun=(SELECT max(tahun) FROM tb_kelas WHERE nrp='$nrp')";
		$prx=mysqli_query($con,$qrx);
		while ($dr = mysqli_fetch_assoc($prx)){
			$maxth=$dr['tahun'];
		}
		//$qrx1="SELECT * FROM tb_kelas where nrp='02211540000020' AND tahun='2016' AND periode=(SELECT min(periode) FROM tb_kelas WHERE nrp='02211540000020' AND tahun='2016') ";
		$qrx1="SELECT * FROM tb_kelas where nrp='$nrp' AND tahun='$maxth' AND periode=(SELECT min(periode) FROM tb_kelas WHERE nrp='$nrp' AND tahun='$maxth') ";
		$prx1=mysqli_query($con,$qrx);
		while ($dr1 = mysqli_fetch_assoc($prx1)){
			$maxsmt=$dr1['periode'];
		}
		echo"$maxth $minth $maxsmt";
		
		$smt=1;
		$i=0;
		$th=$minth;

		if($maxsmt==1) $d=($maxth-$minth)*2+1;
		else if($maxsmt==0) $d=($maxth-$minth)*2+2;
		
		while($i<$d){
			$s=$i+1;
			if($smt==1){ $periode="Gasal";}
			else if($smt==0) {$periode="Genap";}
			echo"
			<div class='row col l12' style='padding-right: 10px; padding-left: 10px; text-align: center; margin: 0px; color: white;'>
					<div id='thead' class='col l12' style='padding: 6px;'>$th - $periode (Semester $s)</div>
				</div>
			<div class='row col l12' style='padding-right: 10px; padding-left: 10px; text-align: center; margin: 0px; color: white;'>
					<div id='thead' class='col l2' style='padding: 12px;'>Kode Materi</div>
					<div id='thead' class='col l5' style='padding: 12px;'>Nama Materi</div>
					<div id='thead' class='col l1' style='padding: 12px;'>SKS</div>
					<div id='thead' class='col l2' style='padding: 12px;'>Nilai Huruf</div>
					<div id='thead' class='col l2' style='padding: 12px;'>S*N</div>
				</div>";
						
			$totalsks=0;
			$totsn=0;
			
			$queri="SELECT * FROM tb_kelas where nrp='$nrp' AND tahun='$th' AND periode='$smt' order by kdmatkul";
			$proses=mysqli_query($con,$queri);
			while ($data = mysqli_fetch_assoc ($proses)){
				$kod=$data['kdmatkul'];
				$n=$data['nilai'];
				if($n=='nu' || $n==null) {$n="-";}
				if($n=="A"){ $nilai=4;}
				else if($n=="AB"){ $nilai=3.5;}
				else if($n=="B"){ $nilai=3;}
				else if($n=="BC"){ $nilai=2.5;}
				else if($n=="C"){ $nilai=2;}
				else if($n=="D"){ $nilai=1;}
				else { $nilai=0;}
				
				$query="SELECT * from tb_matkul where kdmatkul = '$kod'";
				$process=mysqli_query($con,$query);
				while ($dep = mysqli_fetch_assoc ($process)){
					$totalsks=$totalsks+$dep['sks'];
					$sn=$dep['sks']*$nilai;
					$totsn=$totsn+$sn;
							
							echo "
								<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
									<div id='xdata' class='col l2'>".$kod."</div>
									<div id='xdata' class='col l5'>".$dep['nmmatkul']."</div>
									<div id='xdata' class='col l1'>".$dep['sks']."</div>
									<div id='xdata' class='col l2'>".$n."</div>
									<div id='xdata' class='col l2'>".$sn."</div>
								</div>	
							";
							
					}		
			}
			
			if($totalsks>0) $ips=round(($totsn/$totalsks),2);
			if($totalsks==0) $ips=0;
			
			echo "
				<div id='vdata' class='row col l12' style='margin-left:400px; margin-right:400px; text-align:center; color:white;'>
					<div id='xdata' class='col l6' style='padding:2px; background-color:#33A1C9;'>Jumlah SKS</div>
					<div id='xdata' class='col l6' style='padding:2px; background-color:#33A1C9;'>".$totalsks."</div>
				</div>
				<div id='vdata' class='row col l12' style='margin-left:400px; margin-right:400px; margin-top:-20px; text-align:center; color:white;'>
					<div id='xdata' class='col l6' style='padding:2px; background-color:#33A1C9;'>IPS</div>
					<div id='xdata' class='col l6' style='padding:2px; background-color:#33A1C9;'>".$ips."</div>
				</div>	
				";
			
			$i++;
			$smt--;
			if($smt<0){$smt=1; $th++;}
		}
	}
?>

