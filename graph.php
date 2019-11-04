<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel | Nilai Mahasiswa</title>
	<link rel="icon" href="images/favicon.ico">
</head>

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
	
	echo"<TABLE style:'width:100%' class='centerTable'>
			<TR>
			  <TD><b>NRP</b></TD>
			  <TD>$nrp </TD>
			</TR>
			  <TD><b>Nama</b></TD>
			  <TD>$nama</TD>
			</TR>
		</TABLE>";
		
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
	$aips=array();
	$sigy=0; //total ips 
	$sigx=0; //total sks
	$sigsqx=0;
	$sigxy=0;
	$ceknrp="SELECT * FROM tb_kelas where nrp='$nrp'";
	$prceknrp=mysqli_query($con,$ceknrp);
	$row=mysqli_num_rows($prceknrp); //banyaknya data (baris table) di database
	

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
		//echo"$maxth $minth $maxsmt";
		
		$smt=1;
		$i=0;
		$th=$minth;

		if($maxsmt==1) $d=($maxth-$minth)*2+1;
		else if($maxsmt==0) $d=($maxth-$minth)*2+2;
		
		
		
		while($i<$d){
			$s=$i+1;
			if($smt==1){ $periode="Gasal";}
			else if($smt==0) {$periode="Genap";}
			
						
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
					
				}
			}
			
			if($totalsks>0)  $ips=round(($totsn/$totalsks),2);		
			else $ips=0;
			$aips[$i]=$ips;
			
			
			$smt--;
			if($smt<0){$smt=1; $th++;}
		
			$sigx=$sigx+$s; //total X
			$sigmax=$sigx; //total X
			$sigy=$sigy+$ips; //total Y	
			
			$xy=$s*$ips;
			$sigxy=$sigxy+$xy; //total penjumlahan dari X*y
			
			$sqx=$s*$s; //X kuadrat
			$sigsqx=$sigsqx+$sqx; //total x kuadrat
			if($i==0) {$averagex=0; $averagey=0;}
			else{
			$averagex=$sigmax/($s); //rata2 X sks terlewati
			$averagey=$sigy/($s); //rata2 Y nilai
			}
			
			//$b=($j*$sigxy-($sigy*$sigx))/($j*$sigsqx-($sigx*$sigx));
			$bpembilang=$s*$sigxy-($sigy*$sigmax);
			$bpenyebut=$s*$sigsqx-($sigx*$sigmax);
			
			if($bpenyebut==0) $b=0;
			else $b=$bpembilang/$bpenyebut;
			
			$a=$averagey-$b*$averagex;
			//$prediksi=round(($a+$b*$i),2);
			$i++;
			/*echo"
					$ips Prediksi Semester $s: $prediksi | X*Y= $xy | $sigmax $sigxy<br>
				";*/

		}
		
		$prediksi=round(($a+$b*($i+1)),2);
		$aips[$d]=$prediksi;
		for($g=0;$g<($d+1);$g++){
			$h=$g+1;
			$estim=round(($a+$b*$h),2);
			echo"Semester $h: $aips[$g]  | ";
		}
		
		echo "
			<br>
			<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
			<div id='chart_div'>
			<script>
			google.charts.load('current', {'packages':['line', 'corechart']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {

			var button = document.getElementById('change-chart');
			var chartDiv = document.getElementById('chart_div');

			var data = new google.visualization.DataTable();
			data.addColumn('number', 'Semester');
			data.addColumn('number', 'IPS');
			data.addColumn('number', 'Trend');
						
			data.addRows([
			";
		
		for($g=0;$g<($d+1);$g++){
			$h=$g+1;
			$estim=round(($a+$b*$h),2);
			echo"[$h, $aips[$g], $estim],";
		}
		
		echo "	
			]);
			var materialOptions = {
			chart: {
			  title: 'Nilai Mahasiswa'
			},
			width: 450,
			height: 320,
			};

			function drawMaterialChart() {
				var materialChart = new google.charts.Line(chartDiv);
				materialChart.draw(data, materialOptions);
				button.innerText = 'Change to Classic';
				button.onclick = drawClassicChart;
			}
			drawMaterialChart();

			}							
		</script>
		</div>
		";
	
		
				
		
	
	
?>

