<?php 
$this->load->view('v_header', array('nav_pencarian'=>"active"));
?>

<div class="container margin-top-2em height-content wrap-content">
    <div class="text-center">
     <form class="container" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_pencarian/"; ?>">
        <input type="text" name="search" id="search" required="true" value="" placeholder="Cari judul..." class="search-input">
        <br/>
        <br/>
        <input type="submit" name="submit" value="Cari" class="btn btn-default" style="width:100px;"/>
    </form>
    </div>
    <div class="row margin-top-2em">
         <div>
                <?php
            $i = 0;
            foreach($data as $d){
                ?>
                <div class="item-artikel">
                    <?php
                    setlocale(LC_ALL, 'INDONESIA');
                    $date = $d['waktu'];
                    $date = date_create($date);
                    $date = date_format($date,"l, d F Y");
                    $date = strftime("%A, %d %B %Y", time());
                    ?>
                    <div>
                        <span class="judulArtikel text-center"><h1> <?php echo $d['judulBerita']; ?> </h1></span>
                    </div>
                    <div>
                        <span class="text-center date"><h5 class="italic"><?php echo $date; ?></h5></span><br>
                        <p>
                        <?php echo $d['isiBerita']; ?>
                        </p>
                       
                    </div>
                </div>
            <?php $i++;
            break;
             } ?>
        </div>
    </div>
    
    <a href="#" class="go-top text-center" style="display: none;"><span class="glyphicon glyphicon-chevron-up point" style="font-size: 25px"></span></a>

    <script>
        $(document).ready(function() {
            // Show or hide the sticky footer button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.go-top').fadeIn(500);
                } else {
                    $('.go-top').fadeOut(300);
                }
            });

            // Animate the scroll to top
            $('.go-top').click(function(event) {
                event.preventDefault();

                $('html, body').animate({scrollTop: 0}, 300);
            })
        });
    </script>
</div>

<?php 
$this->load->view('v_footer');
?>
