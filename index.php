<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal videos</title>
</head>

<body>
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=aula_youtube', 'root', '');

    if(isset($_POST['acao'])){
        //dados do form
        $nome = strip_tags($_POST['nome']); //strip limpa todas as possiveis tags
        $link = strip_tags($_POST['link']);

        $sql = $pdo->prepare("INSERT INTO `TD.AULAS` VALUES (null,?,?)");

        if($sql->execute(array($nome, $link))){
            echo '<script>alert("Vídeo inserido com sucesso")</script>';

        } else{
            die("Error");
        };


    };

    $sql = $pdo->prepare("SELECT * FROM `td.aulas`");

    $sql->execute();

    $aulas = $sql->fetchAll();

    foreach ($aulas as $key => $value) {
        echo $value['nome'];
        echo '<hr>';
        echo '<iframe width="400" heigth"400" src"' . $value['link_aula'] . '"></iframe>';
    };
    ?>
    <h3>Inisira um vídeo aqui!</h3>
    <form method="post">
        <input type="text" name="nome" placeholder="nome do seu video...">
        <input type="text" name="link" placeholder="link do seu vídeo...">
        <input type="submit" name="acao" value="Cadastrar!">
    </form>

</body>

</html>