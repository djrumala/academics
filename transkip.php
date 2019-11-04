<html lang="en">
<link rel="icon" href="images/favicon.ico">
<title>Web Intel | Cetak Transkip</title>
<body>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	padding-left:20px;
	padding-right:20px;
}
.centerTable { margin: 0px auto; }


<div style="text-align:center; padding-top:40px;">
<div style="text-align:center; "><b>TRANSKRIP MATERI</b></div>
</style>

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
	$skslulus=$skslulus-$skskem;
	$skstempuh=$skstempuh+$skslulus;
	echo"
	<div style='text-align:center; padding-top:20px; overflow-x:auto;'>
		<TABLE style:'width:100%' class='centerTable'>
			<TR>
			  <TD><b>NRP / Nama</b></TD>
			  <TD>$nrp / $nama </TD>
			</TR>
			<TR>
			  <TD><b>SKS Tempuh / SKS Lulus</b></TD>
			  <TD>$skstempuh / $skslulus</TD>
			</TR>
			<TR>
			  <TD><b>Status</b></TD>
			  <TD>Normal </TD>
			</TR>
		</TABLE>
	</div>
	";
	
	echo"
	<div style='text-align:center; padding-top:20px; overflow-x:auto; width:100%;'>
		<TABLE style='text-align: center;' class='centerTable'>
			<TR><b>
			  <TD><b>Kode Materi</b></TD>
			  <TD><b>Nama Materi</b></TD>
			  <TD><b>SKS</b></TD>
			  <TD><b>Histori Nilai</b></TD>
			  <TD><b>Nilai</b></TD>
		</TR>
	";
	
	
	$nilaikem=0;
	$totsn=0;
	$totsnk=0; 
	$savey=0; 
	$saves=1;
	$cekmat="SELECT * FROM tb_kelas WHERE nrp='$nrp' AND (nilai='A' OR nilai='AB' OR nilai='B' OR nilai='BC' OR nilai='C' OR nilai='D' OR nilai='E') ORDER BY kdmatkul";
	$prmat=mysqli_query($con,$cekmat);
	
	while ($das = mysqli_fetch_assoc($prmat)){
		$mk=$das['kdmatkul'];
		$n=$das['nilai'];
		$th=$das['tahun'];
		$sm=$das['periode'];
		
		if($n=="A"){ $nilai=4;}
		else if($n=="AB"){ $nilai=3.5;}
		else if($n=="B"){ $nilai=3;}
		else if($n=="BC"){ $nilai=2.5;}
		else if($n=="C"){ $nilai=2;}
		else if($n=="D"){ $nilai=1;}
		else { $nilai=0;}
		
		if($sm==0) $smt="Gn";
		if($sm==1) $smt="Gs";
		
		
		$ceksks="SELECT  * FROM tb_matkul WHERE kdmatkul='$mk'";
		$prsks=mysqli_query($con,$ceksks);
		while ($ds = mysqli_fetch_assoc($prsks)){
			$nm_matkul=$ds['nmmatkul'];
			$sks=$ds['sks'];
		}
		
		$cekmat4="SELECT * FROM tb_kelas WHERE nrp='$nrp' AND kdmatkul='$mk' ORDER by kdmatkul, tahun, periode DESC";
		$prmat4=mysqli_query($con,$cekmat4);
		$rows=mysqli_num_rows($prmat4);
		
		while ($ds = mysqli_fetch_assoc($prmat4)){
			$mk=$ds['kdmatkul'];
			$thk=$ds['tahun'];
			$smtk=$ds['periode'];
			$nk=$ds['nilai'];
			if($nk=="A"){ $nilaik=4;}
			else if($nk=="AB"){ $nilaik=3.5;}
			else if($nk=="B"){ $nilaik=3;}
			else if($nk=="BC"){ $nilaik=2.5;}
			else if($nk=="C"){ $nilaik=2;}
			else if($nk=="D"){ $nilaik=1;}
			else{$nk=0;}
		}
		
		if($rows>1){//ada data kembar, siswa mengulang
			if($savey<$thk){
				$savey=$thk;
			}
			if($saves>$smtk){
				$saves=$smtk;
			}
			if(($savey==$th) && ($saves==$sm)){
			echo"
				<TR>
				  <TD>$mk</TD>
				  <TD>$nm_matkul</TD>
				  <TD>$sks</TD>
				  <TD>$th/$smt/$n</TD>
				  <TD>$n</TD>
				</TR>
			";
			}
			
			$ceksks1="SELECT  * FROM tb_matkul WHERE kdmatkul='$mk'";
			$prsks1=mysqli_query($con,$ceksks1);
			while ($ds1 = mysqli_fetch_assoc($prsks1)){
				$jsks=$ds1['sks'];
				$snk=$nilaik*$jsks;
				$totsnk=$totsnk+$snk;
			}
			
			/*echo"$mk
				<TR>
				  <TD>$mk</TD>
				  <TD>$nm_matkul</TD>
				  <TD>$jm_sks</TD>
				  <TD>$th/$smt/$n</TD>
				  <TD>$n</TD>
				</TR>
			";*/
		}
			
		else{//tidak ada data kembar
			echo"
			<TR>
			  <TD>$mk</TD>
			  <TD>$nm_matkul</TD>
			  <TD>$sks</TD>
			  <TD>$th/$smt/$n</TD>
			  <TD>$n</TD>
			</TR>
			";
			$ceksks="SELECT  * FROM tb_matkul WHERE kdmatkul='$mk'";
			$prsks=mysqli_query($con,$ceksks);
			while ($ds = mysqli_fetch_assoc($prsks)){
				$jsks=$ds['sks'];
				$sn=$nilai*$jsks;
				$totsn=$totsn+$sn;
			}
		}
		//echo"tes";
	}
	
	$totalsn=$totsn+($totsnk/2);
	echo" 
	</TABLE>
	</div>";
	
	if($skslulus>0)
	$ipk=round(($totalsn/$skslulus),2);
	
	else $ipk=0;
	
?>
	<div style="padding-top:20px;">
	<TABLE class="centerTable">
			<TR>
				  <TD>Total SKS</TD>
				  <TD><b><?php echo"$skslulus"; ?></b></TD>
			</TR>
			<TR>
				  <TD>IPK</TD>
				  <TD><b><?php echo"$ipk"; ?></b></TD>
			</TR>
	</TABLE>
	</div>
	
	<div style="padding-top:20px; text-align: left;">
	<TABLE style="text-align: left;" class="centerTable">
			<TR>
				<TD>
					CATATAN<br>Transkrip Materi ini hanya berlaku untuk keperluan:<br>
					1. Persyaratan Job Paduan Suara<br>
					2. Persyaratan Konser<br>
					3. Persyaratan Kompetisi Nasional<br>
					4. Persyaratan Kompetisi Internasional<br>
					5. ..............................................................(tuliskan keperluannya)
				</TD>
			</TR>
			<TR>
				  <TD><?php date_default_timezone_set("Asia/Bangkok"); echo "Tanggal cetak: " . date("d/m/Y") . "<br>";; ?></TD>
			</TR>
	</TABLE>
	</div>
	


</div>
</body>
</html>

