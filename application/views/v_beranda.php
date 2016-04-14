<?php 
$this->load->view('v_header', array('nav_beranda'=>"active"));
?>

<div class="wrap">
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
            <div class="item active container display-img text-center">
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
    </div>

    <div class="container margin-top-2em">
        <button type="button" class="btn margin-top-2em" id="tambah-berita" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo">Tambah Berita</button>
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
                    <input type="text" class="form-control" placeholder="Judul Berita" name="judulBerita" id="judulBerita">
                </div>
                <div class="text-left form-group">
                    <label class="control-label">Isi</label>
                    <textarea id="summernote" name="isiBerita"></textarea>
                    <script>
                        $(document).ready(function() {
                            $('#summernote').summernote({
                                height: 173,
                                minHeight: 173,
                                maxHeight: 500,
                                focus: true,
                                toolbar: [
                                    // [groupName, [list of button]]
                                    ['style', ['bold', 'italic', 'underline', 'clear']],
                                    ['font', ['strikethrough', 'superscript', 'subscript']],
                                    ['fontsize', ['fontsize']],
                                    ['color', ['color']],
                                    ['para', ['style', 'ul', 'ol', 'paragraph']],
                                    ['height', ['height']],
                                    ['table', ['table']],
                                    ['insert', ['picture', 'link', 'hr']],
                                    ['misc', ['undo', 'redo', 'help']]
                                ],
                                disableDragAndDrop: true,
                                image: [
                                    ['maximumFileSize',['100kb']] ,
                                    ['maximumFileSizeError', ['Maximum file size exceeded.']]
                                ]
                            });
                        });
                    </script>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-12">
                        <label class="error-message">[Error Message]</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-12">
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container margin-top-2em">
        <div class="row">
            <div class="col-sm-8">
                <h2>Berita Terbaru</h2>
                <hr class="line">
                <div>
                    <span class="text-center"><h1 class="font-bold"><a href="http://localhost/pendeta_universitass/index.php/c_berita">Hello World!</a></h1></span>
                    <span class="text-center"><h5 class="italic">Selasa, 5 April 2016</h5></span>
                    <br>
                    <span><p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="http://localhost/pendeta_universitass/index.php/c_berita" class="link">Baca Selengkapnya >></a>
                    </p></span>
                    <!--
                    <div class="text-right">
                        <a id="edit" data-toggle="modal" data-target="#editform" data-whatever="@mdo"><span class="glyphicon glyphicon-edit point icon-glyphicon"></span></a>
                        <a id="delete" data-toggle="modal" data-target="#deleteform" data-whatever="@mdo"><span class="glyphicon glyphicon-trash point icon-glyphicon"></span></a>
                    </div>
                    -->
                </div>
            </div>

            <!-- LIST BERITA -->
            <div class="col-sm-4">
                <h3>List Berita</h3>
                <hr class="line">
                <div class="margin-top-2em">
                    <span class="text-center"><h4 class="font-bold"><a href="#">Hello World!</a></h3></span>
                    <span class="text-center"><h6 class="italic">Selasa, 5 April 2016</h5></span>
                    <span><p class="paragraph size-12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#" class="link">Baca Selengkapnya >></a>
                    </p></span>
                </div>
                <div class="margin-top-2em">
                    <span class="text-center"><h4 class="font-bold"><a href="#">Hello World!</a></h3></span>
                    <span class="text-center"><h6 class="italic">Selasa, 5 April 2016</h5></span>
                    <span><p class="paragraph size-12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#" class="link">Baca Selengkapnya >></a>
                    </p></span>
                </div>
                <div class="margin-top-2em">
                    <span class="text-center"><h4 class="font-bold"><a href="#">Hello World!</a></h3></span>
                    <span class="text-center"><h6 class="italic">Selasa, 5 April 2016</h5></span>
                    <span><p class="paragraph size-12px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <a href="#" class="link">Baca Selengkapnya >></a>
                    </p></span>
                </div>
                <div class="text-center">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>