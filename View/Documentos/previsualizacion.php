<h1>Previsualización DTE</h1>
<?php
debug($resumen);
new \sowerphp\general\View_Helper_Table([
    ['Tipo', 'Folio', 'Tasa IVA', 'Fecha emisión', 'Sucursal SII', 'RUT receptor', 'Razón social receptor', 'Exento', 'Neto', 'IVA', 'Total'],
    $resumen
]);
?>
<div class="row">
    <div class="col-xs-6 center">
        <a class="btn btn-primary btn-lg btn-block" href="../dte_tmps/pdf/<?=$DteTmp->receptor?>/<?=$DteTmp->dte?>/<?=$DteTmp->codigo?>" role="button">
            <span class="fa fa-file-pdf-o" style="font-size:24px"></span>
            Previsualizar PDF del DTE
        </a>
    </div>
    <div class="col-xs-6 center">
        <a class="btn btn-primary btn-lg btn-block" href="generar/<?=$DteTmp->receptor?>/<?=$DteTmp->dte?>/<?=$DteTmp->codigo?>" role="button">
            <span class="fa fa-send-o" style="font-size:24px"></span>
            Generar DTE y enviar al SII
        </a>
    </div>
</div>
