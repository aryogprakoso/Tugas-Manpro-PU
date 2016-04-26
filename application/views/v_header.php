<?php
$this->load->helper('assets_helper');
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pendeta Universitas Kristen Duta Wacana Yogyakarta</title>
	
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alice|Open+Sans:400,300,700">-->
	
    <link href='<?php echo assets()."bootstrap/css/bootstrap.css" ?>' rel="stylesheet" type="text/css"/>
	<link href='<?php echo assets()."css/style.css" ?>' rel="stylesheet" type="text/css"/>
    <link href='<?php echo assets()."css/font.css" ?>' rel="stylesheet" type="text/css"/>
	<link href='<?php echo assets()."css/styleGambarSlider.css" ?>' rel="stylesheet" type="text/css"/>
    <link href='<?php echo assets()."jquery-ui/jquery-ui.css" ?>' rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src='<?php echo assets()."jquery-2.2.1.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."jquery-ui/jquery-ui.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."bootstrap/js/bootstrap.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."js/template.js"; ?>'></script>
    <script type="text/javascript" src='<?php echo assets()."js/v_header.js"; ?>'></script>
    
	<link href='<?php echo assets()."summernote/dist/summernote.css" ?>' rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src='<?php echo assets()."summernote/dist/summernote.js"; ?>'></script>

    <!-- MOBILE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <link rel="icon" href='<?php echo assets()."image/ukdw.png" ?>'>
</head>

<body class="">
    <header class="">
        <nav class="navbar navbar-fixed-top navbar-sticky">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header" style="margin-right:1em">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo-img navbar-brand"><a href="http://www.ukdw.ac.id/" style="display: inline-block"><img src='<?php echo assets()."image/logo.png"; ?>' style="max-width:200px"></a></div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class='<?php if(isset($nav_beranda)){echo $nav_beranda;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_beranda">BERANDA</a></li>
                        <li class='<?php if(isset($nav_tentang)){echo $nav_tentang;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_tentang">TENTANG</a></li>
                        <li class='<?php if(isset($nav_artikel)){echo $nav_artikel;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_artikel">ARTIKEL</a></li>
                        <li class='<?php if(isset($nav_galeri)){echo $nav_galeri;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_galeri">GALERI</a></li>
                        <li class='<?php if(isset($nav_peminjaman)){echo $nav_peminjaman;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_peminjaman">PEMINJAMAN</a></li>
                        <li class='<?php if(isset($nav_kontak)){echo $nav_kontak;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_kontak">KONTAK</a></li>
                        <li class='<?php if(isset($nav_pencarian)){echo $nav_pencarian;} ?>'><a href="http://localhost/pendeta_universitas/index.php/c_pencarian">PENCARIAN</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(!$this->session->userdata('username'))
                            {
                        ?>
                        <li class="point" >
                            <a id="login" data-toggle="modal" data-target="#loginform" data-whatever="@mdo"><!--span class="glyphicon glyphicon-log-in"></span-->LOGIN</a>
                        </li><?php
                            }
                            else
                            {
                        ?>  
                            <li>
                                <a class="display-name point" id="profile" data-toggle="modal" data-target="#profileform" data-whatever="@mdo"><?php echo $this->session->userdata('username'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('c_beranda/do_logout') ;?>" class="text-center">LOGOUT</a>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="notification text-center"></div>
    
    <!-- FORM LOGIN -->
    <div class="modal fade text-center" id="loginform" role="dialog">
        <div class="login-box">
            <div class="exit text-right">
                <a id="login" data-toggle="modal" data-target="#loginform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
            </div>

            <div class="form-group">
                <label for="inputUsername3" class="col-sm-5 control-label">Username</label>
                <div class="col-sm-7">
                    <input type="text" name="username" class="form-control" id="inputUsername3" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label">Password</label>
                <div class="col-sm-7">
                    <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password"required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <label class="error-message" id="errorLogin"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <button class="btn btn-default" id="submitLogin">Sign in</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FORM EDIT PASSWORD -->
    <div class="modal fade text-center" id="profileform" role="dialog">
        <div class="profile-box">
            <div class="exit text-right">
                <a id="profile" data-toggle="modal" data-target="#profileform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
            </div>

            <div class="form-group">
                <label for="inputUsername3" class="col-sm-5 control-label">Username</label>
                <div class="col-sm-7">
                    <input type="text" name="username" class="form-control" id="inputEditUsername" placeholder="Username" value="<?php echo $this->session->userdata('username'); ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label">Password Lama</label>
                <div class="col-sm-7">
                    <input type="password" name="passwordLama" class="form-control" id="inputEditPasswordLama" placeholder="Password Lama" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label">Password Baru</label>
                <div class="col-sm-7">
                    <input type="password" name="passwordBaru" class="form-control" id="inputEditPasswordBaru" placeholder="Password Baru" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-5 control-label">Confirm Password Baru</label>
                <div class="col-sm-7">
                    <input type="password" name="passwordBaruConfirm" class="form-control" id="inputKonfirmasiPasswordBaru" placeholder="Confirm Password Baru" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <label class="error-message" id="errorEditPass"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <button class="btn btn-default" id="submitEditPassword">Simpan</button>
                </div>
            </div>
        </div>
    </div>