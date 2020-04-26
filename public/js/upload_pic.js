Dropzone.autoDiscover = false;
function load_pic(){ //function load()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            type: 'POST',
            dataType: "json",
            data: {
                ref_table_id: $("#table_id").val(),
                },
            url: $('#show_pic').attr('route-data'),
            success: function (data) {
                $("#show_pic").html(data.html_data);
                load_data_pic();
                }
            });
}
function load_doc(){ //function load()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache: false,
        type: 'POST',
        dataType: "json",
        data: {
            ref_table_id: $("#table_id").val(),
            },
        url: $('#show_doc').attr('route-data'),
        success: function (data) {
            $("#show_doc").html(data.html_data);
            load_data_file();
            }
        });
}

$(document).ready(function(){
    load_pic();
    load_doc();

$(document).on("click", ".stcover", function() {
    if(confirm("Confirm setting this image as the cover page?"))
    {
        var ID = $(this).attr("id");
        $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        cache: false,
        type: "POST",
        dataType: "json",
        url: $(this).attr('route-data'),
            data: {
                    picture_id: ID
                },
        beforeSend: function(){ $("#recordsArray_"+ID).animate({'backgroundColor':'#fb6c6c'},300);},
        success: function(response){
            if(response.message=="success"){
                load_pic();
            }
        }
        });
    }
    return false;
});

$(document).on("click", ".stdelete", function() {
    if(confirm("Delete this Photo?"))
    {
        var ID = $(this).attr("id");
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            type: "POST",
            dataType: "json",
            url: $(this).attr('route-data'),
            data: {
                picture_id: ID,
                },
            beforeSend: function(){ $("#recordsArray_"+ID).animate({'backgroundColor':'#fb6c6c'},300);},
            success: function(response){
                    if(response.message=="success"){
                        load_pic();
                    }
                }
        });
    }
    return false;
});

$("#show_pic").sortable({
    opacity: 0.8,
    cursor: 'move',
    tolerance: 'pointer',
    connectWith: '.col-xs-12',
    update: function() {
           var order = $("#show_pic").sortable("serialize") + '&type=updateRecords&_token='+ $('meta[name="csrf-token"]').attr('content');
           $.post($(this).attr('route-data-sortable'), order, function(theResponse){
           });
       }
});
$("#show_doc").sortable({
    opacity: 0.8,
    cursor: 'move',
    tolerance: 'pointer',
    connectWith: '.col-xs-12',
    update: function() {
           var order = $(this).sortable("serialize") + '&type=updateRecords&_token='+ $('meta[name="csrf-token"]').attr('content');
           $.post($("#show_doc").attr('route-data-sortable'), order, function(theResponse){
           });
       }
});

$(document).on("click", ".stdelete_filedoc", function() {
    if(confirm("Delete this file?"))
    {
        var ID = $(this).attr("id");
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            type: "POST",
            dataType: "json",
            url: $(this).attr('route-data'),
            data: {
                file_id: ID,
                },
            beforeSend: function(){ $("#recordsArray_filedoc_"+ID).animate({'backgroundColor':'#fb6c6c'},300);},
            success: function(response){
                    if(response.message=="success"){
                        load_doc();
                    }
                }
        });
    }
    return false;
});
      // File manager button (image icon)
      const FMButton = function(context) {
        const ui = $.summernote.ui;
        const button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'File Manager',
          click: function() {
            window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
          }
        });
        return button.render();
      };
      $('#summernote').summernote({
        toolbar: [
            ['fil', ['undo','redo']],
            ['fil', ['hr','clear']],
            ['font', ['style','bold','italic', 'underline','superscript','subscript']],
            ['fontname', ['fontname','fontsize','color']],
            ['para', ['ul', 'ol', 'paragraph','height']],
            ['table', ['table']],
            ['insert', ['link', 'fm', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        buttons: {
          fm: FMButton
        },
        height: 300,
        tabsize: 1
      });

var myDropzone = new Dropzone("#myDropzone", {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $('#myDropzone').attr('route-data'),
		type: "post",
		paramName: "pic_file",
		params: {
		 	ref_table_id: $("#table_id").val(),
			picture_title: $("#name").val(),
		},
        autoProcessQueue: true,
        uploadMultiple: false, // uplaod files in a single request
        maxFilesize: 12, // MB
        acceptedFiles: ".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx",
        // Language Strings
        dictInvalidFileType: "ประเภทไฟล์ไม่ถูกต้อง",
        dictDefaultMessage: "Upload Picture and Document file",
    });
		myDropzone.on("success", function(file,response) {
			myDropzone.removeFile(file);
			if(response.message=="success"){
                if(response.type=="pic"){
                load_pic();
                }else if(response.type=="filedocument"){
                load_doc();
                }
			}
        });
});
    // set file link
    function fmSetLink(url) {
        var fileExtension = ['jpeg','jpg','png','gif'];
        if ($.inArray(url.split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#summernote').summernote('createLink', {
                text: url,
                url: url,
                isNewWindow: true
              });
        }else{
            $('#summernote').summernote('insertImage', url);
        }
    }
