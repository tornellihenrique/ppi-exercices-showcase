<?php

function getAlunos($conn) {
    $arrayAlunos = null;

    $SQL = "SELECT * FROM Aluno ORDER BY nome ASC";

    $result = $conn->query($SQL);
    if (!$result) {
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aluno = new Aluno();

            $aluno->matricula = $row["matricula"];
            $aluno->nome = $row["nome"];
            $aluno->sexo = $row["sexo"];

            $arrayAlunos[] = $aluno;
        }
    }

    return $arrayAlunos;
}

if (isset($_POST['matricula'])) {
    $matricula = filtraEntrada($_POST["matricula"]);

    try {
        $conn = connect();

        $sql = "
			DELETE 
			FROM Aluno
			WHERE matricula = $matricula 
		";

        if (!$conn->query($sql))
            throw new Exception("Falha na remocao: " . $conn->error);
        
        header("Refresh:0");
    } catch (Exception $e) {
        echo "Nao foi possivel excluir o aluno: ", $e->getMessage();
    }
}

try {
    $conn = connect();
    $arrayAlunos = getAlunos($conn);
} catch (Exception $e) {
    $msgErro = $e->getMessage();
}

?>

<h1 class="text-center">Listagem de alunos</h1>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th>Sexo</th>
        </tr>
    </thead>

    <tbody>
        <?php
            if ($arrayAlunos != null) {
                foreach ($arrayAlunos as $aluno) {
                    $sexo = $aluno->sexo == 'm' ? 'Masculino' : 'Feminino';
                    echo "
                        <tr>
                            <td>$aluno->matricula</td>
                            <td>$aluno->nome</td>
                            <td>$sexo</td>
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
                    <strong>Sucesso!</strong> Aluno deletado com sucesso.
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