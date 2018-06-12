$(function () {
    $('.j_PersonalData').submit(function () {
        var PersonalData = $(this).serialize();

        $.ajax({
            url: 'ajax/funcionarios.php',
            data: PersonalData,
            Type: 'POST',
            dataType: 'jSon',
            beforeSend: function () {
//                form.find('.trigger-box').fadeout(500, function(){
//                    $(this).remove();
//                });

            },
            success: function (resposta) {
                console.log(resposta);
                if (resposta.error) {
                    $('.trigger-box').html('<div class="trigger trigger-error">' + resposta.error + '</div>');
                } else {
                    $('.trigger-box').html('<div class="trigger trigger-sucess">' + resposta.sucess + '</div>');
                }

            }

        });

        return false;
    });



    $('.j_Endereco').click(function () {
        return false;
    });
});