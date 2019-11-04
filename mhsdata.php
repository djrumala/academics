<?php
	include 'connect.php';
	$sort=$_GET['sort'];
	$vup=$_GET['mark'];
	$page=$_GET['pg'];
	$b=1;
	
	$awal=$page*5;
	$vup=$awal+$vup;
	
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
		$kod=$data['nip'];
		$ids=$data['ids'];
		$query="SELECT * from tb_dosen where nip = '$kod'";
		$process=mysqli_query($con,$query);
		while ($dep = mysqli_fetch_array ($process)){
			$que="SELECT * from tb_suara where ids = '$ids'";
			$pro=mysqli_query($con,$que);	
			while ($vc = mysqli_fetch_array ($pro)){
				if(($b>$awal) && ($b<=($awal+5))){
					if($b==$vup){
						echo "
						
							<div id='vdata' class='row col l12' style='padding-right:10px; padding-left:10px; margin:0px; text-align: center; color: white;'>
								<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-right:0px;'>".$data['nrp']."</div>
								<div id='xdata' class='col l3' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$data['nama']."</div>
								<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$data['tgl']."</div>
								<div id='xdata' class='col l2' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px; border-right:0px;'>".$vc['suara']."</div>
								<div id='xdata' class='col l3' style='background-color:#33A1C9; border: 1px solid #ff0080; border-left:0px;'>".$dep['dosen']."</div>
							</div>
						
						";
					}
					else{
						echo "
						
							<div id='vdata' class='row col l12' style='padding-right: 10px; padding-left: 10px; margin: 0px; text-align: center; color: white;'>
								<div id='xdata' class='col l2'>".$data['nrp']."</div>
								<div id='xdata' class='col l3'>".$data['nama']."</div>
								<div id='xdata' class='col l2'>".$data['tgl']."</div>
								<div id='xdata' class='col l2'>".$vc['suara']."</div>
								<div id='xdata' class='col l3'>".$dep['dosen']."</div>
				
							</div>	
							
						";
					}
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