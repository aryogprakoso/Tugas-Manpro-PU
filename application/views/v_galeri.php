<?php 
$this->load->view('v_header', array('nav_galeri'=>"active"));
?>

<script type="text/javascript" src='<?php echo assets()."jquery-2.2.1.js"; ?>'></script>
<script type="text/javascript" src='<?php echo assets()."js/v_galeri.js"; ?>'></script>

<!-- GALERI VIEW -->
<div class="modal fade text-center" id="galeri" role="dialog" >
    <div class="galeri">
        <div class="exit text-right">
            <a id="galeri" data-toggle="modal" data-target="#galeri" data-whatever="@mdo" ><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <div class="text-center">
            <img id="imagebesar"  class="img-thumbnail">
            <label id="labelbesar" class="control-label"></label>
        </div>
    </div>
</div>

        <?php if (isset($success)) { echo $success; } ?>
<!-- TAMBAH FOTO -->
<div class="modal fade text-center" id="tambahfoto" role="dialog">
    <div class="tambah-foto">
        <div class="exit text-right">
            <a id="tambah" data-toggle="modal" data-target="#tambahfoto" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <form class="form-horizontal" enctype="multipart/form-data" id="form" accept-charset="utf-8" method="post" action="<?php echo base_url()."index.php/c_galeri/do_upload"; ?>">
            <label class="control-label"><h3 class="font-bold">UPLOAD FOTO</h3></label>
            <div class="text-left form-group">
                <label class="control-label">Deskripsi Foto</label>
                <input type="text" class="form-control" placeholder="Deskripsi Foto" name="keteranganGambar" id="deskripsiFoto">
            </div>
            <div class="text-left form-group">
                <label class="control-label">Pilih Foto</label>
                <input type="file" name="userfile">
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <?php if (isset($error)) { echo $error; } ?></span>
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

<!-- DELETE FOTO -->
<div class="modal fade text-center" id="deletefoto" role="dialog" >
    <div class="delete-foto">
        <div class="exit text-right">
            <a id="deletefoto" data-toggle="modal" data-target="#deletefoto" data-whatever="@mdo"><span class="glyphicon glyphicon-remove point"></span></a>
        </div>
        <div class="text-center">
            <label class="control-label"><h4 class="font-bold">HAPUS FOTO</h4></label>
        </div>
        <div class="text-center"> 
            <img id="imagedelete"  class="img-thumbnail">
            <br><br><label id="labeldelete" class="control-label"></label><br>
        </div>
        <div class="col-sm-offset-0 col-sm-12">
            <a id="btndelete" class="btn">Hapus</a>            
        </div>
    </div>
</div>

    <?php
        if($this->session->userdata('username'))
        {
    ?>
<!-- VIEW ALL FOTO -->
<div class="container">
    <button type="button" class="btn margin-top-2em" id="tambahfoto" data-toggle="modal" data-target="#tambahfoto" data-whatever="@mdo">UPLOAD FOTO</button>
</div>
    <?php
        }
    ?>

<div class="container margin-top-3em text-center galeri-thumb-container height-content">
            <?php
                $foto=0;
                $maxrow=4;
                foreach($data as $row) 
                {
                    if($foto<$maxrow){
            ?>

            <div class="galeri-thumb col-md-3 col-sm-4 col-xs-6">
                <div data-toggle="modal" class="div-img-galeri galeriview" data-target="#galeri" data-whatever="@mdo">
                    <div class="photo" style="background-image: url('<?php echo base_url('assets/uploads/'. $row['pathGambar']);?>')"></div>
                    <img src="<?php echo base_url('assets/uploads/'. $row['pathGambar']) ?>" class="img-thumbnail point">
                    <label class="labeltemp" style="display:none"><?php echo $row['keteranganGambar']; ?></label>
                    <div class="col-sm-offset-0 col-sm-12">
                        <a class="btn" style="display:none" href="<?php echo site_url("c_galeri/delete/".$row['idGaleri']);?>"></a>
                    </div>
                </div>
                    <?php
                        if($this->session->userdata('username'))
                        {
                    ?>
                <div class="text-right">    
                    <a class="deleteview" data-toggle="modal" data-target="#deletefoto" data-whatever="@mdo"><span class="glyphicon glyphicon-trash point icon-glyphicon"></span></a>
                </div>
                    <?php
                        }
                    ?>
            </div>
                    
            <?php 
                $foto+=1;

                }
                    else{
            ?>
            
            <div class="galeri-thumb col-md-3 col-sm-4 col-xs-6">
                <div data-toggle="modal" class="div-img-galeri galeriview" data-target="#galeri" data-whatever="@mdo">
                    <div class="photo" style="background-image: url('<?php echo base_url('assets/uploads/'. $row['pathGambar']);?>')"></div>
                    <img src="<?php echo base_url('assets/uploads/'. $row['pathGambar']) ?>" class="img-thumbnail point">
                    <label class="labeltemp" style="display:none"><?php echo $row['keteranganGambar']; ?></label>
                    <div class="col-sm-offset-0 col-sm-12">
                        <a class="btn" style="display:none" href="<?php echo site_url("c_galeri/delete/".$row['idGaleri']);?>"></a>
                    </div>
                </div>
                    <?php
                        if($this->session->userdata('username'))
                        {
                    ?>
                <div class="text-right">    
                    <a class="deleteview" data-toggle="modal" data-target="#deletefoto" data-whatever="@mdo"><span class="glyphicon glyphicon-trash point icon-glyphicon"></span></a>
                </div>
                    <?php
                        }
                    ?>
            </div>
        
        <?php
            $foto=1;        
            }
        }
        ?>
</div>
        

    <div class="text-center margin-top-5em">
        <ul class="pagination"> 
            <li class="prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>
            <li class="page"><a class= "current" href="#">1 <span class="sr-only">&nbsp;</span></a></li>
            <li class="page"><a href="#">2</a></li>
            <li class="page"><a href="#">3</a></li>
            <li class="page"><a href="#">4</a></li>
            <li class="page"><a href="#">5</a></li>
            <li class="next">
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&rarr;</span>
                </a>
    <!-- Show pagination links -->
    <?php 
        // foreach ($links as $link) {
        //     echo "<li>". $link."</li>";
        // } 
    ?>
            </li>
        </ul>
    </div>

<?php 
$this->load->view('v_footer');
?>
