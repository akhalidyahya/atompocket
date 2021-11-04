$(function() {
    $('#sign_in').validate({
        rules: {
            password: {
                required: true,
                minlength: 4
            },

        },
        highlight: function(input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});