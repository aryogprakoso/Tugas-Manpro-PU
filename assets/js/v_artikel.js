function setEdit(event,element){
    event.preventDefault();
    var id = $(element).attr('data-id');
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