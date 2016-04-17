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
         <div>
                <?php
            $i = 0;
            foreach($data as $d){
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
                        
                           <h3> <?php echo $d['judulArtikel']; ?> </h3>
                                            </div>
                    <div>
                        <?php echo $date; ?>
                        <p>
                        <?php echo $d['isiArtikel']; ?>
                        </p>
                       
                    </div>
                </div>
            <?php $i++;
            break;
             } ?>
                </div>
            </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>
