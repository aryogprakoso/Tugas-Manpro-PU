$(document).ready(function()
    {
        $('.galeriview').click(function(){
        var srcurl = $(this).find('img').attr('src');
        var labelimg = $(this).find('label').html();
            $('#imagebesar').attr('src',srcurl)
            $('#labelbesar').html(labelimg)
        })
    })


$(document).ready(function()
    {
        $('.deleteview').click(function(){
        var parent = $(this).parents('.col-md-3')
        var srcurl = parent.find('img').attr('src');
        var labelimg = parent.find('label').html();
        var btndlt = parent.find('a').attr('href');
            $('#imagedelete').attr('src',srcurl)
            $('#labeldelete').html(labelimg)
            $('#btndelete').attr('href',btndlt) 
        })
    })

$(document).on("click", "#tambahfoto", function(){
     $("#sisaHurufTambah").html("200");
 });

$(document).on("keyup", "#deskripsiFoto", function(){
        $sisa = 200 - $("#deskripsiFoto").val().length;
        $("#sisaHurufTambah").html($sisa);
});
    
$(document).on("keydown", "#deskripsiFoto", function(){
        $sisa = 200 - $("#deskripsiFoto").val().length;
        $("#sisaHurufTambah").html($sisa);
});
