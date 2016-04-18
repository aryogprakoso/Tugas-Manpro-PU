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
                
                <div class="font-size-17px margin-top-1em">

                </div>
              
            </div>
        </div>
        <div class="col-xs-12 col-sm-6" id="searchArtikel">
            <h2 class="color-gray">Artikel</h2>
            <hr class="line">
            <div class="padding-0em-3em">
               
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>
