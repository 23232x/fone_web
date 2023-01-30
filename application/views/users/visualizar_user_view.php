<?php
    if(!empty($erros['message'])){
    ?>
        <div class="alert alert-danger" role="alert">
        <?=$erros['message']?>
        </div>
    <?php
    }
    if(!empty($success['message'])){
    ?>
        <div class="alert alert-success" role="alert">
        <?=$success['message']?>
        </div>
    <?php
    }
?>
<div class="title_pages">
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Visualização de usuário
    </div>
    <form class="forms" method ="post" action="<?=base_url('users/update_user')?>" name="form_update_user">
    <input type="hidden" name="id" value="<?= $users->id ?>">
        <div class="row">
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Nome</label>
                <input type="text" value="<?= $users->name ?>" name="name" class="form-control" placeholder="Digite o nome" disabled>
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Usuário no LDAP</label>
                <input type="text" value="<?= $users->user_ldap ?>" name="user_ldap" class="form-control" placeholder="Digite o usuário conforme o LDAP" disabled>
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span>LDAP</label>
                <select name="id_ldap" class="form-control" disabled>
                    <option value="<?= $users->id_ldap ?>" >Selecione um LDAP</option>
                <?php
                foreach ($ldap as $i){
                    if($users->id_ldap == $i->id){
                        ?>
                            <option selected value="<?=$i->id?>"> <?=$i->name?> </option>
                        <?php
                    }else{
                        ?>
                            <option value="<?=$i->id?>"> <?=$i->name?> </option>
                        <?php
                    }
                }
                ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Permissões</label>
                <div id="permissions_users">
                    <div class="row">
                        <!-- <input id="permission_number_confidential" type="checkbox" name="permission_number_confidential" value="1"> <label for="permission_number_confidential">Acesso a números confidenciais</label><br/>
                        <input id="permission_new_contatct" type="checkbox" name="permission_new_contatct" value="1"> <label for="permission_new_contatct">Criação de contatos</label><br/>
                        <input id="permission_update_contatct" type="checkbox" name="permission_update_contatct" value="1"> <label for="permission_update_contatct">Edição de contatos</label><br/>
                        <input id="permission_new_user" type="checkbox" name="permission_new_user" value="1"> <label for="permission_new_user">Criar usuários</label><br/>
                        <input id="permission_update_user" type="checkbox" name="permission_update_user" value="1"> <label for="permission_update_user">Editar usuários</label><br/>
                        <input id="permission_settings" type="checkbox" name="permission_settings" value="1"> <label for="permission_settings">Gerenciar configurações</label><br/> -->
                        <?php
                        foreach ($permission as $p) {
                            // if($p->id){
                                $checked = 0;
                                foreach ($users_p as $u) {
                                    if ($u->id_permission == $p->id) {
                                        ?>
                                            <input checked="true" name="permissions[<?=$p->id?>]" id="<?= $p->name . $p->id ?>" type="checkbox"  > <label for="<?= $p->name . $p->id ?>"><?= $p->name ?></label>
                                            <?php
                                            $checked++;
                                        }
                                    }
                                    if ($checked == 0) {
                                        ?>
                                            <input name="permissions[<?=$p->id?>]" id="<?= $p->name . $p->id ?>" type="checkbox"  > <label for="<?= $p->name . $p->id ?>"><?= $p->name ?></label>
                                        <?php
                                    }
                                // }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input id="user_inactive" type="checkbox" value="<?= $users->user_inactive ?>" name="inactive"> <label for="user_inactive">Usuário inativo</label>
            </div>
        </div>
        <a href="<?= base_url('users/get_user') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    </form>
</div>