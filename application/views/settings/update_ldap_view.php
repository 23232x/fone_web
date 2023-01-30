<div class="title_pages">
    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Editar LDAP
</div>
<form class="forms">
    <table class="table table-striped" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="title_from">
                <th> # </th>
                <th> Nome LDAP </th>
                <th> Domínio </th>
                <th> Servidor </th>
                <th> Porta </th>
                <th> Status </th>
                <th> Editar </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($ldap as $i){
                    ?>
                    <tr>
                        <td> <b> <?=$i->id?> </b> </td>
                        <td> <?=$i->name?> </td>
                        <td> <?=$i->domain?> </td>
                        <td> <?=$i->server?> </td>
                        <td> <?=$i->port?> </td>
                        <td> <?=$i->status?> </td>
                        <td>
                        <a class="btn btn-primary btn-xs" href="<?= base_url('settings/remake_ldap/' . $i->id) ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</form>