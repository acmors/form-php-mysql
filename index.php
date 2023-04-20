<?php

$mensagem = "Preencha o formulário";
$nome = "";
$email = "";
$msg = "";

if (isset($_POST['nome'], $_POST['email'], $_POST['msg'])) {
    $conn = new PDO("mysql:host=localhost;dbname=formulario", "root");
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $msg = htmlspecialchars($_POST['msg']);


    if (!$nome || !$email || !$msg) {
        $mensagem = "Dados inválidos!";
    } else {
        $smt = $conn->prepare('INSERT INTO cadastros(nome, email, msg) VALUES (:nome, :email, :msg)');
        $smt->bindParam('nome', $nome);
        $smt->bindParam('email', $email);
        $smt->bindParam('msg', $msg);
        $smt->execute();


        $mensagem = "Mensagem enviada com sucesso!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contato</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="men">
                <p><?= $mensagem ?></p>
            </div>
            <label id="nome" for="">Nome: </label>
            <input type="text" name="nome" required placeholder="Digite seu nome...">

            <label for="">Email: </label>
            <input type="email" name="email" required placeholder="Digite seu email...">

            <label for="">Mensagem</label>
            <textarea name="msg" cols="30" rows="7"></textarea>

            <button type="submit">Enviar</button>
        </form>

    </div>



</body>

</html>