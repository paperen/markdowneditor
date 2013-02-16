$(document).ready(function(){
    // insert link
    $('#MDE_insertlink_btn').click(function(){
        MDE_insertLink();
    });
    if ( preview ) {
        // preview
        $('#MDE_preview_btn').click(function(){
            MDE_preview();
        });
    }
    // keyup
    $('#MDE_textarea').keydown(function(e){

        if ( e.keyCode == TAB_KEY ) {
            // hotkey tab
            e.preventDefault();
            MDE_insertAtCursor('\t');
        } else if ( upload && e.shiftKey && e.altKey && e.keyCode == UPLOAD_KEY ) {
            // hotkey upload
            $('#MDE_file').click();
        } else if ( e.shiftKey && e.altKey && e.keyCode == LINK_KEY ) {
            // hotkey insert link
            MDE_insertLink();
        } else {
            // @todo when detected form submit or preview will trigger run MDE_parse()
            MDE_parse();
        }
    });
    if ( upload ) {
        // file input
        $('#MDE_file').change(function(){
            MDE_upload();
        });

        // file submit
        $('#MDE_filesubmit_btn').click(function(){
            MDE_upload();
        });
        // append upload form
        $('body').append('<form name="MDE_file_form" id="MDE_file_form" enctype="multipart/form-data" action="' +upload_handler+ '" method="post" target="MDE_upload_iframe" style="display:none;"></form>');
    }
});
$(document).keyup(function(e){
    if ( preview && e.shiftKey && e.altKey && e.keyCode == PREVIEW_KEY ) {
        // hotkey preview
        MDE_preview();
    }
});
// insert link
function MDE_insertLink() {
    var markdown_link = '[text](href "title")';
    MDE_insertAtCursor( markdown_link );
}
// preview
function MDE_preview() {
    if ( $('#MDE_preview_btn').val() == '预览' ) {
        // preview on
        MDE_parse();
        $('#MDE_textarea').css('display', 'none');
        $('#MDE_preview').html( $('#'+id).val() ).css('display', 'block');
        $('#MDE_preview_btn').val('返回编辑模式');
    } else {
        // preview off
        $('#MDE_textarea').css('display', 'block');
        $('#MDE_preview').html('').css('display', 'none');
        $('#MDE_preview_btn').val('预览');
    }
}
// upload
function MDE_upload() {
    $('#MDE_file_form').html('').append( $('#MDE_file').clone().css('display', 'none') ).submit();
}
// parse
function MDE_parse() {
    var MDE_text = $('#MDE_textarea').val();
    if ( MDE_text.length > 0 ) {
        $.ajax({
            type: "POST",
			async: false,
            url: editor_relpath + "editor.php?do=parse",
            data: 'content=' + encodeURIComponent( MDE_text ),
            dataType: 'json',
            success: function( result ){
                $('#' + id).val( result.html );
            }
        });
    }
}
// insert at cursor
function MDE_insertAtCursor(myValue) {
    var myField = document.getElementById('MDE_textarea');    

    //IE support
    if (document.selection) { 
        myField.focus(); 
        sel = document.selection.createRange(); 
        sel.text = myValue; 
        sel.select();
    } 
    //MOZILLA/NETSCAPE support 
    else if (myField.selectionStart || myField.selectionStart == '0') { 
        var startPos = myField.selectionStart; 
        var endPos = myField.selectionEnd; 
        // save scrollTop before insert 
        var restoreTop = myField.scrollTop; 
        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length); 
        if (restoreTop > 0) { 
            myField.scrollTop = restoreTop; 
        } 
        myField.focus(); 
        myField.selectionStart = startPos + myValue.length; 
        myField.selectionEnd = startPos + myValue.length; 
    } else { 
        myField.value += myValue; 
        myField.focus(); 
    } 
}
function MDE_insertFile( filename ) {
    var ext = filename.split('.').pop(),
    img_regx = /gif|png|jpg|jpeg|bmp/,
    is_image = ( ext.match( img_regx ) != null ),
    content = document.getElementById('MDE_textarea').value;

    if ( is_image ) {
        var markdown = '![' +filename+ '](' +filename+ ')';
    } else {
        var markdown = '[' +filename+ '](' +filename+ ' "' +filename+ '")';
    }
    MDE_insertAtCursor( markdown );
    MDE_parse();
}
