<?php
	include 'connect.php';
	$sort=$_GET['sort'];
	$vup=$_GET['mark'];
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*5;
	$vup=$awal+$vup;
	
	if($sort=='nm'){
		$queri="SELECT * from tb_matkul order by nmmatkul";
	}
	if($sort=='id'){
		$queri="SELECT * from tb_matkul order by kdmatkul";
	}
	if($sort=='sk'){
		$queri="SELECT * from tb_matkul order by sks";
	}
	if($sort=='st'){
		$queri="SELECT * from tb_matkul order by smt";
	}
	
	$proses=mysqli_query($con,$queri);
	while ($data = mysqli_fetch_array ($proses)){
		$kod=$data['kdmatkul'];
		$query="SELECT * from tb_matkul where kdmatkul = '$kod'";
		$process=mysqli_query($con,$query);
		while ($dep = mysqli_fetch_array ($process)){
		if(($b>$awal) && ($b<=($awal+5))){
			if($b==$vup){
				echo "
					<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
						<div id='xdata' class='col l3' style='background-color:#33A1C9; border: 1px solid #ff0080; border-right:0px;'>".$data['kdmatkul']."</div>
						<div id='xdata' class='col l5' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$data['nmmatkul']."</div>
						<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$data['sks']."</div>
						<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px;'>".$data['smt']."</div>
					</div>	
				";
			}
			else{
				echo "
					<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
						<div id='xdata' class='col l3'>".$data['kdmatkul']."</div>
						<div id='xdata' class='col l5'>".$data['nmmatkul']."</div>
						<div id='xdata' class='col l2'>".$data['sks']."</div>
						<div id='xdata' class='col l2'>".$data['smt']."</div>
		
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