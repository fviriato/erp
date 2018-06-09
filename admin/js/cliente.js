$(function () {

    $('.j_fisica').hide();
    $('.j_juridica').hide();
    $('.j_localizacao').hide();
    $('.j_telefone').hide();
    $('.j_email').hide();

    $('.j_tpCliente').change(function () {
        var select = $(this);        
        if (select.val() === 'juridica') {
            $('.j_fisica').hide();
            $('.j_juridica').hide();
            $('.j_juridica').slideDown(2000);
        } else if (select.val() === 'fisica') {
            $('.j_juridica').hide();
            $('.j_fisica').hide();
            $('.j_fisica').slideDown(2000);
        }

    });

    $(function () {
        $('.j_InserirFisica').click(function () {
            $('.j_localizacao').hide();
            $('.j_localizacao').fadeIn(1000);
            return false;
        });
        $('.j_InserirEndereco').click(function () {
            $('.j_telefone').hide();
            $('.j_telefone').slideDown(2000);
            return false;
        });
        $('.j_InserirEndereco').click(function () {
            $('.j_telefone').hide();
            $('.j_telefone').slideDown(2000);
            return false;
        });

    });






//    $('.j_search').submit(function () {
//        
//        var data = $(this).serialize();
//        $.ajax({
//            url: "ajax/cliente.php",
//            data: data,
//            type: 'POST',
//            dataType: 'json',
//            beforeSend: function () {
//                $('.trigger-error').fadeOut(1000, function () {
//                    $(this).remove();
//                });
//            },
//            success: function (resposta) {
//
//                if (resposta.error) {
//                    $('.trigger-box').html('<div class="trigger trigger-error">' + resposta.error + '</div>');
//                    $('.trigger-error').fadeIn(1000);
//                } else {
//                    $('.trigger-box').html('<div class="trigger trigger-success">' + resposta.success + '</div>');
//                    $('.trigger-success').fadeIn(1000);
//                }
//                console.log(resposta);
//            }
//
//        });
//        return false;
//    });
});


