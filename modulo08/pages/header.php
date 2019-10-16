<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?></title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/ppi-activities/modulo08">PPI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link <?php if ($request == Routes::CAD_CLIENTE) echo 'active'; ?>"
                    href="<?=Routes::CAD_CLIENTE?>">Cadastro de clientes</a>
                <a class="nav-item nav-link <?php if ($request == Routes::LIST_CLIENTE) echo 'active'; ?>"
                    href="<?=Routes::LIST_CLIENTE?>">Listagem de clientes</a>
                <a class="nav-item nav-link <?php if ($request == Routes::CAD_ALUNO) echo 'active'; ?>"
                    href="<?=Routes::CAD_ALUNO?>">Cadastro de alunos</a>
                <a class="nav-item nav-link <?php if ($request == Routes::LIST_ALUNO) echo 'active'; ?>"
                    href="<?=Routes::LIST_ALUNO?>">Listagem de alunos</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3">