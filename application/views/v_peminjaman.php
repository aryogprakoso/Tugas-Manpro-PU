<?php
$this->load->helper('assets_helper');
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$this->load->view('v_header', array('nav_peminjaman'=>"active"));
?>
<link href='<?php echo assets()."css/peminjaman.css" ?>' rel="stylesheet" type="text/css"/>
<script type="text/javascript" src='<?php echo assets()."js/v_peminjaman.js"; ?>'></script>

<div class="wrap-content height-content">
    <h2 class="text-center margin-top-2em">Jadwal Pemakaian Ruangan</h2>
    
    <!-- Input Tanggal -->
    <div class="text-center">
        <label>Bulan</label>
        <input type="month" id="waktuSearch" required="required"/>
    </div>
    
    <div class="row" id="jarak">a</div>
    
    <div class="container">
        <div class="text-center alert alert-success" id="info"></div>
    </div>
    
    <!-- Table -->
    <div class = "container table-responsive">
        <p class="text-center"><i id="keteranganTabel"></i></p>
        <table class="table table-bordered table-striped tabel-peminjaman">
            <thead>
              <tr>
                <th class = "text-center">Tanggal</th>
                <th class = "text-center">Mulai</th>
                <th class = "text-center">Selesai</th>
                <th class = "text-center">Ruang</th>
                <th class = "text-center">Alat</th>
                <th class = "text-center">Penanggung Jawab</th>
                <th class = "text-center">Keterangan</th>
                <?php
                if($this->session->userdata('username'))
                {
                ?>
                    <th class = "text-center">Action</th>
                <?php
                }
                ?>
              </tr>
            </thead>
            <tbody class="text-center" id="tableBody"></tbody>
        </table>
    </div>
    <?php
        if($this->session->userdata('username'))
        {
    ?>
    <!-- Button Tambah Peminjaman -->
    <div class="container">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTambahPeminjaman" id="modalTambahData">Tambah Data</button>
    </div>
    <?php
        }
    ?>
    
    <!-- Modal Tambah Peminjaman -->
    <div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" role="dialog" aria-labelledby="judulTambah" aria-hidden="true">
        <div class="modal-dialog tambah-peminjaman">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                       data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title text-center" id="judulTambah">
                        Tambah Data Peminjaman
                    </h4>
                    </div>

                <!-- Modal Body -->
                <div class="modal-body">

                      <div class="form-group">
                          <label class="col-sm-2">Tanggal:</label>
                          <div class="col-sm-5">
                            <input type="text" class="text-center" id="waktuModalTambah"/>
                          </div>
                          <label><small>(Format Tanggal = Hari-Bulan-Tahun)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Mulai:</label>
                          <div class="col-sm-4">
                            <input class="text-center" type="number" id="jamMulaiTambah" min="0" max="23" step="1" value="0"/>
                            <b>:</b>
                            <input class="text-center" type="number" id="menitMulaiTambah" min="-15" max="60" step="15" value="0"/>
                          </div>
                          <label><small>(Format Mulai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Selesai:</label>
                          <div class="col-sm-4">
                            <input class="text-center" type="number" id="jamSelesaiTambah" min="0" max="23" step="1" value="0"/>
                            <b>:</b>
                            <input class="text-center" type="number" id="menitSelesaiTambah" min="-15" max="60" step="15" value="15"/>
                          </div>
                          <label><small>(Format Selesai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Ruang:</label>
                          <div class="col-sm-5">
                                <label class="radio-inline tambah"><input type="radio" name="ruang" value="Kapel Atas">Kapel Atas</label>
                                <label class="radio-inline tambah"><input type="radio" name="ruang" value="Kapel Bawah">Kapel Bawah</label>
                          </div>
                          <label><small>(Pilih Salah Satu Ruang)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Alat:</label>
                          <div class="col-sm-8">
                                <label class="checkbox-inline tambah"><input type="checkbox" value="Alat Musik">Alat Musik</label>
                                <label class="checkbox-inline tambah"><input type="checkbox" value="Alat Peribadatan">Alat Peribadatan</label>
                                <label class="checkbox-inline tambah"><input type="checkbox" value="Alat Elektronik">Alat Elektronik</label>
                          </div>
                          <label><small>(Boleh Kosong)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-5">Keterangan: <small>(Sisa </small><small id="sisaHurufTambah"></small><small> Huruf)</small></label>
                          <textarea class="form-control" rows="3" id="keteranganTambah" maxlength="200"></textarea>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4">Penanggung Jawab:</label>
                          <select id="selectPJTambah"></select>
                      </div>
                      <div class="form-group text-center">
                          <div class="col-sm-offset-0 col-sm-12">
                              <label class="error-message" id="errorTambahPeminjaman"></label>
                          </div>
                      </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submitTambahPeminjaman"> Tambah Data </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Batal </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Hapus Peminjaman -->
    <div class="modal fade" id="modalHapusPeminjaman" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content hapus-peminjaman">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center">Hapus Data Peminjaman</h4>
          </div>
          <div class="modal-body text-center">
            <p>Apakah anda Yakin untuk menghapus Data Peminjaman dengan</p>
            <p><b id="keteranganTanggalHapusPeminjaman"></b></p>
            <p><b id="keteranganMulaiHapusPeminjaman"></b></p>
            <p><b id="keteranganSelesaiHapusPeminjaman"></b></p>
            <p><b id="keteranganRuangHapusPeminjaman"></b></p>
            <p><b id="keteranganAlatHapusPeminjaman"></b></p>
            <p><b id="keteranganPJHapusPeminjaman"></b></p>
            <p><b id="keteranganHapusPeminjaman"></b></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="submitHapusPeminjaman" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>
    
    <!-- Modal Edit Peminjaman -->
    <div class="modal fade" id="modalEditPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog edit-peminjaman">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title text-center" id="judulEdit">
                        Edit Data Peminjaman
                    </h4>
                    </div>

                <!-- Modal Body -->
                <div class="modal-body">

                      <div class="form-group">
                          <label class="col-sm-2">Tanggal:</label>
                          <div class="col-sm-5">
                            <input type="text" class="text-center" id="waktuModalEdit"/>
                          </div>
                          <label><small>(Format Tanggal = Hari-Bulan-Tahun)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Mulai:</label>
                          <div class="col-sm-4">
                            <input class="text-center" type="number" id="jamMulaiEdit" min="0" max="23" step="1" value="0"/>
                            <b>:</b>
                            <input class="text-center" type="number" id="menitMulaiEdit" min="-15" max="60" step="15" value="0"/>
                          </div>
                          <label><small>(Format Mulai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Selesai:</label>
                          <div class="col-sm-4">
                            <input class="text-center" type="number" id="jamSelesaiEdit" min="0" max="23" step="1" value="0"/>
                            <b>:</b>
                            <input class="text-center" type="number" id="menitSelesaiEdit" min="-15" max="60" step="15" value="15"/>
                          </div>
                          <label><small>(Format Selesai = Jam:Menit)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Ruang:</label>
                          <div class="col-sm-5">
                                <label class="radio-inline edit"><input type="radio" name="ruang" value="Kapel Atas">Kapel Atas</label>
                                <label class="radio-inline edit"><input type="radio" name="ruang" value="Kapel Bawah">Kapel Bawah</label>
                          </div>
                          <label><small>(Pilih Salah Satu Ruang)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2">Alat:</label>
                          <div class="col-sm-8">
                                <label class="checkbox-inline edit"><input type="checkbox" value="Alat Musik">Alat Musik</label>
                                <label class="checkbox-inline edit"><input type="checkbox" value="Alat Peribadatan">Alat Peribadatan</label>
                                <label class="checkbox-inline edit"><input type="checkbox" value="Alat Elektronik">Alat Elektronik</label>
                          </div>
                          <label><small>(Boleh Kosong)</small></label>
                          <div class="clearfix"></div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-5">Keterangan: <small>(Sisa </small><small id="sisaHurufEdit"></small><small> Huruf)</small></label>
                          <textarea class="form-control" rows="3" id="keteranganEdit" maxlength="200"></textarea>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4">Penanggung Jawab:</label>
                          <select id="selectPJEdit"></select>
                      </div>
                      <div class="form-group text-center">
                          <div class="col-sm-offset-0 col-sm-12">
                              <label class="error-message" id="errorEditPeminjaman"></label>
                          </div>
                      </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submitEditPeminjaman"> Edit Data </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Batal </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>