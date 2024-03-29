<h1>Seleccionar empresa con que operar</h1>
<p>Aquí podrá seleccionar una empresa con la cual operar durante su sesión de LibreDTE. Todas las acciones que realice quedarán registradas a nombre de la empresa que seleccione.</p>
<?php
foreach ($empresas as &$e) {
    // agregar acciones
    $acciones = '';
    if ($e['administrador']) {
        $acciones .= '<a href="modificar/'.$e['rut'].'" title="Editar empresa '.$e['razon_social'].'"><span class="fa fa-edit btn btn-default"></span></a>';
        $acciones .= ' <a href="usuarios/'.$e['rut'].'" title="Mantenedor usuarios autorizados a operar con la empresa '.$e['razon_social'].'"><span class="fa fa-users btn btn-default"></span></a> ';
    }
    $acciones .= '<a href="seleccionar/'.$e['rut'].'" title="Operar con la empresa '.$e['razon_social'].'"><span class="fa fa-check btn btn-default"></span></a>';
    $e[] = $acciones;
    // modificar columnas
    $e['rut'] = num($e['rut']).'-'.$e['dv'];
    $e['certificacion'] = $e['certificacion'] ? 'Certificación' : 'Producción';
    $e['administrador'] = $e['administrador'] ? 'Si' : 'No';
    unset($e['dv']);
}
array_unshift($empresas, ['RUT', 'Razón social', 'Giro', 'Ambiente', 'Administrador', 'Acciones']);
new \sowerphp\general\View_Helper_Table($empresas);
?>
<a class="btn btn-primary btn-lg btn-block" href="registrar" role="button">Registrar una nueva empresa y ser el administrador de la misma</a>
