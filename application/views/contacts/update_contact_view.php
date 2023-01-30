<?php
if (!empty($erros['message'])) {
?>
    <div class="alert alert-danger" role="alert">
        <?= $erros['message'] ?>
    </div>
<?php
}
if (!empty($success['message'])) {
?>
    <div class="alert alert-success" role="alert">
        <?= $success['message'] ?>
    </div>
<?php
}
?>
<div class="title_pages">
    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Editar Contato
</div>
<div ng-controller="update_contact">
    <form class="forms" name="form_update_contact" method="post" action="<?= base_url('contacts/update_contact') ?>" novalidate>
        <input type="hidden" name="id" value="<?= $contacts->id ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Nome</label>
                <input type="text" name="name" value="<?= $contacts->name ?>" class="form-control" placeholder="Digite o nome">
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" value="<?= $contacts->email ?>" class="form-control" placeholder="Digite o email">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Secretaria</label>
                <select ng-change="get_departments()" ng-model="secretary" name="id_secretary" id="secretary_selected" class="form-control">
                    <option value="<?= $contacts->id_secretary ?>"> </option>
                    <?php
                    foreach ($secretary as $i) {
                        if ($contacts->secretary == $i->id) {
                    ?>
                            <option selected value="<?= $i->id ?>"> <?= $i->name ?> </option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $i->id ?>"> <?= $i->name ?> </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Departamento, setor ou seção</label>
                <input type="hidden" id="department_selected" value="<?= $contacts->department ?>">
                <select ng-disabled="input_department" ng-model="departament_selected" name="id_department" class="form-control" required>
                    <option ng-if="departament_selected == department.id" selected="selected" ng-repeat="department in departments" value="{{department.id}}">{{department.name}}</option>
                    <option ng-if="departament_selected != department.id" ng-repeat="department in departments" value="{{department.id}}">{{department.name}}</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Número ou ramal</label>
                <input type="text" name="number" value="<?= $contacts->number ?>" class="form-control" placeholder="Digite o número ou ramal">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <?php
                if ($contacts->confidential == 1) {
                ?>
                    <input checked="true" id="number_confidential" type="checkbox" name="confidential"> <label for="number_confidential">Contato confidencial</label>
                <?php
                } else {
                ?>
                    <input id="number_confidential" type="checkbox" name="confidential"> <label for="number_confidential">Contato confidencial</label>
                <?php
                }
                ?>
            </div>
	</div>
        <div class="row">
            <div class="form-group col-md-3">
                <?php
                if ($contacts->status == 1) {
                ?>
                    <input checked="true" id="status" type="checkbox" name="status"> <label for="status">Ativo</label>
                <?php
                } else {
                ?>
                    <input id="status" type="checkbox" name="status"> <label for="status">Ativo</label>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <span class="text-danger">* Campos obrigatórios</span>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a href="<?= base_url('contacts/get_contact') ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
    </form>
</div>
