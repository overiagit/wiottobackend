var _LANG = null;
var _TYPE = null;  // condition or note

$(document).ready(function() {
    $('#summernote').summernote({
            height: 300,
        }
    );

    $('.btnNoteCond').on('click', function (event){
        const arr_btn = this.id.split('_');
        _LANG = arr_btn[2];
        _TYPE = arr_btn[1];
        const note = $('#txt_'+_TYPE+'_'+_LANG);

        const summernote =  $('#summernote');
        summernote.summernote('reset');
        summernote.summernote('pasteHTML', note.val());
    });


    $('#btnSaveNote').on('click',function (event){
        if(!_LANG || !_TYPE)
            return;
        const summernote = $('#summernote');
        $('#txt_'+_TYPE+'_'+_LANG).text( summernote.summernote('code'));
        _LANG = null;
        _TYPE = null;
        summernote.summernote('reset');
        $('#frmEditor').modal('hide');
    });
});