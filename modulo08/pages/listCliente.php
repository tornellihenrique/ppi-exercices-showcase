<?php

function getClientes($conn) {
    $arrayClientes = null;

    $SQL = "SELECT * FROM Cliente ORDER BY nome ASC";

    $result = $conn->query($SQL);
    if (!$result) {
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cliente = new Cliente();

            $cliente->id = $row["ID"];
            $cliente->nome = $row["nome"];
            $cliente->email = $row["email"];
            $cliente->estadoCivil = $row["estado_civil"];
            $cliente->diaNascimento = $row["dia_nascimento"];

            $arrayClientes[] = $cliente;
        }
    }

    return $arrayClientes;
}

if (isset($_POST['id'])) {
    $id = filtraEntrada($_POST["id"]);

    try {
        $conn = connect();

        $sql = "
			DELETE 
			FROM Cliente
			WHERE Id = $id 
		";

        if (!$conn->query($sql))
            throw new Exception("Falha na remocao: " . $conn->error);
        
        header("Refresh:0");
    } catch (Exception $e) {
        echo "Nao foi possivel excluir o cliente: ", $e->getMessage();
    }
}

try {
    $conn = connect();
    $arrayClientes = getClientes($conn);
} catch (Exception $e) {
    $msgErro = $e->getMessage();
}

?>

<h1 class="text-center">Listagem de clientes</h1>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Estado Civil</th>
            <th>Dia Nascimento</th>
            <th>Ação</th>
        </tr>
    </thead>

    <tbody>
        <?php
            $route = Routes::EDIT_CLIENTE;
            if ($arrayClientes != null) {
                foreach ($arrayClientes as $cliente) {
                    echo "
                        <tr>
                            <td>$cliente->nome</td>
                            <td>$cliente->email</td>
                            <td>$cliente->estadoCivil</td>
                            <td>$cliente->diaNascimento</td>
                            <td>
                                <div class='d-flex justify-content-between'>
                                    <button class='btn btn-danger' onclick='excluirCliente($cliente->id)'>Excluir</button>
                                    <a class='btn btn-primary' href='$route?cliente=$cliente->id'>Editar</a>
                                </div>
                            </td>
                        </tr>
                    ";
                }
            }
        ?>
    </tbody>
</table>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($msgErro == "") {
        echo <<<HTML
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <strong>Sucesso!</strong> Cliente deletado com sucesso.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            HTML;
    } else {
        echo <<<HTML
                <div class="alert alert-dager alert-dismissible fade show mt-5" role="alert">
                    <strong>Erro!</strong> $msgErro
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            HTML;
    }
}
?>

<script>
    function excluirCliente(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>',
            data: {
                id: id
            },
            success: () => {
                document.location.reload(true);
            }
        });
    }
</script>