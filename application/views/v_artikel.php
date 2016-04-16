<?php 
$this->load->view('v_header', array('nav_artikel'=>"active"));
?>

<script type="text/javascript" src='<?php echo assets()."js/v_artikel.js"; ?>'></script>

<div class="wrap-content">
    <?php
        if($this->session->userdata('username'))
        {
    ?>
    <div class="container">
        <button type="button" class="btn margin-top-2em" id="tambah-artikel" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo">Tambah Artikel</button>
    </div>
    <?php
        }
    ?>

    <div class="container height-content">
        <div class="row">
            <div class="col-sm-9 margin-top-1em artikel-big-list">
                <h3>Artikel</h3>
                <hr class="line">
                <div class="list">
                </div>
            </div>
            
            <!-- LIST ARTIKEL -->
            <div class="col-sm-3 artikel-small-list margin-top-1em">
                <h3>List Artikel</h3>
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


<!-- FORM TAMBAH ARTIKEL -->
<div class="modal fade text-center" id="tambahform" role="dialog">
    <div class="tambah-form">
        <div class="exit text-right">
            <a id="tambah" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <form class="form-horizontal" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_artikel/do_upload"; ?>">
            <input type="hidden" name="idArtikel" id="idArtikel"><label class="control-label"><h3 class="font-bold">TAMBAH ARTIKEL</h3></label>
            <div class="text-left form-group">
                <label class="control-label">Judul</label>
                <input type="text" class="form-control" placeholder="Judul Artikel" name="judulArtikel" id="judulArtikel" required>
            </div>
            <div class="text-left form-group">
                <label class="control-label">Isi</label>
                <textarea id="summernote" name="isiArtikel" required></textarea>
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

<!-- FORM DELETE ARTIKEL -->
<div class="modal fade text-center" id="deleteform" role="dialog">
    <div class="delete-form">
        <div class="exit text-right">
            <a id="delete" data-toggle="modal" data-target="#deleteform" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <form class="form-horizontal" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_artikel/delete"; ?>">
            <label id="labelDelete" class="control-label"><h3 class="font-bold">DELETE ARTIKEL</h3></label>
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <label class="message">Apakah Anda yakin ingin menghapus </label>
                    <label class="delete-judul-artikel"></label>
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
    loadArtikel();
</script>

<?php 
$this->load->view('v_footer');
?>