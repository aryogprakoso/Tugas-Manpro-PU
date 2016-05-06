$(document).ready(function() {
    $('#tambah-artikel').click(function(){
        $('.tambah-form .control-label h3').html('TAMBAH ARTIKEL');
        $('#form').attr('action','c_artikel/do_upload');
        $('#judulArtikel').val("");
        $('#summernote').text('')
        $('#summernote').summernote('code','',{
            height: 173,
            minHeight: 220,
            maxHeight: 220,
            focus: true,
            callbacks:{
                onPaste: function(e){
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            },
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
    })
    $('#summernote').summernote({
        height: 173,
        minHeight: 220,
        maxHeight: 220,
        focus: true,
        callbacks:{
            onPaste: function(e){
                console.log(3)
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        },
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

function setEdit(event,element){
    event.preventDefault();
    var id = $(element).attr('data-id');
    $('.tambah-form .control-label h3').html('EDIT ARTIKEL');
    
    $.ajax({
        url: "c_artikel/load_data/"+id,
        success: function(data){
            data = JSON.parse(data)
            if(data.length == 0){
                console.log("gagal");
            }else{
                $('#form').attr('action','c_artikel/do_edit');
                $('#idArtikel').val(data[0].idArtikel);
                $('#judulArtikel').val(data[0].judulArtikel);
                $('#summernote').summernote('code',data[0].isiArtikel,{
                    height: 173,
                    minHeight: 173,
                    maxHeight: 500,
                    focus: true,
                    callbacks:{
                        onPaste: function(e){
                            console.log(3)
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            document.execCommand('insertText', false, bufferText);
                        }
                    },
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
                });
            }
        },
        error: function(){
            
        }
    })
}

var deleteID;
function setDelete(event,element){
    event.preventDefault();
    var id = $(element).attr('data-id');
    var number = $(element).attr('data-number');
    deleteID = id;
    console.log(globalArtikel[id])
    $('.delete-judul-artikel').html("artikel: "+globalArtikel[number].judulArtikel);
    
}

function confirmDelete(event, element){
    event.preventDefault();
    $.ajax({
        url: "c_artikel/delete",
        type: "POST",
        data: {idArtikel:deleteID},
        success: function(data){
            var status = JSON.parse(data);
            if(status.status=="success"){
                loadArtikel();
                $('#global-notification').html('<div class="alert alert-success text-center" role="alert">'+ status.message +'</div>');
                $(element).parents('.modal').modal("hide");
            }
            else if(status.status == "gagal"){
                $('#global-notification').html('<div class="alert alert-danger text-center" role="alert">'+ status.message +'</div>');
                $(element).parents('.modal').modal("hide");
            }
            data = JSON.parse(data);
        },
        error: function(error){
            console.log(error);
            $('#global-notification').html('<div class="alert alert-danger text-center" role="alert">'+"Telah terjadi kesalahan pada sistem. Silahkan refresh"+'</div>');
            $('#deleteform').modal('hide');
        }
    })
}

var globalArtikel = [];
var globalArtikelNumber = 0;
var globalPageNumber = 1;
var isLoggedIn = false;

function loadArtikel(){
    isLoggedIn = $('#repo>.isloggedin').html().trim()=="1";
    $.ajax({
        url: "c_artikel/getlist",
        type: "GET",
        success: function(data){
            data = JSON.parse(data);
            globalArtikel = data.artikel;
            if(data.status == "success"){
                populateArtikel()
            }
            else if(data.status == "error"){
                //kasii div bwt error message
                console.log(data.message());
            }
        },
        error: function(){
            
        }
        
    })
}

function populateArtikel(){
    //isi artikel big list
    
    var bigList = $(".artikel-big-list .list");
    bigList.html("");
    if(globalArtikel.length>0 && globalArtikel.length <= globalArtikelNumber){
        globalArtikelNumber = 0;
    }
    if(globalArtikel.length>globalArtikelNumber){
        bigList.append(createArtikelDiv(globalArtikel[globalArtikelNumber],globalArtikelNumber));
    }
    //isi artikel small list
    var artikelPerPage = 10;
    var smallList = $(".artikel-small-list .list");
    smallList.html("")
    var pagenumber = 1;
    var pagecontent = 0;
    var currentpage = createArtikelPage();
    currentpage.attr('data-pagenumber',pagenumber);
    
    var maxpage = globalArtikel.length / artikelPerPage + 1;
    if(globalPageNumber > maxpage){
        globalPageNumber = 1;
    }
    
    for(var i = 0; i<globalArtikel.length; i++){
        if(pagecontent>=artikelPerPage){
            smallList.append(currentpage);
            currentpage = createArtikelPage();
            pagecontent = 0;
            currentpage.attr('data-pagenumber',pagenumber);
            pagenumber++;
        }
        currentpage.append(createListDiv(globalArtikel[i],i));
        pagecontent++;
    }
    smallList.append(currentpage);
    currentpage.attr('data-pagenumber',pagenumber);
    pagenumber++;
    
    var paginationbullet = $('.artikel-small-list').find('ul.pagination');
    paginationbullet.html("");
    if(pagecontent!=0){
        $('.no-list').hide();
        $('.pagination').show();
        for(var i = 1; i< pagenumber; i++){
            if(i==globalPageNumber){
                paginationbullet.append($('<li class="active"><a href="#" onclick="artikelSwitchPage(event,this)" data-pagenumber="'+i+'">'+i+'</a></li>'));
            }
            else{
                paginationbullet.append($('<li><a href="#" onclick="artikelSwitchPage(event,this)" data-pagenumber="'+i+'">'+i+'</a></li>'));
            }
        }
        $("a[data-pagenumber="+globalPageNumber+"]").click()
    }
    else if(pagecontent==0){
        $('.pagination').hide();
        $('.no-list').show();
    }
}

function artikelSwitchPage(event,element){
    event.preventDefault();
    var pagenumber = $(element).attr('data-pagenumber');
    globalPageNumber = pagenumber;
    $('.artikel-small-list ul.pagination li').removeClass('active');
    $(".artikel-small-list .list .artikel-small-page").removeClass('active');
    $(element).parents('li').addClass('active');
    $(".artikel-small-list .list .artikel-small-page[data-pagenumber='"+pagenumber+"']").addClass('active');
    
}

function createArtikelPage(){
    return $('<div class="artikel-small-page"></div>')
}

function createArtikelDiv(artikel,number){
    var container = $('<div class="margin-top-3em"></div>');
    
    //menampilkan button edit dan delete artikel
    
    if(isLoggedIn){
        var buttoncontainer = $('<div class="text-right buttoncontainer"></div>');
        var buttonedit = $('<a id="edit" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo" onclick="setEdit(event, this)" data-id="'+globalArtikel[number].idArtikel+'"><span class="glyphicon glyphicon-edit point icon-glyphicon"></span></a>');
        var buttondelete = $('<a id="delete" data-toggle="modal" data-target="#deleteform" data-whatever="@mdo" onclick="setDelete(event, this)" data-number="'+number+'" data-id="'+globalArtikel[number].idArtikel+'"><span class="glyphicon glyphicon-trash point icon-glyphicon"></span></a>');
            buttoncontainer.append(buttonedit)
            buttoncontainer.append(buttondelete)
        container.append(buttoncontainer)
    }
    
    //menampilkan judul artikel 
    container.append($('<span class="judulArtikel text-center"><h1>'+artikel.judulArtikel+'</h3></span>'));
    
    //menampilkan tanggal pembuatan artikel
    var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    
    var dateObj = new Date(artikel.waktu);
    
    var tanggal = dateObj.getDate();
    var _hari = dateObj.getDay();
    var _bulan = dateObj.getMonth();
    var _tahun = dateObj.getYear();
    
    var hari = hari[_hari];
    var bulan = bulan[_bulan];
    var tahun = (_tahun<1000) ? _tahun + 1900 : _tahun;
    
    var date = hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun;
    //var date = new Date(artikel.waktu);
    container.append($('<span class="text-center date"><h5 class="italic">'+date+'</h5></span>')) ;
    container.append($('<br>'));
    
    //menampilkan isi artikel
    var paragraph = $('<p class=""></p>');
        paragraph.html(artikel.isiArtikel);
    
    var paragraphspan = $('<span></span>');
        paragraphspan.html(paragraph);
    
    container.append(paragraphspan);
    
    return container;
}

function createListDiv(artikel,number){
    var container = $('<div class="margin-top-3em"></div>');
    //judul
    container.append($('<span class="judulArtikel text-center"><h1><a href="#" onclick="switchArtikel(event,this)" data-number="'+number+'">'+artikel.judulArtikel+'</a></h3></span>'));
    var date = new Date(artikel.waktu);
    container.append($('<span class="text-center date"><h5 class="italic">'+date+'</h5></span>')) ;
    container.append($('<br>'));
    
    return container;
}

function switchArtikel(event,element){
    event.preventDefault();
    var number = $(element).attr('data-number')
    if(number==globalArtikelNumber){
        return;
    }
    globalArtikelNumber = number;
    populateArtikel();
}