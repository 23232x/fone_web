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
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações / Editar LDAP
    </div>
    <form class="forms" name="form_remake_ldap" method="post" action = "<?=base_url('settings/remake_ldap')?>" novalidate>
    <input type="hidden" name="id" value="<?= $ldap->id ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Nome do LDAP</label>
                <input type="text" class="form-control" name="name" value="<?= $ldap->name ?>" required placeholder="Digite um nome para o LDAP">
            </div>
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Domínio</label>
                <input type="text" class="form-control" name="domain" value="<?= $ldap->domain ?>" required placeholder="Digite o domínio">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Servidor</label>
                <input type="text" class="form-control" name="server" value="<?= $ldap->server ?>" required placeholder="Digite o servidor">
            </div>
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Porta</label>
                <input type="number" class="form-control" name="port" value="<?= $ldap->port ?>" required placeholder="Digite a porta">
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
                <a href="<?= base_url('settings/update_ldap') ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            </div>
        </div>
    </form>
</div>