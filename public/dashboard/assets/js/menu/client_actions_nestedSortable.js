jQuery(function(){
    
    /*
     |-----------------------------------------------------------
     |   Nested set navigation
     |-----------------------------------------------------------
     */
    var to_server = {};
    jQuery('ol.navigation').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper:	'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 3,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: true,
        stop: function( event, ui ) {
            jQuery('.navigation_box .navigation li').each(function (i) {
                var _this = jQuery(this),
                    id    = parseInt(_this.attr('id').replace('item_','')),
                    parent_id = '';

                if(typeof _this.closest('ol').parent('li').attr('id') != 'undefined'){
                    parent_id = parseInt(_this.closest('ol').parent('li').attr('id').replace('item_',''));
                }

                to_server[id] = {
                    pos: i,
                    parent_id: parent_id
                };
            });
            return $.ajax({
                url: window.location.pathname.replace('menu-items','menu-items/sorting'),
                type: "POST",
                data: to_server,
                success: function(data) {
                    if(data['status'] == 'true') {
                        return new PNotify({
                            title: 'Уведомление',
                            text: 'Позиции пунктов меню сохранены успешно',
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });
                    }
                }
            });
        }
    });

});