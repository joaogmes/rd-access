

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idErro = null;
    $ticketErro = null;
    $typeErro = null;
    $codecoreErro = null;
    $codePrefixErro = null;
    $codeSufixErro = null;
    $authTypeErro = null;
    $rangStartErro = null;
    $rangeEndErro = null;
    $creationDateErro = null;
    $updateDateErro = null;

    if (!empty($_POST)) {
        $validacao = true;
        $novoUsuario = false;

        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            $idErro = 'Por favor, insira o ID!';
            $validacao = false;
        }

        if (!empty($_POST['ticket'])) {
            $ticket = $_POST['ticket'];
        } else {
            $ticketErro = 'Por favor, insira o ticket!';
            $validacao = false;
        }

        if (!empty($_POST['type'])) {
            $type = $_POST['type'];
        } else {
            $typeErro = 'Por favor, selecione um tipo!';
            $validacao = false;
        }

        if (!empty($_POST['codecore'])) {
            $codecore = $_POST['codecore'];
        } else {
            $codecoreErro = 'Por favor, insira o codecore!';
            $validacao = false;
        }

        if (!empty($_POST['codePrefix'])) {
            $codePrefix = $_POST['codePrefix'];
        } else {
            $codePrefixErro = 'Por favor, insira o codePrefix!';
            $validacao = false;
        }

        if (!empty($_POST['codeSufix'])) {
            $codeSufix = $_POST['codeSufix'];
        } else {
            $codeSufixErro = 'Por favor, insira o codeSufix!';
            $validacao = false;
        }

        if (!empty($_POST['authType'])) {
            $authType = $_POST['authType'];
        } else {
            $authTypeErro = 'Por favor, insira o authType!';
            $validacao = false;
        }

        if (!empty($_POST['rangStart'])) {
            $rangStart = $_POST['rangStart'];
        } else {
            $rangStartErro = 'Por favor, insira o rangStart!';
            $validacao = false;
        }

        if (!empty($_POST['rangeEnd'])) {
            $rangeEnd = $_POST['rangeEnd'];
        } else {
            $rangeEndErro = 'Por favor, insira o rangeEnd!';
            $validacao = false;
        }

        if (!empty($_POST['creationDate'])) {
            $creationDate = $_POST['creationDate'];
        } else {
            $creationDateErro = 'Por favor, insira a data de criação!';
            $validacao = false;
        }

        if (!empty($_POST['updateDate'])) {
            $updateDate = $_POST['updateDate'];
        } else {
            $updateDateErro = 'Por favor, insira a data de atualização!';
            $validacao = false;
        }
    }
}

//Inserindo no Banco:
if ($validacao) {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO sua_tabela (id, ticket, type, codecore, codePrefix, codeSufix, authType, rangStart, rangeEnd, creationDate, updateDate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $q = $pdo->prepare($sql);

    $q->execute(array($id, $ticket, $type, $codecore, $codePrefix, $codeSufix, $authType, $rangStart, $rangeEnd, $creationDate, $updateDate));

    Banco::desconectar();
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Ticket</title>
</head>

<body><div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group <?php echo !empty($idErro) ? 'error ' : ''; ?>">
                        <label class="control-label">ID</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="id" type="text" placeholder="ID"
                                value="<?php echo !empty($id) ? $id : ''; ?>">
                            <?php if (!empty($idErro)): ?>
                                <span class="text-danger"><?php echo $idErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($ticketErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Ticket</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="ticket" type="text" placeholder="Ticket"
                                value="<?php echo !empty($ticket) ? $ticket : ''; ?>">
                            <?php if (!empty($ticketErro)): ?>
                                <span class="text-danger"><?php echo $ticketErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($typeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Type</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="type" type="text" placeholder="Type"
                                value="<?php echo !empty($type) ? $type : ''; ?>">
                            <?php if (!empty($typeErro)): ?>
                                <span class="text-danger"><?php echo $typeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($codecoreErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Codecore</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="codecore" type="text" placeholder="Codecore"
                                value="<?php echo !empty($codecore) ? $codecore : ''; ?>">
                            <?php if (!empty($codecoreErro)): ?>
                                <span class="text-danger"><?php echo $codecoreErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($codePrefixErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Code Prefix</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="codePrefix" type="text" placeholder="Code Prefix"
                                value="<?php echo !empty($codePrefix) ? $codePrefix : ''; ?>">
                            <?php if (!empty($codePrefixErro)): ?>
                                <span class="text-danger"><?php echo $codePrefixErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($codeSufixErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Code Sufix</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="codeSufix" type="text" placeholder="Code Sufix"
                                value="<?php echo !empty($codeSufix) ? $codeSufix : ''; ?>">
                            <?php if (!empty($codeSufixErro)): ?>
                                <span class="text-danger"><?php echo $codeSufixErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($authTypeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Auth Type</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="authType" type="text" placeholder="Auth Type"
                                value="<?php echo !empty($authType) ? $authType : ''; ?>">
                            <?php if (!empty($authTypeErro)): ?>
                                <span class="text-danger"><?php echo $authTypeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($rangStartErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Rang Start</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="rangStart" type="text" placeholder="Rang Start"
                                value="<?php echo !empty($rangStart) ? $rangStart : ''; ?>">
                            <?php if (!empty($rangStartErro)): ?>
                                <span class="text-danger"><?php echo $rangStartErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($rangeEndErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Range End</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="rangeEnd" type="text" placeholder="Range End"
                                value="<?php echo !empty($rangeEnd) ? $rangeEnd : ''; ?>">
                            <?php if (!empty($rangeEndErro)): ?>
                                <span class="text-danger"><?php echo $rangeEndErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($creationDateErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Creation Date</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="creationDate" type="text" placeholder="Creation Date"
                                value="<?php echo !empty($creationDate) ? $creationDate : ''; ?>">
                            <?php if (!empty($creationDateErro)): ?>
                                <span class="text-danger"><?php echo $creationDateErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($updateDateErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Update Date</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="updateDate" type="text" placeholder="Update Date"
                                value="<?php echo !empty($updateDate) ? $updateDate : ''; ?>">
                            <?php if (!empty($updateDateErro)): ?>
                                <span class="text-danger"><?php echo $updateDateErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

