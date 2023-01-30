<div class="title_pages">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Log's de Acesso
</div>
<form class="forms">
    <table class="table table-striped" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="title_from">
                <!-- <th> # </th> -->
                <th> Usuário(a) </th>
                <th> Quando </th>
                <th> IP </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id_user = $this->session->userdata('id_user');
            // print_r($id_user);die;

                foreach ($logs as $i){
                    if($i->id_user ==  $id_user){
                    ?>
                    <tr>
                        <!-- <td> <b> <?=$i->id?> </b> </td> -->
                        <td> <?=$i->users_name?> </td>
                        <td> <?=date("d/m/Y H:i:s", strtotime($i->data_hora))?> </td>
                        <td> <?=$i->ip?> </td>
                    </tr>
                    <?php
                    }
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
