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
    
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    
    
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
                    <li><a href="http://localhost/pendeta_universitas/index.php/c_beranda">Beranda</a></li>
                    <li class="active"><a href="http://localhost/pendeta_universitas/index.php/c_artikel">Artikel <span class="sr-only">(current)</span></a></li>
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
    <form class="container" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_artikel/do_upload"; ?>">
        *Judul Artikel <input type="text" name="judulArtikel"> 
        <br>
        *Isi 
        <textarea id="summernote" name="isiArtikel"></textarea>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 173,
                    minHeight: 173,
                    maxHeight: 500,
                    focus: true,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['style', 'ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['picture', 'link', 'hr']],
                        ['misc', ['undo', 'redo', 'help']]
                    ],
                    disableDragAndDrop: true,
                });
            });
        </script>
        <p class="">Tanda * wajib diisi</p>
        <br>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    
    <div class="container">
        <br>
        <br>
        <?php
        $i = 0;
        foreach($data as $d){
            setlocale(LC_ALL, 'INDONESIA');
            $date = $d['waktu'];
            $date = date_create($date);
            $date = date_format($date,"l, d F Y");
            $date = strftime("%A, %d %B %Y", time());
            echo $date;
        ?>
        <br>
        <?php echo $d['judulArtikel']; ?>
        <br>
        <?php echo $d['isiArtikel']; ?>
        <br>
        <button type="button" name="btn-edit<?php echo $i; ?>">Edit</button>
        <button type="button" name="btn-delete<?php echo $i; ?>">Delete</button>
        <br>
        <br>
        <br>
        <?php $i++; } ?>
    </div>
    
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