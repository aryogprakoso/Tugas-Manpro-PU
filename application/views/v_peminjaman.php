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
	<link href='<?php echo assets()."css/peminjaman.css" ?>' rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src='<?php echo assets()."jquery-2.2.1.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."bootstrap/js/bootstrap.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."js/v_peminjaman.js"; ?>'></script>
    
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
                    <li><a href="<?php echo site_url('c_beranda/index') ;?>">Beranda</a></li>
                    <li><a href="http://localhost/pendeta_universitas/index.php/c_artikel">Artikel</a></li>
                    <li class="active"><a href="http://localhost/pendeta_universitas/index.php/c_peminjaman">Peminjaman</a></li>
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
    
    <h2 class="text-center">Jadwal Peminjaman Ruang dan Alat</h2>
    
    <!-- Input Tanggal -->
    <div class="text-center">
        <label>Pilih Tanggal Peminjaman</label>
        <input type="month" id="waktuSearch"/>
    </div>
    
    <div class="row">a</div>
    
    <!-- Table -->
    <div class = "container table-responsive">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th class = "text-center">Tanggal</th>
                <th class = "text-center">Mulai</th>
                <th class = "text-center">Selesai</th>
                <th class = "text-center">Ruang</th>
                <th class = "text-center">Alat</th>
                <th class = "text-center">Keterangan</th>
                <th class = "text-center">Penanggung Jawab</th>
              </tr>
            </thead>
            <tbody class="text-center" id="tableBody"></tbody>
        </table>
    </div>
    <?php
        if($this->session->userdata('username'))
        {
    ?>
    <!-- Button -->
    <div class="container">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" id="modalTambahData">Tambah Data</button>
    </div>
    <?php
        }
    ?>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                       data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Modal title
                    </h4>
                    </div>

                <!-- Modal Body -->
                <div class="modal-body">

                      <div class="form-group">
                          <label class="col-sm-2">Tanggal:</label>
                          <div class="col-sm-4">
                            <input type="date" id="waktuModal" required="required"/>
                          </div>
                          <label><small>(Format Tanggal = Bulan/Hari/Tahun)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Mulai:</label>
                          <div class="col-sm-4">
                            <input type="number" id="jamMulai" min="0" max="23" step="1" value="1"/>
                            <b>:</b>
                            <input type="number" id="menitMulai" min="0" max="45" step="15" value="0"/>
                          </div>
                          <label><small>(Format Mulai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Selesai:</label>
                          <div class="col-sm-4">
                            <input type="number" id="jamSelesai" min="1" max="24" step="1" value="1"/>
                            <b>:</b>
                            <input type="number" id="menitSelesai" min="0" max="60" step="15" value="0"/>
                          </div>
                          <label><small>(Format Selesai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Ruang:</label>
                          <div class="col-sm-5">
                                <label class="radio-inline"><input type="radio" name="ruang" value="Kapel Atas">Kapel Atas</label>
                                <label class="radio-inline"><input type="radio" name="ruang" value="Kapel Bawah">Kapel Bawah</label>
                          </div>
                          <label><small>(Pilih Salah Satu Ruang)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Alat:</label>
                          <div class="col-sm-8">
                                <label class="checkbox-inline"><input type="checkbox" value="Alat Musik">Alat Musik</label>
                                <label class="checkbox-inline"><input type="checkbox" value="Alat Peribadatan">Alat Peribadatan</label>
                                <label class="checkbox-inline"><input type="checkbox" value="Alat Elektronik">Alat Elektronik</label>
                          </div>
                          <label><small>(Boleh Kosong)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-5">Keterangan: <small>(Sisa </small><small id="sisaHuruf">200</small><small> Huruf)</small></label>
                          <textarea class="form-control" rows="3" id="keterangan"></textarea>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4">Penanggung Jawab:</label>
                          <select id="selectPJ"></select>
                      </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submitTambahPeminjaman" data-dismiss="modal"> Tambah Data </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Batal </button>
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