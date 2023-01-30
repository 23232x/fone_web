<div class="title_pages">
    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Editar usuário
</div>
<form class="forms">
    <table class="table table-striped" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="title_from">
                <th> # </th>
                <th> Nome </th>
                <th> Usuário LDAP </th>                
                <th> Status </th>
                <th> Ação </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($users as $i){
                    ?>
                    <tr>
                        <td> <b> <?=$i->id?> </b> </td>
                        <td> <?=$i->name?> </td>
                        <td> <?=$i->user_ldap?> </td>
                        <td> Ativo </td>
                        <td>
                        <a class="btn btn-primary btn-xs" href="<?= base_url('users/update_user/' . $i->id) ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                        <a class="btn btn-info btn-xs" href="<?= base_url('users/visualizar_user/' . $i->id) ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>                   
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
<div class="col-md-12">
    <ul id="pagination">
        <?= $paginacao ?> 
    </ul>
    <div id="numero_registros">Total de Usuários: <strong><?= $numero_registros ?></strong></div>
</div>
</form>