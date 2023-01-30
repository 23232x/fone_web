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
    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Visualização do Contato
</div>
<form class="forms" name="form_update_contact" method="post" action = "<?=base_url('contacts/update_contact')?>" novalidate>
    <input type="hidden" name="id" value="<?= $contacts->id ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger"></span> Nome</label>
                <input type="text" name="name" value="<?= $contacts->name ?>" class="form-control" placeholder="Digite o nome" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" value="<?= $contacts->email ?>" class="form-control" placeholder="Digite o email" disabled>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label><span class="text-danger"></span> Secretaria</label>
                <select name="id_secretary" class="form-control" disabled>
                    <option value="<?= $contacts->id_secretary ?>" > </option>
                    <?php
                    foreach ($secretary as $i){
                        if($contacts->secretary == $i->id){
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
        <div class="form-group col-md-4">
            <label>Departamento ou setor ou seção</label>
            <input type="text" name="departament" value="<?= $contacts->department_name ?>" class="form-control" placeholder="Digite o departamento ou setor ou seção" disabled>
        </div>
        <div class="form-group col-md-4">
            <label><span class="text-danger"></span> Número ou ramal</label>
            <input type="text" name="number" value="<?= $contacts->number ?>" class="form-control" placeholder="Digite o número ou ramal" disabled>
        </div>
    </div>
        <div class="row">
            <div class="form-group col-md-3">
                <?php
                    if($contacts->confidential == 1){
                        ?>
                        <input checked="true" id="number_confidential" value="0 <?= $contacts->confidential ?>" type="checkbox" name="confidential"> <label for="number_confidential">Contato confidencial</label>
                        <?php
                    }else{                        
                        ?>
                        <input id="number_confidential" value="1 <?= $contacts->confidential ?>" type="checkbox" name="confidential"> <label for="number_confidential">Contato confidencial</label>
                        <?php
                    }
                ?>
            </div>
        </div>
    <!-- <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button> -->
    <a href="<?= base_url('contacts/get_contact') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
</form>