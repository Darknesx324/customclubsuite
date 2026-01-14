<?php 
require_once('./../../config.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT s.*,c.category FROM `service_requests` s inner join `categories` c where s.id = '{$_GET['id']}' ");
foreach($qry->fetch_array() as $k => $v){
    $$k = $v;
}
$meta = $conn->query("SELECT * FROM `request_meta` where request_id = '{$id}'");
while($row = $meta->fetch_assoc()){
    ${$row['meta_field']} = $row['meta_value'];
}
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
    span.select2-selection.select2-selection--single,span.select2-selection.select2-selection--multiple {
    padding: 0.25rem 0.5rem;
    min-height: calc(1.5em + 0.5rem + 2px);
    height:auto !important;
    max-height:calc(3.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0;
}
</style>
<div class="container-fluid">
    <form action="" id="request_form">
        <input type="hidden" name="id" value="<?php echo isset($id) ?  $id : "" ?>">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id" class="control-label">Tipo de Auto</label>
                    <select name="category_id" id="category_id" class="form-select form-select-sm select2 rounded-0" required>
                        <option disabled selected></option>
                        <?php 
                        $category = $conn->query("SELECT * FROM `categories` where status = 1 order by category asc");
                        while($row = $category->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $row['id'] == $category_id ? "selected" : "" ?>><?php echo  $row['category'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="owner_name" class="control-label">Nombre Completo del Propietario</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($owner_name) ? $owner_name : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label">Teléfono de Contacto del Propietario</label>
                    <input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Correo Electrónico del Propietario</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">Dirección</label>
                    <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" style="resize:none" required><?php echo isset($address) ? $address : "" ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_name" class="control-label">Nombre del Auto</label>
                    <input type="text" name="vehicle_name" id="vehicle_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($vehicle_name) ? $vehicle_name : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_registration_number" class="control-label">Número de Matrícula del Auto</label>
                    <input type="text" name="vehicle_registration_number" id="vehicle_registration_number" class="form-control form-control-sm rounded-0" value="<?php echo isset($vehicle_registration_number) ? $vehicle_registration_number : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="vehicle_model" class="control-label">Modelo del Auto</label>
                    <input type="text" name="vehicle_model" id="vehicle_model" class="form-control form-control-sm rounded-0" value="<?php echo isset($vehicle_model) ? $vehicle_model : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="service_id" class="control-label">Servicios</label>
                    <select name="service_id[]" id="service_id" class="form-select form-select-sm select2 rounded-0" multiple required>
                        <option disabled></option>
                        <?php 
                        $service = $conn->query("SELECT * FROM `service_list` where status = 1 order by `service` asc");
                        while($row = $service->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($service_id) && in_array($row['id'],explode(",",$service_id))? "selected" : '' ?>><?php echo  $row['service'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_type" class="control-label">Tipo de Solicitud</label>
                    <select name="service_type" id="service_type" class="form-select form-select-sm select2 rounded-0" required>
                        <option <?php echo isset($service_type) && $service_type == 'Drop Off' ? "selected" : '' ?>>Dejar en el Taller</option>
                        <option <?php echo isset($service_type) && $service_type == 'Pick Up' ? "selected" : '' ?>>Recoger</option>
                    </select>
                </div>
                <div class="form-group" <?php echo isset($service_type) && $service_type == 'Drop Off' ? 'style="display:none"' : '' ?>>
                    <label for="pickup_address" class="control-label">Dirección de Recogida</label>
                    <textarea rows="3" name="pickup_address" id="pickup_address" class="form-control form-control-sm rounded-0" style="resize:none" required><?php echo isset($pickup_address) ? $pickup_address : "" ?></textarea>
                </div>
            </div>
        </div>
        <hr class="border-light">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group " id="mechanic-holder">
                    <label for="mechanic_id" class="control-label">Asignado A:</label>
                    <select name="mechanic_id" id="mechanic_id" class="form-select form-select-sm rounded-0" required>
                        <option disabled <?php echo !isset($mechenic_id) || (isset($mechanic_id) && empty($mechanic_id)) ? "selected" : "" ?>></option>
                        <?php 
                        $mechanic = $conn->query("SELECT * FROM `mechanics_list` where status = 1 order by `name` asc");
                        while($row = $mechanic->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($mechanic_id) && in_array($row['id'],explode(",",$mechanic_id))? "selected" : '' ?>><?php echo  $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="control-label">Estado</label>
                    <select name="status" id="status" class="custom-select custom-select-sm rounded-0" required>
                        <option value="0" <?php echo isset($status) && $status == 0 ? "selected" : '' ?>>Pendiente</option>
                        <option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ?>>Confirmado</option>
                        <option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ?>>En Progreso</option>
                        <option value="3" <?php echo isset($status) && $status == 3 ? "selected" : '' ?>>Completado</option>
                        <option value="4" <?php echo isset($status) && $status == 4 ? "selected" : '' ?>>Cancelado</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
        <div class="w-100 d-flex justify-content-end mx-2">
            <div class="col-auto">
                <button class="btn btn-primary btn-sm rounded-0">Guardar Solicitud</button>
                <button class="btn btn-light btn-sm rounded-0" type="button" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('.select2').select2({
            placeholder:"Por Favor Seleccione Aquí",
            dropdownParent: $('#uni_modal')
        })
        $('#mechanic_id').select2({
            placeholder:"Por Favor Seleccione Aquí",
            dropdownParent: $('#mechanic-holder')
        })
        $('#service_type').change(function(){
            var type = $(this).val().toLowerCase()
            if(type == 'pick up'){
                $('#pickup_address').parent().show()
                $('#pickup_address').attr('required',true)
            }else{
                $('#pickup_address').parent().hide()
                $('#pickup_address').attr('required',false)
            }
                
        })
        $('#request_form').submit(function(e){
            e.preventDefault()
            start_loader();
            $.ajax({
                url:_base_url_+'classes/Master.php?f=save_request',
                method:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.log(err)
                    alert_toast("Ocurrió un error",'error');
                    end_loader()
                },
                success:function(resp){
                    end_loader()
                    if(resp.status == 'success'){
                        alert_toast("Datos guardados exitosamente",'success');
                        setTimeout(() => {
                            uni_modal("Detalles de la Solicitud de Servicio","service_requests/view_request.php?id="+resp.id,'large')
                            $('#uni_modal').on('hidden.bs.modal',function(){
                                location.reload()
                            })
                        }, 200);
                    }else{
                        alert_toast("Ocurrió un error",'error');
                    }
                }
            })
        })
    })
</script>