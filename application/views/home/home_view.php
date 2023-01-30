<div ng-controller="contacts">
    <div class="row">
        <div id="input_search">
            <div id="instructions_home">
                <span class="instructions_home_spotligh">Encontre o ramal ou telefone desejado</span><br />
                Busque por nome, setor, departamento ou secretaria
            </div>
            <div class="form-group col-md-12">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                    <input type="text" name="typed" ng-model="form.typed" ng-keyup="get_contacts()" class="form-control input_search" placeholder="Digite pelo menos três caracteres" autofocus>
                </div>
                <div id="box_result">
		    <div ng-repeat="contact in contacts">
			<div ng-if="contact.status == 1">
                            <a href="javascript:void(0)" ng-click="get_info_contact(contact.id)" class="link_result" data-toggle="modal" data-target="#modal_date_contact">
                                <div class="row_result">
                                    <div class="row_result_data">
                                        {{contact.name}}
                                        <br /><span class="row_result_secretary">{{contact.department_name}}</span>
                                        <br /><span class="row_result_secretary">Secretaria {{contact.secretary}}</span>
                                    </div>
                                    <div class="row_result_number">
                                        <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> {{contact.number}}
                                    </div>
                                </div>
			    </a>
                        </div>
                    </div>
                </div>
                <div id="btn_search">
                    <button onclick="show_contacts()" class="btn btn-default">Ver lista completa de telefones</button>
                </div>
                <div id="instructions_footer">
                    Alterações e sugestões, enviar email para <strong>chamado@sapiranga.rs.gov.br</strong>
                </div>
            </div>
        </div>
        <?php
        foreach ($contacts as $contact) {
        ?>
            <div class="secretary_contacts">
                <div class="secretary_contacts_title"><?= mb_strtoupper($contact['secretary']->name) ?></div>
                <?php
                foreach ($contact['data_contacts'] as $data_contact) {
                    if ($data_contact->general_secretary) {
                ?>
                        <div class="row_contact">
                            <div class="row_contact_default row_contact_department row_general_secretary">
                                <?= mb_strtoupper($data_contact->department_name) ?>
                            </div>
                            <div class="row_contact_default row_contact_name row_general_secretary">
                                <?= mb_strtoupper($data_contact->name) ?>
                            </div>
                            <div class="row_contact_default row_contact_number row_general_secretary">
                                <?= $data_contact->number ?>
                            </div>
                        </div>
                    <?php

                    } else {
                    ?>
                        <div class="row_contact">
                            <div class="row_contact_default row_contact_department">
                                <?= $data_contact->department_name ?>
                            </div>
                            <div class="row_contact_default row_contact_name">
                                <?= $data_contact->name ?>
                            </div>
                            <div class="row_contact_default row_contact_number">
                                <?= $data_contact->number ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!--************ INICIO DOS MODAIS ************-->
        <div class="modal fade" id="modal_date_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel"><b>Contato</b></h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <!-- <h4> <b>Id:</b> {{info_contact.id}}</h4>  -->
                                    <h4> <b> Nome: </b> {{info_contact.name}}</h4>
                                    <h4> <b> E-mail: </b> {{info_contact.email}}</h4>
                                    <h4> <b> Departamento: </b> {{info_contact.department_name}}</h4>
                                    <h4> <b> Secretaria: </b> {{info_contact.name_secretary}}</h4>
                                    <h4> <b> Número: </b> {{info_contact.number}}</h4>
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
        <!--************ TELA DE LOGIN ************-->
        <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" method="post" action="<?= base_url('login/authentication') ?>">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger alert-dismissible" id="msg_valida_login" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Aviso!</strong>
                            <div id="return_valida_login"></div>
                            <?php if (isset($mensagem_falha)) { ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Aviso!</strong> <?php echo $mensagem_falha; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Usuário</label>
                                    <input type="text" class="form-control" id="user_ldap" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" id="passwd_ldap" placeholder="Senha">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" id="button_login" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Entrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************ MODAL USER ************-->
    <!-- <div class="modal fade" id="modal_date_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <h4> <b> Id: </b> {{info_user.id}}</h4> 
                            <h4> <b> Nome: </b> {{info_user.name}}</h4> 
                            <h4> <b> Usuário LDAP: </b> {{info_user.user_ldap}}</h4>
                            <h4> <b> LDAP: </b> {{info_user.name_ldap}}</h4>
                            <h4> <b> Permissões: </b> {{info_user.name_permission}}</h4>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                <button type="button" ng-click="ok()" class="btn btn-primary">Salvar mudanças</button> 
            </div>
        </div>
    </div>
</div>  -->
