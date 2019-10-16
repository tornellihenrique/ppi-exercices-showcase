<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msgErro = "";

    // Define e inicializa as variáveis
    $nome = $email = $estadoCivil = $diaNascimento = "";

    $nome = filtraEntrada($_POST["nome"]);
    $email = filtraEntrada($_POST["email"]);
    $estadoCivil = filtraEntrada($_POST["estadoCivil"]);
    $diaNascimento = filtraEntrada($_POST["diaNascimento"]);

    try {
        $conn = connect();

        $sql = "
		  INSERT INTO Cliente (ID, nome, email, estado_civil, dia_nascimento)
		  VALUES (null, '$nome', '$email', '$estadoCivil', $diaNascimento);
		";

        if (!$conn->query($sql)) {
            throw new Exception("Falha na inserção dos dados: " . $conn->error);
        }

    } catch (Exception $e) {
        $msgErro = $e->getMessage();
    }
}

?>

<h1 class="text-center">Cadastro de clientes</h1>

<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" placeholder="Informe seu nome" name="nome" id="nome" required>
    </div>

    <div class="form-group">
        <label for="">E-mail:</label>
        <input type="email" class="form-control" placeholder="Informe o e-mail" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="estadoCivil">Estado Civil:</label>
        <select name="estadoCivil" id="estadoCivil" class="form-control" required>
            <option value="solteiro">Solteiro</option>
            <option value="casado">Casado</option>
            <option value="viuvo">Viuvo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="diaNascimento">Dia do nascimento:</label>
        <input type="number" class="form-control" placeholder="Dia do mês do aniversário" name="diaNascimento"
            id="diaNascimento" required>
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
                    <strong>Sucesso!</strong> Cliente cadastrado com sucesso.
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