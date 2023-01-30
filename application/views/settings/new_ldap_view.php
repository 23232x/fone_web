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
<div ng-controller="ldap">
    <div class="title_pages">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações / Novo LDAP
    </div>
    <form class="forms" method = "post" action = "<?=base_url('settings/new_ldap')?>" name="form_new_ldap">
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Nome do LDAP</label>
                <input type="text" class="form-control" value="<?=$inputs['name']?>" name="name" placeholder="Digite um nome para o LDAP">
            </div>
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Domínio</label>
                <input type="text" class="form-control" value="<?=$inputs['domain']?>" name="domain" placeholder="Digite o domínio">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Servidor</label>
                <input type="text" class="form-control" value="<?=$inputs['server']?>" name="server" placeholder="Digite o servidor">
            </div>
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Porta</label>
                <input type="number" class="form-control" value="<?=$inputs['port']?>" name="port" placeholder="Digite a porta">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <span class="text-danger">* Campos obrigatórios</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
                <a href="<?= base_url('home') ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            </div>
        </div>
    </form>
</div>