(function() {
    var submitAjaxRequest = function (e) {

        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function() {
                $.publish('form.submitted', form);
                $('#noteModal').modal('hide');
                $('#issueModal').modal('hide');
                $('#retailerModal').modal('hide');

                window.location.reload();
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
