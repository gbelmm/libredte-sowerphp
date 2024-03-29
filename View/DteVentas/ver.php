<h1>Libro de ventas período <?=$DteVenta->periodo?></h1>
<p>Esta es la página del libro de ventas del período <?=$DteVenta->periodo?> de la empresa <?=$Emisor->razon_social?>.</p>

<script type="text/javascript">
$(function() {
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    }
});
</script>

<?php $n_ventas = count($ventas); ?>

<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos básicos</a></li>
<?php if ($n_ventas) : ?>
        <li role="presentation"><a href="#detalle" aria-controls="detalle" role="tab" data-toggle="tab">Detalle</a></li>
        <li role="presentation"><a href="#estadisticas" aria-controls="estadisticas" role="tab" data-toggle="tab">Estadísticas</a></li>
<?php endif; ?>
        <li role="presentation"><a href="#revision" aria-controls="revision" role="tab" data-toggle="tab">Subir revisión</a></li>
    </ul>
    <div class="tab-content">

<!-- INICIO DATOS BÁSICOS -->
<div role="tabpanel" class="tab-pane active" id="datos">
    <div class="row">
        <div class="col-md-9">
<?php
new \sowerphp\general\View_Helper_Table([
    ['Período', 'DTE emitidos', 'DTE envíados'],
    [$DteVenta->periodo, num($n_ventas), num($DteVenta->documentos)],
]);
?>
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-default btn-lg btn-block<?=!$n_ventas?' disabled':''?>" href="<?=$_base?>/dte/dte_ventas/csv/<?=$DteVenta->periodo?>" role="button">
                    <span class="fa fa-file-excel-o" style="font-size:24px"></span>
                    Descargar detalle en archivo CSV
                </a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-default btn-lg btn-block" href="<?=$_base?>/dte/dte_ventas/xml/<?=$DteVenta->periodo?>" role="button">
                    <span class="fa fa-file-code-o" style="font-size:24px"></span>
                    Descargar libro de ventas en XML
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 center bg-info">
        <span class="lead">Track ID SII: <?=$DteVenta->track_id?></span>
        <p><strong><?=$DteVenta->revision_estado?></strong></p>
        <p><?=str_replace("\n", '<br/>', $DteVenta->revision_detalle)?></p>
<?php if ($DteVenta->track_id) : ?>
        <p>
            <a class="btn btn-info" href="<?=$_base?>/dte/dte_ventas/actualizar_estado/<?=$DteVenta->periodo?>" role="button">Actualizar estado</a><br/>
            <span style="font-size:0.8em"><a href="<?=$_base?>/dte/dte_ventas/solicitar_revision/<?=$DteVenta->periodo?>" title="Solicitar nueva revisión del DTE al SII">solicitar nueva revisión</a></span>
        </p>
<?php else: ?>
        <p><a class="btn btn-info" href="<?=$_base?>/dte/dte_ventas/enviar_sii/<?=$DteVenta->periodo?>" role="button">Enviar libro al SII</a></p>
<?php endif; ?>
        </div>
    </div>
</div>
<!-- FIN DATOS BÁSICOS -->

<?php if ($n_ventas) : ?>

<!-- INICIO DETALLES -->
<div role="tabpanel" class="tab-pane" id="detalle">
<?php
array_unshift($ventas, $ventas_cols);
new \sowerphp\general\View_Helper_Table($ventas);
?>
</div>
<!-- FIN DETALLES -->

<!-- INICIO ESTADÍSTICAS -->
<div role="tabpanel" class="tab-pane" id="estadisticas">
    <img src="<?=$_base.'/dte/dte_ventas/grafico_ventas_diarias/'.$DteVenta->periodo?>" alt="Gráfico ventas diarias del período" class="img-responsive thumbnail center" />
    <br/>
    <img src="<?=$_base.'/dte/dte_ventas/grafico_ventas_tipo/'.$DteVenta->periodo?>" alt="Gráfico con tipos de ventas del período" class="img-responsive thumbnail center" />
</div>
<!-- FIN ESTADÍSTICAS -->

<?php endif; ?>

<!-- INICIO REVISIÓN -->
<div role="tabpanel" class="tab-pane" id="revision">
<p>Aquí puede subir el XML con el resultado de la revisión del libro de ventas envíado al SII.</p>
<?php
$f = new \sowerphp\general\View_Helper_Form();
echo $f->begin(['action'=>$_base.'/dte/dte_ventas/subir_revision/'.$DteVenta->periodo, 'onsubmit'=>'Form.check()']);
echo $f->input([
    'type' => 'file',
    'name' => 'xml',
    'label' => 'XML revisión',
    'check' => 'notempty',
]);
echo $f->end('Subir XML de revisión');
?>
</div>
<!-- FIN REVISIÓN -->

    </div>
</div>
