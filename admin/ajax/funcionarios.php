<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['tipo'];

print_r($Action);

$jSon = array();

sleep(1);




if ($Action):
    require '../../_app/Config.inc.php';
endif;



switch ($Action):
    case 'dadospessoais';
        $jSon['error'] = "Cadastro de Dados Pessoais!";
        break;
    case 'Endereco';
        $jSon['error'] = "Cadastro de Endereco!";
        break;
    case 'Contatos';
        $jSon['error'] = "Cadastro de Contatos!";
        break;
    case 'Documentos';
        $jSon['error'] = "Cadastro de Documentos!";
        break;
    default :
        $jSon['error'] = "Funcionalidade Não Encontrada!";
        
        print_r($Action);
endswitch;




//if ($Post['search'] == ''):
//    $jSon['error'] = "Informar o código, cnpj, cpf, razão social ou nome fantasia do cliente!";
//else:
//    $Read = new Read;
//    $Read->ExeRead('cliente', "WHERE id=:id OR cnpj_cpf=:c OR razao_social=:rs OR nome_fantasia=:nf", "id={$Post['search']}&c={$Post['search']}&rs={$Post['search']}&nf={$Post['search']}");
//    if ($Read->getResult()):
//
//
//
//        $jSon['success'] = "Cliente Encontrado!";
//
//    else:
//
//        $jSon['error'] = "Cliente Não Encontrado!";
//    endif;
//
//
//endif;

echo json_encode($jSon);

