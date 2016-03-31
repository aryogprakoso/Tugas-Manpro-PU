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
    <link href='<?php echo assets()."summernote/dist/summernote.css" ?>' rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src='<?php echo assets()."summernote/dist/summernote.js"; ?>'></script>
    
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
    
    <div class="container">
        <div class="row">
            <!-- LOGO UKDW -->
            <div class="col-md-6">
                <a href="http://www.ukdw.ac.id/">
                    <img src='<?php echo assets()."image/logo.png"; ?>'>
                </a>
            </div>
            <!-- TANGGAL DAN JAM -->
            <div class="col-md-6 text-right font-bold font-size-18px">
                <div>
                    <script type='text/javascript'>
                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                        var date = new Date();
                        var day = date.getDate();
                        var month = date.getMonth();
                        var thisDay = date.getDay(),
                            thisDay = myDays[thisDay];
                        var yy = date.getYear();
                        var year = (yy < 1000) ? yy + 1900 : yy;
                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    </script>
                </div>
                <div id="clock">
                    <script type="text/javascript">
                        function showTime() {
                            var a_p = "";
                            var today = new Date();
                            var curr_hour = today.getHours();
                            var curr_minute = today.getMinutes();
                            var curr_second = today.getSeconds();
                            curr_hour = checkTime(curr_hour);
                            curr_minute = checkTime(curr_minute);
                            curr_second = checkTime(curr_second);
                            document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
                        }
                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }
                        setInterval(showTime, 500);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MARQUEE -->
    <div class="container padding-top-35px">
       
    </div>
    
    <!-- IMAGE SLIDE SHOW -->
    <div id="myCarousel" class="carousel slide container" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner container" role="listbox">
            <div class="item active container display-img">
                <img src='<?php echo assets()."image/1.jpg"; ?>' alt="1">
            </div>

            <div class="item container display-img">
                <img src='<?php echo assets()."image/2.jpg"; ?>' alt="1">
            </div>
            
            <div class="item container display-img">
                <img src='<?php echo assets()."image/3.jpg"; ?>' alt="1">
            </div>
            
            <div class="item container display-img">
                <img src='<?php echo assets()."image/4.jpg"; ?>' alt="1">
            </div>
        </div>
        
        <!-- Left and right controls 
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>-->
</div>
    
    <div class="container">
        <div class="header-container">
            <h2><b>Masukan Gambar Baru :</b></h2>
        </div>

        <form class="container" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_galeri/do_upload"; ?>">
            <h5>Gambar</h5> <input type="file" name="userfile">
            <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
            <h6>Keterangan Gambar :</h6> 
                
            <textarea rows="4" cols="50" name="keteranganGambar"></textarea>
            <br>
            <input type="submit" name="submit" value="Submit"/>
        </form>
        <?php if (isset($success)) { echo $success; } ?>
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
