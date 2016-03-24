<?php
$this->load->helper('assets_helper');
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pendeta Universitas Kristen Duta Wacana</title>
    <link href='<?php echo assets()."bootstrap/css/bootstrap.css" ?>' rel="stylesheet" type="text/css"/>
	<link href='<?php echo assets()."css/beranda.css" ?>' rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src='<?php echo assets()."jquery-2.2.1.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."bootstrap/js/bootstrap.js"; ?>'></script>
    
    
    <!-- MOBILE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse purple btn-border nav-font">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav nav">
                    <li class="active"><a href="http://localhost/pendeta_universitas/index.php/c_beranda">Beranda <span class="sr-only">(current)</span></a></li>
                    <li><a href="http://localhost/pendeta_universitas/index.php/c_artikel">Artikel</a></li>
                    <li><a href="http://localhost/pendeta_universitas/index.php/c_peminjaman">Peminjaman</a></li>
                    <li><a href="http://localhost/pendeta_universitas/index.php/c_galeri">Galeri</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tentang Pendeta Universitas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="http://localhost/pendeta_universitas/index.php/c_sejarah">Sejarah Pendeta Universitas</a></li>
                            <li><a href="http://localhost/pendeta_universitas/index.php/c_visi">Visi dan Misi</a></li>
                            <li><a href="http://localhost/pendeta_universitas/index.php/c_tugas">Tugas Pokok dan Program Pendeta Universitas</a></li>
                            <li><a href="http://localhost/pendeta_universitas/index.php/c_layanan">Layanan Unit</a></li>
                            <li><a href="http://localhost/pendeta_universitas/index.php/c_pejabat">Pejabat dan Staff</a></li>
                        </ul>
                    </li>
                </ul>
                
                <!--
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                </form>
                -->
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- FORM -->
    <form class="container" enctype="multipart/form-data" method="post" action="<?php echo base_url()."index.php/c_artikel/create"; ?>">
        Judul Artikel <input type="text" name="judulArtikel"> 
        <br>
        Isi <textarea name="isiArtikel"></textarea>
        <br>
        Foto <input type="file" name="userfile">
        <br>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    
    <!-- FOOTER -->
    <nav class="navbar navbar-static-bottom purple btn-border font-white footer">
        <div class="container">
            <p class="font-size-16px font-bold">PENDETA UNIVERSITAS</p>
            <p class="font-size-16px font-bold">Universitas Kristen Duta Wacana</p>
            <p>Jl. Dr. Wahidim Sudirohusodo 5-25 <br>Yogyakarta (55224) Indonesia. <br>Tel: +62 274 563929, Ext 104</p>
            <p class="text-right font-size-12px">Hak Cipta @ Pendeta Universitas Kristen Duta Wacana 2016.</p>
        </div>
    </nav>
</body>
</html>