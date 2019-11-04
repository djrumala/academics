<?php
	include 'connect.php';
	$sort=$_GET['sort'];
	$vup=$_GET['mark'];
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*5;
	$vup=$awal+$vup;
	
	if($sort=='nm'){
		$queri="SELECT * from tb_dosen where flag=0 order by dosen";
	}
	if($sort=='id'){
		$queri="SELECT * from tb_dosen where flag=0 order by nip";
	}
	
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$kod=$data['nip'];
		$query="SELECT * from tb_dosen where nip = '$kod'";
		$process=mysqli_query($con,$query);
		while ($dep = mysqli_fetch_array ($process)){
		if(($b>$awal) && ($b<=($awal+5))){
			if($b==$vup){
				echo "
					<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
						<div id='xdata' class='col l6' style='background-color:#33A1C9; border: 1px solid #ff0080; border-right:0px;'>".$data['nip']."</div>
						<div id='xdata' class='col l6' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$data['dosen']."</div>
					</div>	
				";
			}
			else{
				echo "
					<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
						<div id='xdata' class='col l6'>".$data['nip']."</div>
						<div id='xdata' class='col l6'>".$data['dosen']."</div>
		
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
?>