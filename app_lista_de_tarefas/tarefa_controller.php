<?php

use PhpMyAdmin\Config;

require "../../../app_lista_de_tarefas/tarefa.model.php";
require "../../../app_lista_de_tarefas/tarefa.service.php";
require "../../../app_lista_de_tarefas/conexao.php";

/*
    echo '<pre>';
    print_r($_POST); //debug importação das informações e do instanciamento do obj Tarefa
    echo '</pre>';
*/

$acao = isset($_GET['acao']) ? ($_GET['acao']) : $acao;

//echo $acao;

if (isset($_GET['acao']) && ($_GET['acao']) == 'inserir') {
$tarefa = new Tarefa();
$tarefa->__set('tarefa', $_POST['tarefa']);

$conexao = new Conexao();

$tarefaService = new TarefaService($conexao, $tarefa);
$tarefaService->inserir();


    echo '<pre>';
    print_r($tarefaService);
    echo '</pre>';  


header('Location: nova_tarefa.php?inclusao=1');

} elseif($acao == 'recuperar'){
    
    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();

} elseif($acao == 'atualizar'){
    print_r($_POST);

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    if($tarefaService->atualizar()){

        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }
       
    }

} elseif($acao == 'remover') {
    $tarefa = new Tarefa;
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php');
    }  else {
        header('location: todas_tarefas.php');
    }  

    

} elseif ($acao == 'marcarRealizada') {
    $tarefa = new Tarefa;
    $tarefa->__set('id', $_GET['id'])->__set('id_status', 2 );

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php');
    } else {            
        header('location: todas_tarefas.php');
    }

    
} elseif ($acao= 'recuperarTarefasPendentes') {
    $tarefa = new Tarefa;
    $tarefa->__set('id_status', 1 );

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperarTarefasPendentes();
    //header('location: index.php');
}



?>