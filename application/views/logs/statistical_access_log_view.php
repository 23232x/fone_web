<div class="title_pages">
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Log's de Acesso
</div>
<form class="forms" method="post" action="<?=base_url('logs/statistical_access_log')?>">
    <div class="row">
        <div class="form-group col-md-3">
            <label><span class="text-danger">*</span> Data inicial</label>
            <input type="date" name="date_ini" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label><span class="text-danger"></span> Data final</label>
            <input type="date" name="date_end" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success bt-sm">OK</button>
        </div>
    </div>
</form>
<div class="subtitle_pages">
    Período <strong><?=date('d/m/Y', strtotime($statistical['dates']['date_ini']))?> à <?=date('d/m/Y', strtotime($statistical['dates']['date_end']))?></strong>
</div>
<div id="access_box">
    Acessos: <?=$statistical['num_rows']?>
</div>