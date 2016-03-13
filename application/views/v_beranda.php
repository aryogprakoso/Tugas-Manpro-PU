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
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In</a>
                        <div class="dropdown-menu purple" style="padding: 15px; padding-bottom: 0px;">
                            <form action="" method="post" accept-charset="UTF-8">
                                <div class="text-center">
                                    <input style="margin-bottom: 15px" type="text" name="username" size="25%" placeholder="Username"/>
                                    <br>
                                    <input style="margin-bottom: 15px" type="password" name="password" size="25%" placeholder="Password"/>
                                    <br>
                                    <input class="btn btn-primary" style="clear: left; width: 45%; height: 32px; font-size: 13px; margin-bottom:10px;" type="submit" name="submit" value="Sign In"/>
                                </div>
                            </form>
                        </div>
                    </li>
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
        <marquee direction="left" scrollamount="4"><h3>SELAMAT DATANG DI WEBSITE PENDETA UNIVERSITAS KRISTEN DUTA WACANA</h3></marquee>
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
    
    <div class="container padding-top-35px">
        <div class="row">
            <div class="col-sm-9">
                <h2 class="font-bold">Berita Pendeta Universitas</h2>
                <hr class="line-bold">
                <div>
                    <p>Tanggal</p>
                    <h3 class="font-bold">Lorem ipsum dolor sit amet</h3>
                    <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#">Baca Selengkapnya >></a>
                    </p>
                </div>
                <div class="padding-top-35px">
                    <p>Tanggal</p>
                    <h3 class="font-bold">Lorem ipsum dolor sit amet</h3>
                    <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#">Baca Selengkapnya >></a>
                    </p>
                </div>
                <div class="padding-top-35px">
                    <p>Tanggal</p>
                    <h3 class="font-bold">Lorem ipsum dolor sit amet</h3>
                    <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#">Baca Selengkapnya >></a>
                    </p>
                </div>
            </div>
            
            <!-- LIST BERITA -->
            <div class="col-sm-3">
                <div>
                    <p class="padding-top-35px">Tanggal</p>
                    <a href="#" class="font-size-16px font-bold">Lorem ipsum dolor sit amet</a>
                </div>
                <div>
                    <p class="padding-top-35px">Tanggal</p>
                    <a href="#" class="font-size-16px font-bold">Lorem ipsum dolor sit amet</a>
                </div>
                <div>
                    <p class="padding-top-35px">Tanggal</p>
                    <a href="#" class="font-size-16px font-bold">Lorem ipsum dolor sit amet</a>
                </div>
                <div>
                    <p class="padding-top-35px">Tanggal</p>
                    <a href="#" class="font-size-16px font-bold">Lorem ipsum dolor sit amet</a>
                </div>
                <div>
                    <p class="padding-top-35px">Tanggal</p>
                    <a href="#" class="font-size-16px font-bold">Lorem ipsum dolor sit amet</a>
                </div>
                <div>
                    <nav>
                        <ul class="pagination">
                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
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