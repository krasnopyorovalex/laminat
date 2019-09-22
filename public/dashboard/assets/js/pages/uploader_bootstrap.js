/* ------------------------------------------------------------------------------
*
*  # Bootstrap multiple file uploader
*
*  Specific JS code additions for uploader_bootstrap.html page
*
*  Version: 1.1
*  Latest update: Dec 11, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {
    // AJAX upload
    var fileInputAjax = jQuery(".file-input-ajax"),
        entityId = jQuery('#images form input[name=entityId]').val(),
        uploadUrl = jQuery('#images form input[name=uploadUrl]').val(),
        _images_box = jQuery("#_images_box");

    fileInputAjax.fileinput({
        uploadUrl: uploadUrl,
        uploadAsync: true,
        //maxFileCount: 4,
        initialPreview: [],
        browseLabel: 'Выбрать',
        removeLabel: 'Удалить',
        uploadLabel: 'Загрузить',
        dropZoneTitle: 'Перетащите файлы сюда …',
        msgSelected: '{n} выбрано файлов',
        fileActionSettings: {
            removeTitle: 'Удалить файл',
            uploadTitle: 'Загрузить файл',
            removeIcon: '<i class="icon-bin"></i>',
            removeClass: 'btn btn-link btn-xs btn-icon',
            uploadIcon: '<i class="icon-upload"></i>',
            uploadClass: 'btn btn-link btn-xs btn-icon',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        }
    });

    fileInputAjax.on('fileuploaded', function() {
        return jQuery.ajax({
            url: uploadUrl,
            type: "GET",
            success: function(data) {
                _images_box.html(data.images);
                return startDnDImages();
            }
        });
    });
});
