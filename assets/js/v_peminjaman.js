$(document).ready(function()
{
    //Line 5 - 14 adalah code untuk mengeset default value INPUT MONTH
    //dengan ID 'waktu' menjadi bulan ini
    var date = new Date();
    var day = date.getDate();
    if(day < 10)
        day = "0" + day;
    var month = date.getMonth() + 1;
    if(month < 10) 
        month = "0" + month;
    var year = date.getYear() + 1900;
    date = year + "-" + month;
    $('#waktuSearch').val(date);
    
    $('#info').hide();
    
    var ruangClick = false;
    var bisaTambahEdit = false;
    var tampID;         //this.id -> idPeminjaman database
    
    //menampilkan datepicker Jquery pada input dengan id waktuModalTambah
    $('#waktuModalTambah').datepicker({
          dateFormat: 'dd-mm-yy',
    });
    
    //menampilkan datepicker Jquery pada input dengan id waktuModalEdit
    $('#waktuModalEdit').datepicker({
          dateFormat: 'dd-mm-yy',
    });
    
    //AJAX untuk load page awal, tabel langsung meload semua data yang ada sesuai dengan data BULAN INI 
    $.ajax({
        type        : 'POST',
        url         : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/lihat_peminjaman',
        data        : {waktu: $("#waktuSearch").val()},       //Value - value yang dilempar ke url yang ditunjuk
        success     : function(data)
                    {
                        $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                        $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                    }
    });
    
    //AJAX untuk INPUT MONTH dengan ID 'waktu' berubah valuenya, tabel menghapus dan meload semua data seuai dengan BULAN YANG DIPILIH
    $(document).on("change", "#waktuSearch", function(){
        $.ajax({
           type     : 'POST',
           url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/lihat_peminjaman',
           data     : {waktu: $("#waktuSearch").val()},       //Value - value yang dilempar ke url yang ditunjuk
           success  : function(data)
                    {
                        $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                        $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                        $("#jarak").show();
                        $("#info").hide();
                    }
        });
    });
    
    //Fungsi dibawah ini digunakan untuk menampilkan Modal konfirmasi penghapusan Data Peminjaman
    $(document).on("click", ".hapus", function(){
        //tanggal digunakan untuk menampung value dari Kolom Tanggal dan Baris yang sama dengan Button Hapus diKlik 
        var tanggal = $(this).closest('tr').find('td').eq(0).html();
        
        //jamMenitMulai digunakan untuk menampung value dari Kolom Mulai dan Baris yang sama dengan Button Hapus diKlik
        var jamMenitMulai = $(this).closest('tr').find('td').eq(1).html();
        
        //jamMenitSelesai digunakan untuk menampung value dari Kolom Akhir dan Baris yang sama dengan Button Hapus diKlik
        var jamMenitSelesai = $(this).closest('tr').find('td').eq(2).html();
        
        //ruang digunakan untuk menampung value dari Kolom Ruang dan Baris yang sama dengan Button Hapus diKlik
        var ruang = $(this).closest('tr').find('td').eq(3).html();
        
        //alat digunakan untuk menampung value dari Kolom Alat dan Baris yang sama dengan Button Hapus diKlik
        var alat = $(this).closest('tr').find('td').eq(4).html();
        
        //PJ digunakan untuk menampung value dari Kolom Penanggung Jawab dan Baris yang sama dengan Button Hapus diKlik
        var PJ = $(this).closest('tr').find('td').eq(5).html();
        
        //keterangan digunakan untuk menampung value dari Kolom Keterangan dan Baris yang sama dengan Button Hapus diKlik
        var keterangan = $(this).closest('tr').find('td').eq(6).html();
        
        //masukkan semua variabel2 tampungan diatas sesuai dengan keterangan masing masing
        $('#keteranganTanggalHapusPeminjaman').text("Tanggal : " + tanggal);
        $('#keteranganMulaiHapusPeminjaman').text("Mulai Jam : " + jamMenitMulai);
        $('#keteranganSelesaiHapusPeminjaman').text("Selesai Jam : " + jamMenitSelesai);
        $('#keteranganRuangHapusPeminjaman').text("Tempat Di : " + ruang);
        $('#keteranganAlatHapusPeminjaman').text("Alat - Alat : " + alat);
        $('#keteranganPJHapusPeminjaman').text("Penanggung Jawab : " + PJ);
        $('#keteranganHapusPeminjaman').text("Keterangan : " + keterangan);
        
        tampID = this.id;    //simpan idPeminjaman yang ada di button hapus ke tampID 
    });
    
    $(document).on("click", ".ubah", function(){
        //tanggal digunakan untuk menampung value dari Kolom Tanggal dan Baris yang sama dengan Button Ubah diKlik
        //lalu tanggal dimasukkan ke input dengan id waktuModalEdit
        var tanggal = $(this).closest('tr').find('td').eq(0).html();
        $('#waktuModalEdit').val(tanggal);
        
        //jamMenitMulai digunakan untuk menampung value dari Kolom Mulai dan Baris yang sama dengan Button Ubah diKlik
        //jamMenitMulai menghasilkan format HH:ii, Maka harus dipisahkan dulu menggunakan split(':')
        //hasil dari split adalah array of string
        var jamMenitMulai = $(this).closest('tr').find('td').eq(1).html().split(':');
        
        //jamMulai adalah string jamMenitMulai[0], karena input number membutuhkan number
        //maka harus dikonversi ke Int dulu menggunakan parseInt
        var jamMulai = parseInt(jamMenitMulai[0]);
        $('#jamMulaiEdit').val(jamMulai);
        
        //menitMulai adalah string jamMenitMulai[1], karena input number membutuhkan number
        //maka harus dikonversi ke Int dulu menggunakan parseInt
        var menitMulai = parseInt(jamMenitMulai[1]);
        $('#menitMulaiEdit').val(menitMulai);
        
        //jamMenitSelesai digunakan untuk menampung value dari Kolom Selesai dan Baris yang sama dengan Button Ubah diKlik
        //jamMenitSelesai menghasilkan format HH:ii, Maka harus dipisahkan dulu menggunakan split(':')
        //hasil dari split adalah array of string
        var jamMenitSelesai = $(this).closest('tr').find('td').eq(2).html().split(':');
        
        //jamSelesai adalah string jamMenitSelesai[0], karena input number membutuhkan number
        //maka harus dikonversi ke Int dulu menggunakan parseInt
        var jamSelesai = parseInt(jamMenitSelesai[0]);
        $('#jamSelesaiEdit').val(jamSelesai);
        
        //menitSelesai adalah string jamMenitSelesai[1], karena input number membutuhkan number
        //maka harus dikonversi ke Int dulu menggunakan parseInt
        var menitSelesai = parseInt(jamMenitSelesai[1]);
        $('#menitSelesaiEdit').val(menitSelesai);
        
        //ruang digunakan untuk menampung value dari Kolom Ruang dan Baris yang sama dengan Button Ubah diKlik
        var ruang = $(this).closest('tr').find('td').eq(3).html();
        
        //Jika ruang == Kapel Atas, maka radio Button dengan value Kapel Atas dichecked
        if(ruang == "Kapel Atas")
            $("input[type='radio'][value='Kapel Atas']").attr("checked", true);
        
        //Jika ruang == Kapel Bawah, maka radio Button dengan value Kapel Bawah dichecked
        else
            $("input[type='radio'][value='Kapel Bawah']").attr("checked", true);
        
        //alat digunakan untuk menampung value dari Kolom Alat dan Baris yang sama dengan Button Ubah diKlik
        //alat menghasilkan format HH:ii, Maka harus dipisahkan dulu menggunakan split(':')
        //hasil dari split adalah array of string
        var alat = $(this).closest('tr').find('td').eq(4).html().split(',');
        for(var i=0; i<alat.length; i++)
            $("input[type='checkbox'][value='" + alat[i] + "']").attr("checked", true);
        
        var PJ = $(this).closest('tr').find('td').eq(5).html();
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/lihat_penanggungjawab',
            success  : function(data)
                     {
                         $("#selectPJEdit").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                         $("#selectPJEdit").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                     }
         });
        $("select[value='" + PJ + "']").attr("selected", true);
        
        var keterangan = $(this).closest('tr').find('td').eq(6).html();
        $("#keteranganEdit").val(keterangan);
        var jumlahHuruf = $("#keteranganEdit").val().length;
        $("#sisaHurufEdit").html(200 - jumlahHuruf);
        
        //$("#submitEditPeminjaman").attr('disabled', true);
        
        tampID = this.id;
    });
    
    $(document).on("click", "#modalTambahData", function(){
        date = day + "-" + month + "-" + year;
        $('#waktuModalTambah').val(date);
        $("#submitTambahPeminjaman").prop('disabled', true);
        $("#sisaHurufTambah").html("200");
         
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/lihat_penanggungjawab',
            success  : function(data)
                     {
                         $("#selectPJTambah").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                         $("#selectPJTambah").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                     }
         });
     });
    
    $(document).on("click", ":radio", function(){
        $ruangClick = true;
        if($ruangClick)
            $("#submitTambahPeminjaman").prop('disabled', false);
    });
    
    $(document).on("keyup", "#keteranganTambah", function(){
        $sisa = 200 - $("#keteranganTambah").val().length;
        $("#sisaHurufTambah").html($sisa);
    });
    
    $(document).on("keydown", "#keteranganTambah", function(){
        $sisa = 200 - $("#keteranganTambah").val().length;
        $("#sisaHurufTambah").html($sisa);
    });
    
    $(document).on("keyup", "#keteranganEdit", function(){
        $sisa = 200 - $("#keteranganEdit").val().length;
        $("#sisaHurufEdit").html($sisa);
    });
    
    $(document).on("keydown", "#keteranganEdit", function(){
        $sisa = 200 - $("#keteranganEdit").val().length;
        $("#sisaHurufEdit").html($sisa);
    });
    
    $(document).on("click", "#submitTambahPeminjaman", function(){
        var alatPeminjaman = "";
        var bykCheck = $('.tambah :checkbox:checked').length;
        $('.tambah :checkbox:checked').each(function(index){
            alatPeminjaman = alatPeminjaman + $(this).val();
            if(index != bykCheck-1)
                alatPeminjaman = alatPeminjaman + ",";
        });
        console.log("asdasda");
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/tambah_peminjaman',
            data     : {waktuModal: $("#waktuModalTambah").val(),
                        waktuSearch: $("#waktuSearch").val(),
                        jamMulai: $("#jamMulaiTambah").val(),
                        menitMulai: $("#menitMulaiTambah").val(),
                        jamSelesai: $("#jamSelesaiTambah").val(),
                        menitSelesai: $("#menitSelesaiTambah").val(),
                        ruang: $(".tambah :radio:checked").val(),
                        alat: alatPeminjaman,
                        keterangan: $("#keteranganTambah").val(),
                        penanggungJawab: $( "#selectPJTambah option:selected").val()
                       },
            success  : function(data)
            {
                $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                $(".tambah :radio:checked").attr("checked", false);
                $(".tambah :checkbox:checked").each(function(){
                    $(this).attr("checked", false);
                });
                $("#keteranganTambah").val("");
                $("#jarak").hide();
                $("#info").html("Tambah Data Peminjaman Berhasil Dilakukan");
                $("#info").show();
            }
        });
    });
    
    $(document).on("click", "#submitHapusPeminjaman", function(){
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/hapus_peminjaman',
            data     : {idHapus: tampID},
            success  : function(data)
            {
                $("#" + tampID).closest('tr').remove();
                $("#jarak").hide();
                $("#info").html("Hapus Data Peminjaman Berhasil Dilakukan");
                $("#info").show();
            }
        });
    });
    
    $(document).on("click", "#submitEditPeminjaman", function(){
        var alatPeminjaman = "";
        var bykCheck = $('.edit :checkbox:checked').length;
        $('.edit :checkbox:checked').each(function(index){
            alatPeminjaman = alatPeminjaman + $(this).val();
            if(index != bykCheck-1)
                alatPeminjaman = alatPeminjaman + ",";
        });
        
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/edit_peminjaman',
            data     : {waktuModalEdit: $("#waktuModalEdit").val(),
                        waktuSearch: $("#waktuSearch").val(),
                        jamMulaiEdit: $("#jamMulaiEdit").val(),
                        menitMulaiEdit: $("#menitMulaiEdit").val(),
                        jamSelesaiEdit: $("#jamSelesaiEdit").val(),
                        menitSelesaiEdit: $("#menitSelesaiEdit").val(),
                        ruangEdit: $(".edit :radio:checked").val(),
                        alatEdit: alatPeminjaman,
                        keteranganEdit: $("#keteranganEdit").val(),
                        penanggungJawabEdit: $( "#selectPJEdit option:selected").val(),
                        idEdit: tampID
                       },
            success  : function(data)
            {
                $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
            }
        });
    });

})