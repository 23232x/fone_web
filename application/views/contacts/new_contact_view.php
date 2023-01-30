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
<div ng-controller="new_contact">
    <div class="title_pages">
        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Novo contato
    </div>
    <form class="forms" method="post" action="<?= base_url('contacts/new_contact') ?>" name="form_new_contact" novalidate>
        <div class="row">
            <div class="form-group col-md-6">
                <label><span class="text-danger">*</span> Nome</label>
                <input type="text" name="name" value="<?= $inputs['name'] ?>" class="form-control" placeholder="Digite o nome">
            </div>
            <div class="form-group col-md-6">
                <label><span class="text-danger"></span> Email</label>
                <input type="email" name="email" value="<?= $inputs['email'] ?>" class="form-control" placeholder="Digite o email">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Secretaria</label>
                <select ng-change="get_departments()" ng-model="secretary" name="id_secretary" class="form-control" required>
                    <option value="<?= $inputs['id_secretary'] ?>"> Escolha sua Secretaria </option>
                    <?php
                    foreach ($secretary as $i) {
                        if ($inputs['id_secretary'] == $i->id) {
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
                <select ng-disabled="input_department" ng-model="departament_selected" name="id_department" class="form-control" required>
                    <option ng-repeat="department in departments" value="{{department.id}}">{{department.name}}</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label><span class="text-danger">*</span> Número ou ramal</label>
                <input type="text" name="number" value="<?= $inputs['number'] ?>" class="form-control" placeholder="Digite o número ou ramal">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input id="number_confidential" type="checkbox" name="confidential"> <label for="number_confidential">Contato confidencial</label>
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