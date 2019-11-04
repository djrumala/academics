<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web Intel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Spectral+SC" rel="stylesheet"> 
</head>

<body background="images/cityup.jpg" style="background-size:cover; opacity:0.9; background-repeat: no-repeat; background-attachment: fixed;">
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		session_start();
		$idu=$_COOKIE['id'];
		
		$semester = $_SESSION['smt'];
		$tahun = $_SESSION['thn'];
		$nrp = $_SESSION['nrp'];
		if($semester == 'Gasal') { $periode=1;}
		else {$periode=0;}
		if(isset($_POST['smt']) && isset($_POST['thn']) && isset($_POST['nrp']) && isset($_GET['go'])){
			$_SESSION['smt'] = $_POST['smt'];
			$_SESSION['nrp'] =  $_POST['nrp'];
			$_SESSION['thn'] = $_POST['thn'];
			header("location:nilaiadd.php");
		}
			
		else if (isset($_GET['e'])){
			$kd = $_POST['kdmatkul']; 
			$nilai = $_POST['nilai']; 
			$query2="UPDATE tb_kelas SET nilai='$nilai' WHERE nrp = '$nrp' AND periode = '$periode' AND tahun = '$tahun' AND kdmatkul ='$kd'";
			$process2=mysqli_query($con,$query2);
				if($process2){
					//echo "<script>Materialize.toast('Mata Kuliah Berhasil di Hapus', 1000)</script>";
					header("location:nilaiadd.php");
				}
				else{
					echo "<script>Materialize.toast('Matateri gagal dihapus', 3000)</script>";
				}	
		}
		
	?>

	<!--Style untuk tampilan-->
	<style>
		.ts{
			background:#00334d;
			color:white;
		}
		.ts:hover {
			background-color:#00546c;
			color:#ff0080;
		}
		#head{
			background-color:#00111a;
			color:white;
		}
		#head:hover{
			background-color:white;
			color:#ff0080;
		}
		#thead{
			background-color:#00334d;
			color:white;
		}
		#thead:hover{
			background-color:#00546c;
			color:#ff0080;
		}
		#vdata div{
			background-color: #236B8E; 
			padding: 5px;
		}
		#xdata:hover{
			color:#ff0080;
		}
	</style>
        
	<!--UI Web-->	

			<div class="col l12 m12 s12" style="background-color:#00546c; opacity:0.9; margin-right:80px; margin-left:80px; border-bottom: 3px solid white;">
				<div class="col l12 m12 s12" style="text-align:center; font-family: 'Spectral SC', sans-serif; font-size:36px; padding: 16px; color:white;">PADUAN SUARA MAHASISWA</div>
			</div >
			<div class="row col l12 m12 s12" style="opacity:0.9; margin-right:80px; margin-left:80px; text-align:center; ">
					<a id="head" href="mhs.php" class="col l2" style="padding:6px; border-bottom:3px solid white; border-right:1px solid white;">Mahasiswa</a>
					<a id="head" href="pelatih.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">Pelatih</a>
					<a id="head" href="matkul.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Kurikulum</a>
					<a id="head" href="frsdata.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">FRS</a>
					<a id="head" href="nilai.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Nilai</a>
					<a id="head" href="profil.php" class="col l2 dropdown-button" style="padding:6px; border-bottom:3px solid white;" >Profil Admin</a>
			</div>
			
			
			<div class="col l12 m12 s12" style="background-color:white; margin-top:-20px; background-color:rgba(255,255,255,0.5); margin-left:80px; margin-right:80px; padding:20px; 
				text-align:right;">
				
				<div class="col l12 m12 s12" style="margin-left:10px; font-size: 26px; font-family: 'Russo One'; color:#000; text-align:left;">ENTRY NILAI</div>
				<div class="row col l12" style="padding-left:1160px; text-align:center; color:#000">
					<div  id="hal" class="col l3" style="text-align:center">	
					</div>
					<div  class="col l3" style="">dari 
					</div>
					<div id="maks" class="col l3" style="text-align:center">
					</div>
				</div>
			<form class="row col l12" action="nilaiadd.php?go=1" method="post" 
			style="padding-right:80px;">
				<div class="col l12" style="margin-left:570px;">
					  
					  <div class="input-field col l4" style="background-color: transparent; color:black;">
						<select class="browser-default" name="nrp" style="font-size:16px;">
						<option value="<?php echo $nrp;?>" style="color: black;"> 
							<?php echo $nrp;
								$cari="SELECT * from tb_mhs WHERE nrp = '$nrp'";
								$procari=mysqli_query($con,$cari);
								while ($mhs = mysqli_fetch_array ($procari)){
								echo" | ".$mhs['nama']."";
							}
							?>
						</option>
						<?php
							$cek="SELECT * from tb_mhs";
							$prs=mysqli_query($con,$cek);
							while ($mhs = mysqli_fetch_array ($prs)){
								echo"<option value='".$mhs['nrp']."' style='color: black;'>".$mhs['nrp']." | ".$mhs['nama']."</option>";
							}
						?>
						</select>
					  </div>
					  
					  <div class="input-field col l1" style="background-color: transparent; color:black;">
						<select class="browser-default" name="smt" style="font-size:14px;">
							<option value="<?php echo $semester;?>" style="color: black;"><?php echo $semester;?></option>
							<option value="Gasal" style="color: black;">Gasal</option>
							<option value="Genap" style="color: black;">Genap</option>
						</select>
					  </div>
					  
					  <div class="input-field col l1" style="background-color: transparent; color:black;">
						<select class="browser-default" name="thn" style="font-size:14px;">
						
							<option value="<?php echo $tahun;?>" style="color: black;"> <?php echo $tahun;?></option>
							<option value="2013" style="color: black;">2013</option>
							<option value="2014" style="color: black;">2014</option>
							<option value="2015" style="color: black;">2015</option>
							<option value="2016" style="color: black;">2016</option>
							<option value="2017" style="color: black;">2017</option>
							<option value="2018" style="color: black;">2018</option>
						</select>
					  </div>
				
					  
					  <div class="col l1" style="padding-top:20px;">
						<input class="waves-effect waves-light btn ts" style="border:1px #00334d solid;" type="submit" size="6" value="Pilih">
					</div>
					 
				</div>					 
			</form>
			
			<div class="col l12 m12 s12" style="">
				<div class="row col l12" style="margin-left: 80px; padding-right: 10px; padding-left: 10px; text-align: center; margin: 0px; color: white;">
					<div id="thead" class="col l2" style="padding: 12px;">Kode Materi</div>
					<div id="thead" class="col l6" style="padding: 12px;">Nama Materi</div>
					<div id="thead" class="col l2" style="padding: 12px;">SKS</div>
					<div id="thead" class="col l2" style="padding: 12px;">Nilai</div>
				</div>
				<div id="data"></div>
				
			</div>
			
			
			<div id="edit"></div>
			<div id="add"></div>
			<div id="minus"></div>
			<div id="deleteall"></div>

			<div class="col l12 m12 s12" style="padding-top:40px;">
				<div class="col l12 m6 s12">
					<a 	href="nilai.php" class="col l1 btn ts modal-trigger"  style="margin:2px;">Kembali</a>
					<a 	onClick="add()" class="col l1 btn ts modal-trigger"  style="margin:2px;">Edit Nilai</a>
					<a  onclick="leftclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_back</i></a>
					<a  onclick="rightclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_forward</i></a>
					<a  onclick="upclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_upward</i></a>
					<a  onclick="downclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_downward</i></a>
				</div>
			</div>
			</div>
			
	
	<!--Mengetahui banyak data di database-->	
	<?php
		include 'connect.php';
	
		$queri="SELECT * from tb_kelas WHERE nrp='$nrp' AND periode='$periode' AND tahun='$tahun'";
		$proses=mysqli_query($con,$queri);
		$row=mysqli_num_rows($proses); //banyaknya data (baris table) di database
		echo "
			<script>
				var row=$row; //banyak data di database
			</script>
		";
	?>	
		
	
	<script>
	var vup=1;
	var page=0;
	var kpk=1;
	var srt="id"; //penanda pengurutan berdasar nrp
	
	document.getElementById("hal").innerHTML = page+1; //menampilkan angka halaman pertama
	
	var maks;
	var a=0;
	var p=0;
	if(row<=10){ //banyak data kurang dari sama dengan 5
		maks=1; //jumlah halaman maks 1
	}
	else{
	while(row>(a+10)){ //lebih dari 5 baris dan kelipatan 5
		a=a+10; //bertambah kelipatan lima
		p++; //halaman akan bertamah 1
		maks=p+1; //halaman maks sesuai dengan yang mendekati dengan kelipatan 5 ke-(p+1)
	}
	}
	
	document.getElementById("maks").innerHTML = maks; //menunjukkan halaman terakhir
	
	function add(){ //edit
		$('#add').show();
		$(document).ready(function(){
				$("#add").load("nilaiedit.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka form edit dan menyalin datanya sesuai penanda ke form edit
		});
	}
	
	//FUNGSI untuk arrows
	function upclick(){
		vup--; //penanda menuju ke baris sebelumnya
		if(vup<1) { //jika sudah berada pada baris pertama
			vup=10; //kembali ke halaman sebelumnya akan menandai baris kelima
			page--;//menuju ke halaman sebelumnya
			if(page<0) //jika nilai page berkurang padahal sudah berada di halaman awal
			{
				page=0; //page tetap 0 tidak akan berpindah ke halaman manapun
				vup=1; //vup tetap 1 tidak akan menandai baris lain
			}
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function(){
				$("#data").load("nilaiisidata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function downclick(){
		vup++; //penanda menuju ke baris berikutnya
		if((page*10+vup)>row){ //jika nilai penanda sudah melebihi jumlah data yang ada di halaman terakhir
			vup=row-page*10; //penanda ditahan pada baris terakhir untuk halaman terakhir
		}
		if(vup>10){ //setelah baris ke-lima kembali ke baris pertama
			vup=1; //penanda menuju ke baris pertama
			page++; //menuju ke halaman selanjutnya
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("nilaiisidata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
		
	}
	
	function rightclick(){
		page++;
		vup=vup;
		kpk=(page-1)*10;
		if(page*10>=row){ //jika sudah berada di halaman terakhir
			//agar tidak menuju ke halaman berikutnya
			page=kpk/10; //supaya ditahan di halaman terakhir			
		}
		
		if((page*10>row-10)&&(row%10<vup)){ //satu halaman sebelum halaman terakhir dan penanda menunjuk baris ke-x, x<banyak data di halaman terakhir
			vup=row%10; //penanda akan menunjukkan baris terakhir pada halaman terakhir
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		
		$(document).ready(function()
			{
				$("#data").load("nilaiisidata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function leftclick(){
		page--;
		
		if(page<0) page=0; //jika sudah berada di halaman awal maka tidak akan berpindah ke halaman manapun
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("nilaiisidata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}

	//FUNGSI UNTUK MEMBUKA DATA SESUAI DENGAN HEADER TABLE YANG DIKLIK
	//var loadingdata = function(){
		$(document).ready(function(){
				$("#data").load("nilaiisidata.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka data.php untuk isi table
		});
		//}
	//setInterval(loadingdata, 2000);//2000 miliseconds to auto refresh 
	
	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="jquery.jkey.js"></script>
    <script>
	//FUNGSI UNTUK KEYBOARD
	  //LEFT
      $(document).jkey('left, pgup',function(){
        leftclick();
      });
	  //RIGHT
      $(document).jkey('right, pgdn',function(){
        rightclick();
      });
	  //ATAS
      $(document).jkey('up',function(){
        upclick();
      });
	  
	  //BAWAH
      $(document).jkey('down',function(){
        downclick();
      });
	  //DELETE
      $(document).jkey('delete',function(){
        minus();
      });
	  //insert
      $(document).jkey('insert',function(){
        add();
      });
      
    </script>
</body>
</html>

