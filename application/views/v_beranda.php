<?php 
$this->load->view('v_header', array('nav_beranda'=>"active"));
?>

<script type="text/javascript" src='<?php echo assets()."js/v_berita.js"; ?>'></script>

<div class="wrap-content">
    <!-- IMAGE SLIDE SHOW -->
    <div id="myCarousel" class="carousel slide container margin-top-3em" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner container" role="listbox">
            <?php $i = 1; ?>
            <?php foreach ($imgslider as $image): ?>
                <?php $item_class = ($i == 1) ? 'item active' : 'item'; ?>
                <div class="<?php echo $item_class; ?>">
                      <a href="#">
                                <img src="<?php echo base_url('assets/uploads/'. $image['pathGambar']); ?>" 
                                    alt=""  class="img-responsive" style="height:400px; width:100%" />
                      </a>
                </div>
            <?php $i++; ?>
            <?php endforeach; ?> 
        </div>
    </div>

    <?php
        if($this->session->userdata('username'))
        {
    ?>
    <div class="container">
        <button type="button" class="btn margin-top-2em" id="tambah-berita" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo">Tambah Berita</button>
    </div>
    <?php
        }
    ?>

    <div class="container margin-top-2em height-content">
        <div class="row">
            <div class="col-sm-9 margin-top-1em berita-big-list">
                <h3>Berita</h3>
                <hr class="line">
                <div class="list">
                </div>
            </div>
            
            <!-- LIST Berita -->
            <div class="col-sm-3 berita-small-list margin-top-1em">
                <h3>List Berita</h3>
                <hr class="line">
                <div class="no-list text-center italic">List Kosong</div>
                <div class="list">
                    
                </div>
                <div class="text-center">
                    <ul class="pagination">
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul>
                </div>
            </div>
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

<!-- FORM TAMBAH BERITA -->
<div class="modal fade text-center" id="tambahform" role="dialog">
    <div class="tambah-form">
        <div class="exit text-right">
            <a id="tambah" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <form class="form-horizontal" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_berita/do_upload"; ?>">
            <input type="hidden" name="idBerita" id="idBerita"><label class="control-label"><h3 class="font-bold">TAMBAH BERITA</h3></label>
            <div class="text-left form-group">
                <label class="control-label">Judul</label>
                <input type="text" class="form-control" placeholder="Judul Berita" name="judulBerita" id="judulBerita" required>
            </div>
            <div class="text-left form-group">
                <label class="control-label">Isi</label>
                <textarea id="summernote" name="isiBerita" required></textarea>
                <script>
                </script>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <button type="submit" class="btn btn-default">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- FORM DELETE BERITA -->
<div class="modal fade text-center" id="deleteform" role="dialog">
    <div class="delete-form">
        <div class="exit text-right">
            <a id="delete" data-toggle="modal" data-target="#deleteform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <form class="form-horizontal" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_beranda/delete"; ?>">
            <label id="labelDelete" class="control-label"><h3 class="font-bold">DELETE BERITA</h3></label>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <label class="message">Apakah Anda yakin ingin menghapus </label>
                    <label class="delete-judul-berita"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <button type="submit" class="btn btn-default" id="confirm-delete" onclick="confirmDelete(event,this)">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="repo">
    <div class="isloggedin">    
        <?php
        if($this->session->userdata('username'))
        {
            echo "1";
        }else{
            echo "0";
        }
        ?>
    </div>
</div>

<script>
    loadBerita();
</script>

<?php 
$this->load->view('v_footer');
?>
