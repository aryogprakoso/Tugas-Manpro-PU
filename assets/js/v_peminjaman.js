$(document).ready(function()
{
    //Line 5 - 11 adalah code untuk mengeset default value INPUT MONTH
    //dengan ID 'waktu' menjadi bulan ini
    var date = new Date();
    var month = date.getMonth() + 1;
    if(month < 10) 
        month = "0" + month;
    var year = date.getYear() + 1900;
    date = year + "-" + month;
    $('#waktu').val(date);
    
    //AJAX untuk load page awal, tabel langsung meload semua data yang ada sesuai dengan data BULAN INI 
    $.ajax({
        type        : 'POST',
        url         : 'http://localhost/pendeta_universitas_2.0/index.php/c_peminjaman/lihat_data',
        data        : {waktu: $("#waktu").val()},       //Value - value yang dilempar ke url yang ditunjuk
        success     : function(data)
                    {
                        $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                        $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                    }
    });
    
    //AJAX untuk INPUT MONTH dengan ID 'waktu' berubah valuenya, tabel menghapus dan meload semua data seuai dengan BULAN YANG DIPILIH
    $(document).on("change", "#waktu", function(){
        $.ajax({
           type     : 'POST',
           url      : 'http://localhost/pendeta_universitas_2.0/index.php/c_peminjaman/lihat_data',
           data     : {waktu: $("#waktu").val()},       //Value - value yang dilempar ke url yang ditunjuk
           success  : function(data)
                    {
                        $("#tableBody").empty();        //Mengosongkan semua element yang ada didalam ID tableBody
                        $("#tableBody").append(data)    //Memasukkan semua element yang ada kedalam ID tableBody
                    }
        });
    });
})