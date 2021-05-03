<?php
    include '../../controladores/autenticacao_usuario.php';
    if(isset($_POST['btn-submit'])):
        $identificacao = mysqli_escape_string($conexao, $_POST['i']);
        $baias = mysqli_escape_string($conexao, $_POST['qb']);
        $funcao = mysqli_escape_string($conexao, $_POST['f']);
        $sql = "INSERT INTO galpao(identificacao, qtde_baias, funcao, total_porcos) VALUES ('$identificacao', '$baias', '$funcao', 0)";
        $salvar = mysqli_query($conexao, $sql);
        $conferir = "SELECT identificacao FROM galpao WHERE identificacao = '$identificacao'";
        $resultado = mysqli_query($conexao, $conferir);
        if(mysqli_num_rows($resultado) == 1):
            $cadastro_realizado = "<script> var cadastro = 'Cadastro realizado com sucesso'; </script>";
            echo $cadastro_realizado;
            echo "<script> alert(cadastro); </script>";
        endif;
    endif;
    require_once '../../controladores/verificar_cargo.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<meta charset = "UTF-8">
		<title> Pagina inicial </title>
		<?php include '../../includes/head.php'; ?>
	</head>
    <body class="gradiente">
        <div class="container">
            <?php include $bs; ?>
            <div class="row">
                <?php include $bl; ?>
                <div class=" offset-md-3 offset-lg-3 col-md-9 col-lg-9 bg-light">
                    <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1 class="h3 mb-3 font-weight-normal"> Cadastro de Galpões </h1>
                        <label for="identificacao" class="sr-only"> Identificação </label>
                        <input type="text" name="i" id="identificacao" class="form-control" placeholder="Identificação" required>
                        <label for="baias" class="sr-only"> Quantidade de Baias </label>
                        <input type="text" name="qb" id="baias" class="form-control" placeholder="Quantidade de Baias" required>
                        <label for="funcao"> Informe a função desse galpão: </label>
                        <select class="form-control" name="f" id="funcao">
                            <option value=""> Selecione </option>
                            <option value="Maternidade"> Maternidade </option>
                            <option value="Creche"> Creche </option>
                            <option value="Terminacao"> Terminação </option>
                            <option value="Quarentena"> Quarentena </option>
                        </select>
                        <button class="btn btn-lg btn-outline-primary btn-block" type="submit" name="btn-submit"> Cadastrar-se </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    mysqli_close($conexao);
    unset($conexao);
?>