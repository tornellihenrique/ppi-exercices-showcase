<?php

    // Include database configuration
    include('conn.php');

    function filtraEntrada($dado) {
        $dado = trim($dado); // remove espaços no inicio e no final da string
        $dado = stripslashes($dado); // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
        $dado = htmlspecialchars($dado); // caracteres especiais do HTML (como < e >) são codificados
    
        return $dado;
    }

    abstract class Routes {
        const HOME = '/ppi-activities/modulo08';
        const CAD_CLIENTE = '/ppi-activities/modulo08/cad-cliente';
        const LIST_CLIENTE = '/ppi-activities/modulo08/list-cliente';
        const EDIT_CLIENTE = '/ppi-activities/modulo08/edit-cliente';
        const CAD_ALUNO = '/ppi-activities/modulo08/cad-aluno';
        const LIST_ALUNO = '/ppi-activities/modulo08/list-aluno';
    }

    class Cliente {
        public $id;
        public $nome;
        public $email;
        public $estadoCivil;
        public $diaNascimento;
    }

    class Aluno {
        public $matricula;
        public $nome;
        public $sexo;
    }

    // ---------------------------------------------------------- //

    $pageTitle = '';
    $content;

    $request = $_SERVER['REQUEST_URI'];

    switch ($request) {
        case strpos($request, Routes::CAD_CLIENTE) !== false:
            $pageTitle = 'Cadastro de clientes';
            $content = 'pages/cadCliente.php';
            break;
        case strpos($request, Routes::LIST_CLIENTE) !== false:
            $pageTitle = 'Listagem de clientes';
            $content = 'pages/listCliente.php';
            break;
        case strpos($request, Routes::EDIT_CLIENTE) !== false:
            $pageTitle = 'Edição de cliente';
            $content = 'pages/editCliente.php';
            break;
        case strpos($request, Routes::CAD_ALUNO) !== false:
            $pageTitle = 'Cadastro de alunos';
            $content = 'pages/cadStudent.php';
            break;
        case strpos($request, Routes::LIST_ALUNO) !== false:
            $pageTitle = 'Listagem de alunos';
            $content = 'pages/listStudent.php';
            break;
        case strpos($request, Routes::HOME) !== false:
            $pageTitle = 'Home';
            $content = 'pages/home.php';
            break;
        case strpos($request, Routes::HOME . '/') !== false:
            $pageTitle = 'Home';
            $content = 'pages/home.php';
            break;
        default:
            $pageTitle = 'Página não encontrada';
            $content = 'pages/404.php';
            break;
    }

    include('pages/header.php');
    include($content);
    include('pages/footer.php');

    // ---------------------------------------------------------- //

?>