$(document).ready(function () {

    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() === $('#confirm_password').val()) {
            $('.sifra').addClass('has-success');
            $('.sifra').removeClass("has-error");
            $('#message').html('Podudara se').css('color', 'green');
            $('#change_profile').prop('disabled', false);
        } else {
            $('#message').html('Lozinka se nepodudara!').css('color', 'red');
            $('.sifra').addClass("has-error");
            $('.sifra').removeClass('has-success');
            $('#change_profile').prop('disabled', true);
        }
    });

    $('#edit_profile').click(function () {
        $('input').removeAttr('readonly');
        $(this).hide();
        $('#change_profile').attr('type','submit');
        $('#change_profile').fadeIn(200);
        $('small').removeAttr('hidden');
    });
    
    
    $('#succes_profile_change').fadeTo(2000, 500).slideUp(500, function(){
    $('#succes_profile_change').slideUp(500);
    });
});