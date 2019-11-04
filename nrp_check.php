<?php
include 'connect.php';
if(isset($_POST['user_name']) && $_POST['user_name'] != 0){
	//$aw = 1061;
	
	$aw = $_POST['user_name'];
	$quer="SELECT * FROM tb_mhs WHERE nrp ='$aw'";
	$proses2=mysqli_query($con,$quer);
	$data = mysqli_num_rows($proses2);
	
	if($data == 0){
		echo "<span class ='text-success'>NRP tersedia</span>";
		echo"<script> 
					Materialize.toast('NRP tersedia', 5000)
				</script>";
	}
	
	else{
		echo "<span class ='text-danger' style='color:red;'>NRP sudah terdaftar</span>";
		echo "
				<script> 
					Materialize.toast('NRP sudah terdaftar', 5000)
				</script>";
	}
	
}

?>