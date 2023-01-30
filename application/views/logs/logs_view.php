<div class="title_pages">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Log's
</div>
<form class="forms">
    <div id="filtro_chamados">
        <form method="post" action="<?= base_url('logs/filtros') ?>">
            <div class="well well-sm" id="filtros_status">
                <h4> <span id="filtro" class="label label-primary">Filtros:</span> </h4>
                <a class="filtros_status_link" href="<?= base_url('logs/get_logs') ?>"> <b> Todos </b> </a>
                <a class="filtros_status_link" href="<?= base_url('logs/get_logs_inserted') ?>"> <b> Inseridos </b> </a>
                <a class="filtros_status_link" href="<?= base_url('logs/get_logs_changed') ?>"> <b> Alterados </b> </a>
            </div>
        </form>
    </div>
    <table class="table table-striped" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="title_from">
                 <!-- <th> # </th> -->
                <th> Usuário(a) </th>
                <th> Ação </th>
                <th> Contato </th>
                <th> Quando </th>
                <th> IP </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($logs as $i){
                    ?>
                    <tr>
                        <!-- <td> <b> <?=$i->id?> </b> </td> -->
                        <td> <?=$i->users_name?> </td>
                        <td> <b class="text-primary"> <?=$i->type_logs?> </b> </td>
                        <td> <?=$i->contact_name?> </td>
                        <td> <?=date("d/m/Y H:i:s", strtotime($i->data_hora))?> </td>
                        <td> <?=$i->ip?> </td>
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
    <div id="numero_registros">Total: <strong><?= $numero_registros ?></strong></div>
</form>
