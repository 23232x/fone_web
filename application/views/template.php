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
    <link rel="stylesheet" type="text/css" href="<?= base_url("css/style.css") ?>">
    <link rel="shortcut icon" href="<?= base_url("img/favicon.ico") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("bootstrap/css/bootstrap.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("bootstrap/css/bootstrap-datepicker.css") ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?= base_url("js/jquery.js") ?>"></script>
    <script src="<?= base_url("js/odometer.js") ?>"></script>
    <script src="<?= base_url("bootstrap/js/bootstrap-datepicker.js") ?>"></script>
    <script src="<?= base_url("bootstrap/js/bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("js/functions_various.js") ?>"></script>
    <script src="<?= base_url("js/angular.js") ?>"></script>
    <script src="<?= base_url("js/app.js") ?>"></script>
</head>

<body ng-app="fone_web">
    <div id="loading"><img src="<?= base_url("/img/load-page.gif") ?>"></div>
    <div id="main">
        <div id="support">
            Software de gerenciamento de telefones - Versão 1.20.10.23
        </div>
        <div id="top">
            <div id="logo">
                <div id="logo_img">
                    <a href=<?= base_url('home') ?>> <img src="<?= base_url("/img/brasao.png") ?>"></a>
                </div>
            </div>
            <?php
            if (LOGGED) {
            ?>
                <div id="menu_admin">
                    <div id="buttons_menu">
                        <div class="btn-group">
                            <button onclick="location.href = '<?= base_url('') ?>'" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-search"></span> Consulta de contatos
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-phone"></span> Contatos <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('contacts/new_contact') ?>">Novo Contato</a></li>
                                <li><a href="<?= base_url('contacts/get_contact') ?>">Editar/Visualizar Contatos</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> Usuários <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('users/new_user') ?>">Novo Usuário</a></li>
                                <li><a href="<?= base_url('users/get_user') ?>">Editar/Visualizar Usuários</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-cog"></span> Configurações <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('settings/new_ldap') ?>">Novo LDAP</a></li>
                                <li><a href="<?= base_url('settings/update_ldap') ?>">Editar LDAP</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-list-alt"></span> Log's e estatísticas <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('logs/get_logs') ?>">Log's</a></li>
                                <li><a href="<?= base_url('logs/statistical_access_log') ?>">Estatísticas de acesso gerais</a></li>
                                <li><a href="<?= base_url('logs/get_logs_acesso') ?>">Estatísticas de acesso admin</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="logoff">
                        <a href="<?= base_url('logoff') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
                    </div>
                    <div ng-controller="users">
                        <!-- <div id="tiraTopUser">  -->
                        <a href="javascript:void(0)" id="tiraTopUser" ng-click="get_user_by_id(<?= $this->session->userdata('id_user'); ?>) + get_permission_user_by_id(<?= $this->session->userdata('id_user'); ?>)" class="link_result" data-toggle="modal" data-target="#modal_date_user">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $this->session->userdata('user'); ?>
                        </a>
                        <!-- </div> -->
                        <div class="modal fade" id="modal_date_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 class="modal-title" id="myModalLabel"><b>Usuário</b></h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <!-- <h4> <b> Id: </b> {{info_user.id}}</h4>  -->
                                                    <h4> <b> Nome: </b> {{info_user.name}}</h4>
                                                    <h4> <b> Usuário LDAP: </b> {{info_user.user_ldap}}</h4>
                                                    <h4> <b> LDAP: </b> {{info_user.name_ldap}}</h4>
                                                    <h4> <b> Permissões: </b> </h4>
                                                    <div ng-repeat="permission in permissions">
                                                        <h4> <i class="material-icons">verified_user</i> {{permission.name}} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div id="icon_login">
                    <a data-toggle="modal" data-target="#modal_login" href=""><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
                </div>
            <?php
            }
            ?>
        </div>
	<div id="contents">
            <?php
            if ($this->session->flashdata('msg_success') != NULL) {
            ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('msg_success') ?></div>
            <?php
            }
            ?>
            <?= $contents; ?>
	</div>
        <div id="footer">
            DESENVOLVIDO PELO<br>
            <img src="<?= base_url("/img/ti.png") ?>">
        </div>
    </div>
</body>

</html>
