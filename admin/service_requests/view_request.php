<?php 
require_once('./../../config.php');
$qry = $conn->query("SELECT s.*,c.category FROM `service_requests` s inner join `categories` c where s.id = '{$_GET['id']}' ");
foreach($qry->fetch_array() as $k => $v){
    $$k = $v;
}
$meta = $conn->query("SELECT * FROM `request_meta` where request_id = '{$id}'");
while($row = $meta->fetch_assoc()){
    ${$row['meta_field']} = $row['meta_value'];
}
$services  = $conn->query("SELECT * FROM service_list where id in ({$service_id}) ");
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <dl>
                <dt><b>Tipo de Vehículo</b></dt>
                <dd class="pl-2"><?php echo $category ?></dd>
                <dt><b>Nombre del Propietario</b></dt>
                <dd class="pl-2"><?php echo $owner_name ?></dd>
                <dt><b>Contacto del Propietario</b></dt>
                <dd class="pl-2"><?php echo $contact ?></dd>
                <dt><b>Correo del Propietario</b></dt>
                <dd class="pl-2"><?php echo $email ?></dd>
                <dt><b>Dirección del Propietario</b></dt>
                <dd class="pl-2"><?php echo $address ?></dd>
                <dt><b>Tipo de Solicitud</b></dt>
                <dd class="pl-2"><?php echo $service_type ?></dd>
                <dt><b>Estado</b></dt>
                <dd class="pl-2">
                    <?php if($status == 1): ?>
                        <span class="badge badge-primary">Confirmado</span>
                    <?php elseif($status == 2): ?>
                        <span class="badge badge-warning">En Progreso</span>
                    <?php elseif($status == 3): ?>
                        <span class="badge badge-success">Completado</span>
                    <?php elseif($status == 4): ?>
                        <span class="badge badge-danger">Cancelado</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Pendiente</span>
                    <?php endif; ?>
                </dd>
            </dl>
        </div>
        <div class="col-sm-6">
            <dl>
                <dt><b>Nombre del Vehículo</b></dt>
                <dd class="pl-2"><?php echo $vehicle_name ?></dd>
                <dt><b>Número de Matrícula del Vehículo</b></dt>
                <dd class="pl-2"><?php echo $vehicle_registration_number ?></dd>
                <dt><b>Modelo del Vehículo</b></dt>
                <dd class="pl-2"><?php echo $vehicle_model ?></dd>
                <dt><b>Servicio/s:</b></dt>
                <dd class="pl-2">
                    <ul>
                        <?php 
                        while($srow= $services->fetch_assoc()):
                         ?>
                        <li><?php echo $srow['service'] ?></li>
                        <?php endwhile; ?>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-end mx-2">
        <div class="col-auto">
            <button class="btn btn-light btn-sm rounded-0" type="button" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>