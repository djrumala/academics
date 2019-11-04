<?php
	include 'connect.php';
	session_start();
		
	$semester = $_SESSION['smt'];
	$tahun = $_SESSION['thn'];
	$nrp = $_SESSION['nrp'];
	if($semester == 'Gasal') { $periode=1;}
	else {$periode=0;}
	
	$sort=$_GET['sort'];
	$vup=$_GET['mark'];
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*10;
	$vup=$awal+$vup;
	
	$queri="SELECT * FROM tb_kelas where nrp='$nrp' AND periode='$periode' AND tahun='$tahun' order by kdmatkul";
	
	$totalsks=0;
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_assoc ($proses)){
		$kod=$data['kdmatkul'];
		
		$query="SELECT * from tb_matkul where kdmatkul = '$kod'";
		$process=mysqli_query($con,$query);
		while ($dep = mysqli_fetch_assoc ($process)){
			$totalsks=$totalsks+$dep['sks'];
			if(($b>$awal) && ($b<=($awal+10))){
				if($b==$vup){
					echo "
						<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
							<div id='xdata' class='col l3' style='background-color:#33A1C9; border: 1px solid #ff0080; border-right:0px;'>".$kod."</div>
							<div id='xdata' class='col l7' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$dep['nmmatkul']."</div>
							<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$dep['sks']."</div>
						</div>	
					";
				}
				else{
					echo "
						<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
							<div id='xdata' class='col l3'>".$dep['kdmatkul']."</div>
							<div id='xdata' class='col l7'>".$dep['nmmatkul']."</div>
							<div id='xdata' class='col l2'>".$dep['sks']."</div>
			
						</div>	
					";
				}
					
			}
		}
		$b++;
		
	}
	
	
	$row=mysqli_num_rows($proses); //banyaknya data (baris table) di database
	if($row==0){
		echo "
					<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
						<div id='xdata' class='col l12' style='background-color:#33A1C9;'>Tidak Ada data</div>
					</div>	
				";
	}
	else{
		echo "
					<div id='thead' class='row col l12' style='padding-right:10px; padding-left: 10px; margin-left: 10px; margin-right: 10px; text-align: center; color: white;'>
						<div id='thead' class='col l10' style='padding:8px;'>Total SKS</div>
						<div id='thead' class='col l2' style='padding:8px; padding-left:25px;'>".$totalsks."</div>
		
					</div>	
				";
	}
?>