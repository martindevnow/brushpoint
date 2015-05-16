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

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function(message) {
                $.publish('form.submitted', form);
                $('#noteModal').modal('hide');
                $('#issueModal').modal('hide');
                $('#featureModal').modal('hide');
                $('#virtueModal').modal('hide');
                $('#retailerModal').modal('hide');

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
})();

(function() {
    $.subscribe('form.submitted', function() {
        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
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


