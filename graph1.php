<?php
	include 'connect.php';
	session_start();	
	
	$nrp = $_SESSION['nrp'];
	$bio="SELECT * from tb_mhs WHERE nrp='$nrp'";
	$probio=mysqli_query($con,$bio);
	while ($dr = mysqli_fetch_assoc($probio)){
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
	
	
	$sigy=0; //total ips 
	$sigx=0; //total sks
	$sigsqx=0;
	$sigxy=0;
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
		//echo"$maxth $minth $maxsmt";
		
		$smt=1;
		$i=0;
		$th=$minth;

		if($maxsmt==1) $d=($maxth-$minth)*2+1;
		else if($maxsmt==0) $d=($maxth-$minth)*2+2;
		
		echo "
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
			
			$x=$i+1;
								
						
			
			
			$smt--;
			if($smt<0){$smt=1; $th++;}
			
			$sigx=$sigx+$totalsks; //total X
			$sigy=$sigy+$ips; //total Y	
			
			$xy=$totalsks*$ips;
			$sigxy=$sigxy+$xy; //total penjumlahan dari X*y
			
			$sqx=$totalsks*$totalsks; //X kuadrat
			$sigsqx=$sigsqx+$sqx; //total x kuadrat
			$sigx=$sigx-$totalsks; //sigma X (total sks yg sudah dijalani)
		$sigsqx=$sigsqx-$sqx; //sigma X kuadrat (total kuadrat sks yg sudah dijalani)
		$sksber=$skstempuh-$skslulus; //sks yang diambil smt saat ini
			
		if($i==1){$prediksi=$ips;}
		else{

		//echo"skstempuh-skslulus: $sksber | sks semester ini: $totalsks<br>";	
		//if($sksber!=0 && $sksber==$totalsks){ //jika nilai semester ini belum ada yang keluar
			$j=$i-1;
			$averagex=$sigx/($i-1); //rata2 X
			$averagey=$sigy/($i-1); //rata2 Y

			//$b=($j*$sigxy-($sigy*$sigx))/($j*$sigsqx-($sigx*$sigx));
			$bpembilang=$j*$sigxy-($sigy*$sigx);
			$bpenyebut=$j*$sigsqx-($sigx*$sigx);
			
			if($bpenyebut>0){	
				$b=$bpembilang/$bpenyebut;
				$a=$averagey-$b*$averagex;
				$prediksi=round(($a+$b*$totalsks),2);
				
			}
		}
		
		echo "
				[$x, $ips,$totalsks],
		";
		
		$i++;
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
	}
	
	
?>

