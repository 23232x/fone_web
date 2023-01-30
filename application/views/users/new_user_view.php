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
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Novo usuário
    </div>
    <form class="forms" method ="post" action="<?=base_url('users/new_user')?>" name="form_new_user">
        <div class="row">
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Nome</label>
                <input type="text" value="<?=$inputs['name']?>" name="name" class="form-control" placeholder="Digite o nome">
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Usuário no LDAP</label>
                <input type="text" value="<?=$inputs['user_ldap']?>" name="user_ldap" class="form-control" placeholder="Digite o usuário conforme o LDAP">
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span>LDAP</label>
                <select name="id_ldap" class="form-control">
                    <option value="<?=$inputs['id_ldap']?>" >Selecione um LDAP</option>
                <?php
                foreach ($ldap as $i){
                    if($inputs['id_ldap'] == $i->id){
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
                        foreach ($permission as $i) {
                            if($i->id){
                            ?>
                                <input name="permissions[<?=$i->id?>]" id="<?= $i->name . $i->id ?>" type="checkbox"  > <label for="<?= $i->name . $i->id ?>"><?= $i->name ?></label>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input id="user_inactive" type="checkbox" value="<?=$inputs['status']?>" name="inactive"> <label for="user_inactive">Usuário inativo</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <span class="text-danger">* Campos obrigatórios</span>
            </div>
        </div>
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a href="<?= base_url('home') ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
    </form>
</div>