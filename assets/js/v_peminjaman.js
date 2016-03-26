$(document).ready(function()
{
    //Line 5 - 11 adalah code untuk mengeset default value INPUT MONTH
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
                    }
        });
    });
    
    $(document).on("click", "#modalTambahData", function(){
        date = year + "-" + month + "-" + day;
        $('#waktuModal').val(date);
        $("#submitTambahPeminjaman").prop('disabled', true);
         
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/lihat_penanggungjawab',
            success  : function(data)
                     {
                         $("#selectPJ").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                         $("#selectPJ").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                     }
         });
     });
    
    $(document).on("click", ":radio", function(){
       $("#submitTambahPeminjaman").prop('disabled', false);            
    });
    
    $(document).on("click", "#submitTambahPeminjaman", function(){
        var alatPeminjaman = "";
        var bykCheck = $(':checkbox:checked').length;
        $(':checkbox:checked').each(function(index){
            alatPeminjaman = alatPeminjaman + $(this).val();
            if(index != bykCheck-1)
                alatPeminjaman = alatPeminjaman + ",";
        });
        
        $.ajax({
            type     : 'POST',
            url      : 'http://localhost/pendeta_universitas/index.php/c_peminjaman/tambah_peminjaman',
            data     : {waktuModal: $("#waktuModal").val(),
                        waktuSearch: $("#waktuSearch").val(),
                        ruang: $(":radio:checked").val(),
                        alat: alatPeminjaman,
                        keterangan: $("#keterangan").val(),
                        penanggungJawab: $( "#selectPJ option:selected").val()
                       },
            success  : function(data)
            {
                //console.log(data);
                $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                $(":radio:checked").attr('checked', false);
                $(':checkbox:checked').each(function(){
                    $(this).attr('checked', false);
                });
                $("#keterangan").val("");
            }
        });
    });

})