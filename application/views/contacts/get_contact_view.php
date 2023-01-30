<div class="title_pages">
    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Editar Contato
</div>
<form class="forms" ng-controller="contacts">
    <div class="row">
        <div id="search" class="input-group col-md-12" >
            <span class="input-group-addon"> <i class="glyphicon glyphicon-search"></i> </span>
            <input type="text" name="typed" ng-model="form.typed" ng-keyup="get_contacts_view()" class="form-control" placeholder="Digite pelo menos três caracteres">
        </div>
        <div id="id_order">
            <h4> <span id="filtro_c" class="label label-primary">Ordenar por:</span> </h4>
            <a id="filtros_t" href="<?= base_url('contacts/get_contact') ?>"> <b> Todos </b> </a>            
            <a id="filtros_n" class="filtros_status_link" href="<?= base_url('contacts/order_by_name') ?>"> <b> Nome </b> </a>
        </div>
        <div ng-repeat="contact in contacts">
            <a href="update_contact/{{contact.id}}" ng-click="edit_info_contact(contact.id)" class="link_result">
                <div class="row_result">{{contact.name}} - {{contact.number}}</div>
            </a>
        </div>
</form>
