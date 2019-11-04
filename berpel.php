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

<body background="images/cityup.jpg" style="background-size:cover; opacity:0.9">
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	
	<!--FUNGSI PHP untuk mengedit, menghapus, dan menambah data-->
	<?php
		include 'connect.php';
		$idu=$_COOKIE['id'];
		//echo "<script>Materialize.toast('Selamat datang ".$idu."', 1000)</script>;";
		if(isset($_GET['r'])){ //mengembalikan satu data
			$nip=$_POST['nip'];
			$queri="UPDATE tb_dosen set flag=0 WHERE nip='$nip'";
			$proses=mysqli_query($con,$queri);
			if($proses) header('location:berpel.php');
		}
		if(isset($_GET['l'])){ //mengembalikan satu data
			$queri="UPDATE tb_dosen set flag=0 WHERE flag=1";
			$proses=mysqli_query($con,$queri);
			if($proses) header('location:berpel.php');
		}	
		if(isset($_GET['m'])){ //menghapus satu data		
			$id=$_POST['nip'];
			$pas=$_POST['password'];
			$quer="SELECT * FROM tb_admin WHERE username='".$idu."' and password='".$pas."' ";
			$proses=mysqli_query($con,$quer);
			$row=mysqli_num_rows($proses);
			if($row==0){
				echo "
				<script> 
					Materialize.toast('Password yang Anda masukkan salah', 5000)
				</script>";
			}
			else{
				$query = "DELETE FROM tb_dosen WHERE nip='$id'";
				$process = mysqli_query($con,$query);
				if($process) header('location:berpel.php');
			}
			//echo "<script>Materialize.toast('".$row."', 1000)</script>;";
		}
		if(isset($_GET['d'])){ //menghapus semua data	
			$pas=$_POST['password'];
			$quer="SELECT * FROM tb_admin WHERE username='".$idu."' and password='".$pas."' ";
			$proses=mysqli_query($con,$quer);
			$row=mysqli_num_rows($proses);
			if($row==0){
				echo "
				<script> 
					Materialize.toast('Password yang Anda masukkan salah', 5000)
				</script>";
			}
			else{
				$queri="DELETE FROM tb_dosen WHERE flag=1";
				$proses=mysqli_query($con,$queri);
				if($proses) header('location:berpel.php');
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
	
	<!-- Dropdown Structure -->
	<ul id='dropexit' class='dropdown-content'>
		<li><a href="#!">one</a></li>
		<li><a href="#!">two</a></li>
		<li class="divider"></li>
		<li><a href="#!">three</a></li>
		<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
		<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
	</ul>
        
	<!--UI Web-->	

			<div class="col l12 m12 s12" style="background-color:#00546c; opacity:0.9; margin-right:80px; margin-left:80px; border-bottom: 3px solid white;">
				<div class="col l12 m12 s12" style="text-align:center; font-family: 'Spectral SC', sans-serif; font-size:36px; padding: 16px; color:white;">PADUAN SUARA MAHASISWA</div>
			</div >
			<div class="row col l12 m12 s12" style="opacity:0.9; margin-right:80px; margin-left:80px; text-align:center; ">
					<a id="head" href="mhs.php" class="col l2" style="padding:6px; border-bottom:3px solid white; border-right:1px solid white;">Mahasiswa</a>
					<a id="head" href="pelatih.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">Pelatih</a>
					<a id="head" href="matkul.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Kurikulum</a>
					<a id="head" href="frs.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white; border-right:1px white solid;">FRS</a>
					<a id="head" href="nilaiawal.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Nilai</a>
					<a id="head" href="profil.php" class="col l2" style="padding: 6px; border-bottom: 3px solid white;border-right:1px white solid;">Profil Admin</a>
			</div>
			
			
			
			<div class="col l12 m12 s12" style="position:fixed; top:123px; bottom:0; background-color:white; opacity:0.3; left:80px; right:80px; padding:20px; padding-bottom:600px; text-align:right;">
				<div class="row col l12" style="padding-left:1160px; text-align:center; color:#000">
					<div  id="hal" class="col l3" style="text-align:center">	
					</div>
					<div  class="col l3" style="">dari 
					</div>
					<div id="maks" class="col l3" style="text-align:center">
					</div>
				</div>
			</div>
					
			<div class="col l12 m12 s12" style="position:fixed; top:144px; opacity:0.8; left:160px; right:160px; padding:40px; ">
				<div class="row col l12" style="padding-right: 10px; padding-left: 10px; text-align: center; margin: 0px; color: white;">
					<div  id="thead" onClick="sortid()" class="col l6" style="padding: 12px;">NIP</div>
					<div id="thead"  onClick="sortname()" class="col l6" style="padding: 12px;">Nama</div>
				</div>
				<div id="data"></div>
				
			</div>
			
			<div id="edit"></div>
			<div id="add"></div>
			<div id="minus"></div>
			<div id="deleteall"></div>

			<div class="col l12 m12 s12" style="position:fixed; bottom: 0px; left:80px; right:80px; padding:40px; text-align:right;">
				<div class="col l12 m12 s12">
					<a 	href="berpel.php?l=1" class="col l1 btn ts modal-trigger"  style="margin:2px;">Kembalikan Semua</a>
					<a 	OnClick="add()" class="col l1 btn ts modal-trigger"  style="margin:2px;">Kembalikan</a>
					<a  onClick="minus()" class="col l1 btn ts modal-trigger" style="margin:2px;">Hapus</a>
					<a  onClick="deleteall()" class="col l1 btn ts modal-trigger" style="margin:2px;">Hapus Semua</a>
					<a  onclick="leftclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_back</i></a>
					<a  onclick="rightclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_forward</i></a>
					<a  onclick="upclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_upward</i></a>
					<a  onclick="downclick()" class="col l1 btn ts modal-trigger" style="margin:2px;"><i class="material-icons">arrow_downward</i></a>
				</div>
			</div>
			<div class="col l12 m12 s12" style="position:fixed; top:134px; bottom:0 left:80px; right: 1095px; font-size: 26px; font-family: 'Russo One'; color:#000; text-align:center;">
			BERKAS PELATIH</div>
		
	
	<!--Mengetahui banyak data di database-->	
	<?php
		include 'connect.php';
		$queri="SELECT * from tb_dosen WHERE flag=1;";
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
	if(row<=5){ //banyak data kurang dari sama dengan 5
		maks=1; //jumlah halaman maks 1
	}
	else{
		while(row>(a+5)){ //lebih dari 5 baris dan kelipatan 5
			a=a+5; //bertambah kelipatan lima
			p++; //halaman akan bertamah 1
			maks=p+1; //halaman maks sesuai dengan yang mendekati dengan kelipatan 5 ke-(p+1)
		}
	}
	
	document.getElementById("maks").innerHTML = maks; //menunjukkan halaman terakhir
	
	//FUNGSI UNTUK MENAMPILKAN FORM SESUAI DENGAN TOMBOL YANG DIKLIK
	
	function add(){ //mengembalikan satu data
		$('#add').show();
		$(document).ready(function(){
				$("#add").load("berpelrestore.php?sort="+srt+"&mark="+vup+"&pg="+page);
		});
		$('#edit').hide();
		$('#minus').hide();
		$('#deleteall').hide();
	}
	
	function minus(){ //hapus satu data
		$('#minus').show();
		$(document).ready(function(){
				$("#minus").load("berpeldelete.php?sort="+srt+"&mark="+vup+"&pg="+page);
		});
		$('#add').hide();
		$('#edit').hide();
		$('#deleteall').hide();
	}
	function deleteall(){ //hapus semua
		$('#deleteall').show();
		$(document).ready(function(){
				$("#deleteall").load("berpeldelall.php");
		});
		$('#edit').hide();
		$('#minus').hide();
		$('#add').hide();
	}
	
	//FUNGSI untuk arrows
	function upclick(){
		vup--; //penanda menuju ke baris sebelumnya
		if(vup<1) { //jika sudah berada pada baris pertama
			vup=5; //kembali ke halaman sebelumnya akan menandai baris kelima
			page--;//menuju ke halaman sebelumnya
			if(page<0) //jika nilai page berkurang padahal sudah berada di halaman awal
			{
				page=0; //page tetap 0 tidak akan berpindah ke halaman manapun
				vup=1; //vup tetap 1 tidak akan menandai baris lain
			}
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function(){
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function downclick(){
		vup++; //penanda menuju ke baris berikutnya
		if((page*5+vup)>row){ //jika nilai penanda sudah melebihi jumlah data yang ada di halaman terakhir
			vup=row-page*5; //penanda ditahan pada baris terakhir untuk halaman terakhir
		}
		if(vup>5){ //setelah baris ke-lima kembali ke baris pertama
			vup=1; //penanda menuju ke baris pertama
			page++; //menuju ke halaman selanjutnya
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
		
	}
	
	function rightclick(){
		page++;
		vup=vup;
		kpk=(page-1)*5;
		if(page*5>=row){ //jika sudah berada di halaman terakhir
			//agar tidak menuju ke halaman berikutnya
			page=kpk/5; //supaya ditahan di halaman terakhir			
		}
		
		if((page*5>row-5)&&(row%5<vup)){ //satu halaman sebelum halaman terakhir dan penanda menunjuk baris ke-x, x<banyak data di halaman terakhir
			vup=row%5; //penanda akan menunjukkan baris terakhir pada halaman terakhir
		}
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		
		$(document).ready(function()
			{
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}
	
	function leftclick(){
		page--;
		
		if(page<0) page=0; //jika sudah berada di halaman awal maka tidak akan berpindah ke halaman manapun
		document.getElementById("hal").innerHTML = page+1; //memunculkan nomor halaman ke html (di pojok kanan atas)
		$(document).ready(function()
			{
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
		});
	}

	//FUNGSI UNTUK MEMBUKA DATA SESUAI DENGAN HEADER TABLE YANG DIKLIK
	$(document).ready(function()
	{
			$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //membuka pelatihdata.php untuk isi table
	});
		 
		function sortname()
		{
			$(document).ready(function()
			{	srt="nm"
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header nama diklik akan membuka data yang mengurutkan berdasar nama
			});
		}
		function sortid()
		{
			$(document).ready(function()
			{srt="id";
				$("#data").load("berpeldata.php?sort="+srt+"&mark="+vup+"&pg="+page); //header email diklik akan membuka data yang mengurutkan berdasar email
			});
		}
	
	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="jquery.jkey.js"></script>
    <script>
    
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
    </script>
</body>
</html>

