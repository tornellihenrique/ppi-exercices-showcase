<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msgErro = "";

    // Define e inicializa as variáveis
    $matricula = $nome = $sexo = "";

    $matricula = filtraEntrada($_POST["matricula"]);
    $nome = filtraEntrada($_POST["nome"]);
    $sexo = filtraEntrada($_POST["sexo"]);

    try {
        $conn = connect();

        $SQL = "
		  INSERT INTO Aluno (matricula, nome, sexo)
		  VALUES ('$matricula', '$nome', '$sexo');
		";

        if (!$conn->query($SQL)) {
            throw new Exception("Falha na inserção dos dados: " . $conn->error);
        }

    } catch (Exception $e) {
        $msgErro = $e->getMessage();
    }
}

?>

<h1 class="text-center">Cadastro de alunos</h1>

<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST">
    <div class="form-group">
        <label for="matricula">Matricula:</label>
        <input type="text" class="form-control" placeholder="Informe sua matrícula" name="matricula" id="matricula" required>
    </div>

    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" placeholder="Informe o nome" name="nome" id="nome" required>
    </div>

    <div class="form-group">
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" class="form-control" required>
            <option value="m">Masculino</option>
            <option value="f">Feminino</option>
        </select>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-secondary">Limpar</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($msgErro == "") {
        echo <<<HTML
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <strong>Sucesso!</strong> Aluno cadastrado com sucesso.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            HTML;
    } else {
        echo <<<HTML
                <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                    <strong>Erro!</strong> $msgErro
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            HTML;
    }
}
?>