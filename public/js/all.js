(function($) {
    var o = $({});

    $.subscribe = function(){
        o.on.apply(o, arguments);
    };

    $.unsubscribe = function () {
        o.off.apply(o, arguments);
    };

    $.publish = function() {
        o.trigger.apply(o, arguments);
    };

}(jQuery));
(function() {
    var submitAjaxRequest = function (e) {

        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';

        console.log($(this));
        var button = form.find('input[name="shipped"]').val();
        if (button)
        {
            console.log('hide...');
            $(this).hide(2000);
        }

        console.log('send ajax request...');
        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function(message) {
                $.publish('form.submitted', form);

                $('#noteModal').modal('hide');
                $('#requestRetailerInfoModal').modal('hide');
                $('#issueModal').modal('hide');
                $('#featureModal').modal('hide');
                $('#virtueModal').modal('hide');
                $('#contactCustomerModal').modal('hide');

                if (form.attr('id') == "virtue_ajax_form")
                {
                    var list_type = $("#virtue_ajax_form select[name=type]").val();
                    $('#'+ list_type + '_list').append(message);
                    form.find("input[type=text]").val("");
                }
                else if (form.attr('id') == "note_ajax_form")
                {
                    var list_type = "note"
                    // alert(list_type);
                    $('#'+ list_type + '_list').append(message);
                    form.find("input[type=text], textarea").val("");
                }
                else if (form.attr('id') == "requestRetailerInfo_ajax_form")
                {

                }
            }
        });
        e.preventDefault();
    };

    // forms marked with 'data-remote' will submit via AJAX
    $('form[data-remote]').on('submit', submitAjaxRequest);


    // the 'data-click-submits-form' auto submits the form
    $('*[data-click-submits-form]').on('change', function(){
        $(this).closest('form').submit();
    });
    $('*[button-disappears]').on('submit', function(){
        console.log('hide...');
        $(this).hide(2000);
    });
})();

(function() {
    $.subscribe('form.submitted', function() {
        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
    });
})();

(function() {
    $.subscribe('email.sent', function () {
        $('.email-sent').fadeIn(400).delay(1000).fadeOut(500);
    });
})();

(function() {
    $("body").on("click", ".del_button", function(e){
        e.preventDefault();
        var clickedId = this.id.split('-');
        var dbNumberId = clickedId[1];
        var myData = 'virtueToDelete=' + dbNumberId;

        $('#virtue_' + dbNumberId).addClass("sel");
        $(this).hide();
        jQuery.ajax({
            type: "GET",
            url: "/admins/virtues/delete",
            dataType: "text",
            data:myData,
            success:function(response) {
                $('#virtue_'+dbNumberId).fadeOut();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });
})();







var adjustment;

$("ol.feature_list").sortable({
    group: 'feature_list',
    pullPlaceholder: false,
    // animation on drop
    onDrop: function  (item, targetContainer, _super) {
        var clonedItem = $('<li/>').css({height: 0})
        item.before(clonedItem)
        clonedItem.animate({'height': item.height()})

        item.animate(clonedItem.position(), function  () {
            clonedItem.detach()
            _super(item)
        })
    },

    // set item relative to cursor position
    onDragStart: function ($item, container, _super) {
        var offset = $item.offset(),
            pointer = container.rootGroup.pointer

        adjustment = {
            left: pointer.left - offset.left,
            top: pointer.top - offset.top
        }

        _super($item, container)
    },
    onDrag: function ($item, position) {
        $item.css({
            left: position.left - adjustment.left,
            top: position.top - adjustment.top
        })
    },
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        var csrf_token = $("meta[name=csrf-token]").attr("content");
        console.log(data);

        // post with AJAX
        $.ajax({
            data: data + "&csrf-token=" + csrf_token,
            type: 'GET',
            url: '/admins/products/virtues/saveOrder',
            success: function(response) {
                $('.flash').fadeIn(500).delay(1000).fadeOut(500);
            }
        });
    }
});



$("ol.benefit_list").sortable({
    group: 'benefit_list',
    pullPlaceholder: false,
    // animation on drop
    onDrop: function  (item, targetContainer, _super) {
        var clonedItem = $('<li/>').css({height: 0})
        item.before(clonedItem)
        clonedItem.animate({'height': item.height()})

        item.animate(clonedItem.position(), function  () {
            clonedItem.detach()
            _super(item)
        })
    },

    // set item relative to cursor position
    onDragStart: function ($item, container, _super) {
        var offset = $item.offset(),
            pointer = container.rootGroup.pointer

        adjustment = {
            left: pointer.left - offset.left,
            top: pointer.top - offset.top
        }

        _super($item, container)
    },
    onDrag: function ($item, position) {
        $item.css({
            left: position.left - adjustment.left,
            top: position.top - adjustment.top
        })
    },
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        var csrf_token = $("meta[name=csrf-token]").attr("content");
        console.log(data);

        // post with AJAX
        $.ajax({
            data: data + "&csrf-token=" + csrf_token,
            type: 'GET',
            url: '/admins/products/virtues/saveOrder',
            success: function(response) {
                $('.flash').fadeIn(500).delay(1000).fadeOut(500);
            }
        });
    }
});






$("ol.other_list").sortable({
    group: 'other_list',
    pullPlaceholder: false,
    // animation on drop
    onDrop: function  (item, targetContainer, _super) {
        var clonedItem = $('<li/>').css({height: 0})
        item.before(clonedItem)
        clonedItem.animate({'height': item.height()})

        item.animate(clonedItem.position(), function  () {
            clonedItem.detach()
            _super(item)
        })
    },

    // set item relative to cursor position
    onDragStart: function ($item, container, _super) {
        var offset = $item.offset(),
            pointer = container.rootGroup.pointer

        adjustment = {
            left: pointer.left - offset.left,
            top: pointer.top - offset.top
        }

        _super($item, container)
    },
    onDrag: function ($item, position) {
        $item.css({
            left: position.left - adjustment.left,
            top: position.top - adjustment.top
        })
    },
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        var csrf_token = $("meta[name=csrf-token]").attr("content");
        console.log(data);

        // post with AJAX
        $.ajax({
            data: data + "&csrf-token=" + csrf_token,
            type: 'GET',
            url: '/admins/products/virtues/saveOrder',
            success: function(response) {
                $('.flash').fadeIn(500).delay(1000).fadeOut(500);
            }
        });
    }
});









$("ol.product_list").sortable({
    group: 'other_list',
    pullPlaceholder: false,
    // animation on drop
    /*onDrop: function  (item, targetContainer, _super) {
        var clonedItem = $('<li/>').css({height: 0})
        item.before(clonedItem)
        clonedItem.animate({'height': item.height()})

        item.animate(clonedItem.position(), function  () {
            clonedItem.detach()
            _super(item)
        })
    },

    // set item relative to cursor position
    onDragStart: function ($item, container, _super) {
        var offset = $item.offset(),
            pointer = container.rootGroup.pointer

        adjustment = {
            left: pointer.left - offset.left,
            top: pointer.top - offset.top
        }

        _super($item, container)
    },
    onDrag: function ($item, position) {
        $item.css({
            left: position.left - adjustment.left,
            top: position.top - adjustment.top
        })
    },*/
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        var csrf_token = $("meta[name=csrf-token]").attr("content");
        console.log(data);

        // post with AJAX
        $.ajax({
            data: data + "&csrf-token=" + csrf_token,
            type: 'GET',
            url: '/admins/products/rearrange/saveOrder',
            success: function(response) {
                $('.flash').fadeIn(500).delay(1000).fadeOut(500);
            }
        });
    }
});