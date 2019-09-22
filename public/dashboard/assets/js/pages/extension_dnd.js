/* ------------------------------------------------------------------------------
*
*  #Dragula - drag and drop library
*
*  Specific JS code additions for extension_dnd.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Dragula
    // ------------------------------

    // Draggable panels
    dragula([document.getElementById('panels-target-left'), document.getElementById('panels-target-right')]);


    // Draggable forms
    dragula([document.getElementById('forms-target-left'), document.getElementById('forms-target-right')]);


    // Draggable media lists
    dragula([document.getElementById('media-list-target-left'), document.getElementById('media-list-target-right')], {
        mirrorContainer: document.querySelector('.media-list-container'),
        moves: function (el, container, handle) {
            return handle.classList.contains('dragula-handle');
        }
    });


    //
    // Dropdown menu items
    //

    // Define containers
    var containers = $('.dropdown-menu-sortable').toArray();

    // Init dragula
    dragula(containers, {
            mirrorContainer: document.querySelector('.dropdown-menu-sortable')
    });


    //
    // Draggable tabs
    //

    // Basic tabs
    dragula([document.getElementById('tabs-target-left')], {
        mirrorContainer: document.querySelector('#tabs-target-left')
    });

    // Basic justified
    dragula([document.getElementById('tabs-target-right')], {
        mirrorContainer: document.querySelector('#tabs-target-right')
    });

    // Colored tabs
    dragula([document.getElementById('tabs-solid-target-left')], {
        mirrorContainer: document.querySelector('#tabs-solid-target-left')
    });

    // Colored justified
    dragula([document.getElementById('tabs-solid-target-right')], {
        mirrorContainer: document.querySelector('#tabs-solid-target-right')
    });


    //
    // Draggable pills
    //

    startDnDImages();

    // Basic pills
    dragula([document.getElementById('pills-target-left')], {
        mirrorContainer: document.querySelector('#pills-target-left')
    });

    // Basic justified
    // dragula([document.getElementById('pills-target-right')], {
    //     mirrorContainer: document.querySelector('#pills-target-right')
    // });



    // Toolbar pills
    dragula([document.getElementById('pills-toolbar-target-left')], {
        mirrorContainer: document.querySelector('#pills-toolbar-target-left')
    });

    // Toolbar justified
    dragula([document.getElementById('pills-toolbar-target-right')], {
        mirrorContainer: document.querySelector('#pills-toolbar-target-right')
    });


    //
    // Accordion and collapsible
    //

    // Accordion
    dragula([document.getElementById('accordion-target')], {
        mirrorContainer: document.getElementById('accordion-target')
    });

    // Collapsible
    dragula([document.getElementById('collapsible-target')], {
        mirrorContainer: document.getElementById('collapsible-target')
    });

    // File input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-warning-400'
    });

});

function startDnDImages() {
    var url = jQuery('#images form input[name=updatePositionUrl]').val();
    return dragula([document.getElementById('pills-target-right')])
        .on('out', function (el, container) {
            var list = [];
            jQuery('#pills-target-right > div').each(function (item) {
                list[item] = jQuery(this).attr('data-id');
            });
            return $.post(url, {'data': list}, function(data){
                return new PNotify({
                    title: 'Уведомление от сервера',
                    text: data.message,
                    icon: 'icon-checkmark3',
                    type: 'success'
                });;
            });
        });
}
