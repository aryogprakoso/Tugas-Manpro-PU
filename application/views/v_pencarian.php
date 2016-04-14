<?php 
$this->load->view('v_header', array('nav_pencarian'=>"active"));
?>

<div class="container margin-top-2em wrap-content">
    <div class="text-center">
        <input type="search" name="" id="search" required="true" value="" placeholder="Cari..." class="search-input">
    </div>
    <div class="row margin-top-2em">
        <div class="col-xs-12 col-sm-6" id="searchBerita">
            <h2 class="color-gray">Berita</h2>
            <hr class="line">
            <div class="padding-0em-3em">
                <div class="font-size-17px margin-top-1em"><a href="http://localhost/pendeta_universitass/index.php/c_berita">Hello World!</a></div>
                <div class="font-size-17px margin-top-1em"><a href="#">Hello World!</a></div>
                <div class="font-size-17px margin-top-1em"><a href="#">Hello World!</a></div>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-6" id="searchArtikel">
            <h2 class="color-gray">Artikel</h2>
            <hr class="line">
            <div class="padding-0em-3em">
                <div class="font-size-17px margin-top-1em italic">Hasil pencarian dengan kata kunci [kata kunci] tidak ditemukan</div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>