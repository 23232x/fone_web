<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Prefeitura Municipal Sapiranga</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "<?= base_url("css/style.css") ?>">
        <link rel = "stylesheet" type = "text/css" href = "<?= base_url("bootstrap/css/bootstrap.css") ?>">
        <link rel="shortcut icon" href="<?= base_url("img/favicon.ico") ?>" />
        <script src="<?= base_url("js/jquery.js") ?>"></script>
        <script src="<?= base_url("bootstrap/js/bootstrap.min.js") ?>"></script>
        <script src="<?= base_url("js/functions_various.js") ?>"></script>
    </head>
    <body>
        <div id="loading"><img src="<?= base_url("/img/load-page.gif") ?>"></div>
        <div id="main">
            <div id="top">
                <div id="logo"> <img src="<?= base_url("/img/brasao.png") ?>"></div>
                <div id="tiraTopTitle">Prefeitura Municipal de Sapiranga | Fone Web v1.0</div>
            </div>
            <div id="contents">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Aviso!</strong> <?php echo $error; ?>
                    </div>
                <?php } ?>
                <div id="login">
                    <form method="post" action="<?= base_url('login/authentication') ?>">
                        <div class="panel panel-default">
                            <div class="panel-heading">Login</div>
                            <div class="panel-body">
                                <label class="label-form-padrao">Usuário</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="user" placeholder="Usuário" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                </div>
                                <label class="label-form-padrao">Senha</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Senha" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                                </div>
                                <div id="bnt-login-entrar" class="btn-group" role="group" aria-label="...">
                                <button type="submit" onclick="login()" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Entrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>