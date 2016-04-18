<?php 
$this->load->view('v_header', array('nav_pencarian'=>"active"));
?>

<div class="container margin-top-2em height-content">
    <div class="text-center">
     <form class="container" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_pencarian/"; ?>">
        <input type="text" name="search" id="search" required="true" value="" placeholder="Cari..." class="search-input">
        <br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    </div>
    <div class="row margin-top-2em">
        <div class="col-xs-12 col-sm-6" id="searchBerita">
            <h2 class="color-gray">Berita</h2>
            <hr class="line">
            <div class="padding-0em-3em">

              <?php
            $i = 0;
            foreach($data2 as $d){
                ?>
                <div class="item-artikel panel">
                    <?php
                    setlocale(LC_ALL, 'INDONESIA');
                    $date = $d['waktu'];
                    $date = date_create($date);
                    $date = date_format($date,"l, d F Y");
                    $date = strftime("%A, %d %B %Y", time());
                    ?>

                    <?php 
                        $er2 = $d['idBerita'];
                       
                        $er2 = str_replace("%20","",$er2);
                      
                     ?>
                    <div>
                        <a href="<?php echo base_url()."index.php/c_pencarian/selanjutnya2/"; echo $er2;  ?>">
                            <?php echo $d['judulBerita']; ?>
                        </a>
                    </div>
                    
                </div>
            <?php $i++; } ?>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-6" id="searchArtikel">
            <h2 class="color-gray">Artikel</h2>
            <hr class="line">
            <div class="padding-0em-3em">
             <?php
            $i = 0;
            foreach($test as $d){
                ?>
                <div class="item-artikel panel">
                    <?php
                    setlocale(LC_ALL, 'INDONESIA');
                    $date = $d['waktu'];
                    $date = date_create($date);
                    $date = date_format($date,"l, d F Y");
                    $date = strftime("%A, %d %B %Y", time());
                    ?>
                    <div>
                    <?php 
                        $er = $d['idArtikel'];
                       
                        $er = str_replace("%20","",$er);
                      
                     ?>
                        <a href="<?php echo base_url()."index.php/c_pencarian/selanjutnya/"; echo $er;  ?>">
                            <?php echo $d['judulArtikel']; ?>
                        </a>
                    </div>
                  
                </div>
            <?php $i++; } ?>
                
               
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>
