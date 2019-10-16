<h1 class="text-center">Edição de cliente</h1>

<?php

$cliente = new Cliente();

if ($_GET['cliente']) {
    $msgErro = "";

    try {
        $conn = connect();

        $clienteID = $_GET['cliente'];

        $SQL = "SELECT * FROM Cliente WHERE ID = $clienteID";

        $result = $conn->query($SQL);

        if (!$result) {
            throw new Exception('Cliente não encontrado: ' . $conn->error);
        }

        $row = $result->fetch_assoc();

        $cliente->id = $row["ID"];
        $cliente->nome = $row["nome"];
        $cliente->email = $row["email"];
        $cliente->estadoCivil = $row["estado_civil"];
        $cliente->diaNascimento = $row["dia_nascimento"];
    } catch (Exception $e) {
        $msgErro = $e->getMessage();
    }
}

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
          UPDATE Cliente
          SET nome = '$nome', email = '$email', estado_civil = '$estadoCivil', dia_nascimento = $diaNascimento
          WHERE ID = $clienteID
		";

        if (!$conn->query($sql)) {
            throw new Exception("Falha na atualização dos dados: " . $conn->error);
        }

        header("Location: " . Routes::LIST_CLIENTE);

    } catch (Exception $e) {
        $msgErro = $e->getMessage();
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="POST">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" placeholder="Informe seu nome" name="nome" id="nome"
            value="<?=$cliente->nome?>" required>
    </div>

    <div class="form-group">
        <label for="">E-mail:</label>
        <input type="email" class="form-control" placeholder="Informe o e-mail" name="email" id="email"
            value="<?=$cliente->email?>" required>
    </div>

    <div class="form-group">
        <label for="estadoCivil">Estado Civil:</label>
        <select name="estadoCivil" id="estadoCivil" class="form-control"
            value="<?=$cliente->estadoCivil?>" required>
            <option value="solteiro">Solteiro</option>
            <option value="casado">Casado</option>
            <option value="viuvo">Viuvo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="diaNascimento">Dia do nascimento:</label>
        <input type="number" class="form-control" placeholder="Dia do mês do aniversário" name="diaNascimento"
            id="diaNascimento"  value="<?=$cliente->diaNascimento?>" required>
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