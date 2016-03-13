A. Folder untuk menyimpan file .php 
	pendeta_universitas > application > views
B. Folder untuk menyimpan file .css
	pendeta_universitas > assets > css
C. Kalau butuh file .js, tinggal bikin folder js di folder assets
	pendeta_universitas > assets > js
D. Buat simpan foto 
	pendeta_universitas > assets > image

E. Tambahkan code dibawah ini didalam file .php untuk me-load folder asset
	<?php
	$this->load->helper('assets_helper');
	defined('BASEPATH') OR exit('No direct script access allowed');
	?>

F. Untuk me-load file .css didalam file .php
	<link href='<?php echo assets()."css/(nama_file).css" ?>' rel="stylesheet" type="text/css"/>
	contoh: <link href='<?php echo assets()."css/beranda.css" ?>' rel="stylesheet" type="text/css"/>

G. Untuk me-load image didalam file .php
	<img src='<?php echo assets()."image/(nama_file).(extension_file)"; ?>'>
	contoh: <img src='<?php echo assets()."image/logo.png"; ?>'>