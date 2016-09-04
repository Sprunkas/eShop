$('#login').on('submit', function(e)
{
    e.preventDefault();
    var $form = $(this);
    var url = $form.attr('action');
    var formData = {};
    $form.find('input', 'select').each(function()
    {
        formData[ $(this).attr('name') ] = $(this).val();
    });
    $.post(url, formData, function(response)
    {
        location.reload();
    }).fail(function(jqXhr) {
        if( jqXhr.status === 422 ) {
            $('.alert-warning').remove();
            $errors = jqXhr.responseJSON;
            if($errors['error']) {
                $('.modal-header').after('<div class="alert alert-danger">' + $errors['error'] + '</div>');
            }
            $('.form-group').removeClass('has-error');
            $('span.help-block').remove();
            $.each($errors, function( key, value ) {
                if('form-group login-' + key == $('.login-' + key).attr('class')) {
                    $('.login-' + key).addClass('has-error');
                    $('.login-' + key).append('<span class="help-block">' + value[0] + '</span>')
                }
            });
        }
    });
});