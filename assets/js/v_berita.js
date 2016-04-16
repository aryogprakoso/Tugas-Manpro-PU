$(document).ready(function() {
    $('#tambah-berita').click(function(){
        $('.tambah-form .control-label h3').html('TAMBAH BERITA');
        $('#form').attr('action','c_beranda/do_upload');
        $('#judulBerita').val("");
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
    $('.tambah-form .control-label h3').html('EDIT BERITA');
    
    $.ajax({
        url: "c_berita/load_data/"+id,
        success: function(data){
            data = JSON.parse(data)
            if(data.length == 0){
                console.log("gagal");
            }else{
                $('#form').attr('action','c_berita/do_edit');
                $('#idBerita').val(data[0].idBerita);
                $('#judulBerita').val(data[0].judulBerita);
                $('#summernote').summernote('code',data[0].isiBerita,{
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
    console.log(globalBerita[id])
    $('.delete-judul-berita').html("berita: "+globalBerita[number].judulBerita);
    
}

function confirmDelete(event, element){
    event.preventDefault();
    $.ajax({
        url: "c_beranda/delete",
        type: "POST",
        data: {idBerita:deleteID},
        success: function(data){
            var status = JSON.parse(data)
            if(status.status=="success"){
                loadBerita();
                $(element).parents('.modal').modal("hide");
            }
            data = JSON.parse(data)
            if(data.length == 0){
                console.log("gagal");
            }else{
            }
        },
        error: function(){
            
        }
    })
}

var globalBerita = [];
var globalBeritaNumber = 0;
var globalPageNumber = 1;
var isLoggedIn = false;

function loadBerita(){
    isLoggedIn = $('#repo>.isloggedin').html().trim()=="1";
    $.ajax({
        url: "c_beranda/getlist",
        type: "GET",
        success: function(data){
            data = JSON.parse(data);
            globalBerita = data.berita;
            if(data.status == "success"){
                populateBerita()
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

function populateBerita(){
    //isi berita big list
    
    var bigList = $(".berita-big-list .list");
    bigList.html("");
    if(globalBerita.length>0 && globalBerita.length <= globalBeritaNumber){
        globalBeritaNumber = 0;
    }
    if(globalBerita.length>globalBeritaNumber){
        bigList.append(createBeritaDiv(globalBerita[globalBeritaNumber],globalBeritaNumber));
    }
    //isi berita small list
    var beritaPerPage = 10;
    var smallList = $(".berital-small-list .list");
    smallList.html("")
    var pagenumber = 1;
    var pagecontent = 0;
    var currentpage = createBeritaPage();
    currentpage.attr('data-pagenumber',pagenumber);
    
    var maxpage = globalBerita.length / beritaPerPage + 1;
    if(globalPageNumber > maxpage){
        globalPageNumber = 1;
    }
    
    for(var i = 0; i<globalBerita.length; i++){
        if(pagecontent>=beritaPerPage){
            smallList.append(currentpage);
            currentpage = createBeritaPage();
            pagecontent = 0;
            currentpage.attr('data-pagenumber',pagenumber);
            pagenumber++;
        }
        currentpage.append(createListDiv(globalBerita[i],i));
        pagecontent++;
    }
    smallList.append(currentpage);
    currentpage.attr('data-pagenumber',pagenumber);
    pagenumber++;
    
    var paginationbullet = $('.berita-small-list').find('ul.pagination');
    paginationbullet.html("");
    if(pagecontent!=0){
        $('.no-list').hide();
        $('.pagination').show();
        for(var i = 1; i< pagenumber; i++){
            if(i==globalPageNumber){
                paginationbullet.append($('<li class="active"><a href="#" onclick="beritaSwitchPage(event,this)" data-pagenumber="'+i+'">'+i+'</a></li>'));
            }
            else{
                paginationbullet.append($('<li><a href="#" onclick="beritaSwitchPage(event,this)" data-pagenumber="'+i+'">'+i+'</a></li>'));
            }
        }
        $("a[data-pagenumber="+globalPageNumber+"]").click()
    }
    else if(pagecontent==0){
        $('.pagination').hide();
        $('.no-list').show();
    }
}

function beritaSwitchPage(event,element){
    event.preventDefault();
    var pagenumber = $(element).attr('data-pagenumber');
    globalPageNumber = pagenumber;
    $('.berita-small-list ul.pagination li').removeClass('active');
    $(".berita-small-list .list .berita-small-page").removeClass('active');
    $(element).parents('li').addClass('active');
    $(".berita-small-list .list .berita-small-page[data-pagenumber='"+pagenumber+"']").addClass('active');
    
}

function createBeritaPage(){
    return $('<div class="berita-small-page"></div>')
}

function createBeritaDiv(berita,number){
    var container = $('<div class="margin-top-3em"></div>');
    
    //menampilkan button edit dan delete berita
    
    if(isLoggedIn){
        var buttoncontainer = $('<div class="text-right buttoncontainer"></div>');
        var buttonedit = $('<a id="edit" data-toggle="modal" data-target="#tambahform" data-whatever="@mdo" onclick="setEdit(event, this)" data-id="'+globalBerita[number].idBerita+'"><span class="glyphicon glyphicon-edit point icon-glyphicon"></span></a>');
        var buttondelete = $('<a id="delete" data-toggle="modal" data-target="#deleteform" data-whatever="@mdo" onclick="setDelete(event, this)" data-number="'+number+'" data-id="'+globalBerita[number].idBerita+'"><span class="glyphicon glyphicon-trash point icon-glyphicon"></span></a>');
            buttoncontainer.append(buttonedit)
            buttoncontainer.append(buttondelete)
        container.append(buttoncontainer)
    }
    
    //menampilkan judul berita
    container.append($('<span class="judulBerita text-center"><h1>'+berita.judulBerita+'</h3></span>'));
    
    //menampilkan tanggal pembuatan berita
    var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    
    var dateObj = new Date(berita.waktu);
    
    var tanggal = dateObj.getDate();
    var _hari = dateObj.getDay();
    var _bulan = dateObj.getMonth();
    var _tahun = dateObj.getYear();
    
    var hari = hari[_hari];
    var bulan = bulan[_bulan];
    var tahun = (_tahun<1000) ? _tahun + 1900 : _tahun;
    
    var date = hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun;
    //var date = new Date(berita.waktu);
    container.append($('<span class="text-center date"><h5 class="italic">'+date+'</h5></span>')) ;
    container.append($('<br>'));
    
    //menampilkan isi berita
    var paragraph = $('<p class=""></p>');
        paragraph.html(berita.isiBerita);
    
    var paragraphspan = $('<span></span>');
        paragraphspan.html(paragraph);
    
    container.append(paragraphspan);
    
    return container;
}

function createListDiv(berita,number){
    var container = $('<div class="margin-top-3em"></div>');
    //judul
    container.append($('<span class="judulBerita text-center"><h1><a href="#" onclick="switchBerita(event,this)" data-number="'+number+'">'+berita.judulBerita+'</a></h3></span>'));
    var date = new Date(berita.waktu);
    container.append($('<span class="text-center date"><h5 class="italic">'+date+'</h5></span>')) ;
    container.append($('<br>'));
    
    return container;
}

function switchBerita(event,element){
    event.preventDefault();
    var number = $(element).attr('data-number')
    if(number==globalBeritaNumber){
        return;
    }
    globalBeritaNumber = number;
    populateBerita();
}