<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de dados</title>

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
<body class="d-flex align-items-center">
    <div class="container">
        <table class="table table-dark table-striped table-hover">
            <?php
                $dados = array('SP', 'MG', 'SC', 'CU', 'MT', 'RJ');

                foreach ($dados as $dado) {
                    echo "<tr><td>$dado</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>