<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
    <?php $class="clientes";include("../arriba.php");?>
                <small>Inicio / Clientes / Actualizar</small>
            </div>
            
            <div class="page-content">
            <?php 
require '../../backend/config/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM clientes  WHERE idcli= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
   ?>
   <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>
<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off">
  <div class="containerss">
    <h1>Actualizar a los clientes</h1>
    <div class="alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span>
</div>
    <hr>
    <br>

    <label for="psw"><b>Tipo de documento</b></label><span class="badge-warning">*</span>
    <select required name="tipcl">
        <option value="<?php echo $d->tipd; ?>"><?php echo $d->tipd; ?></option>
        <option>------------Seleccione-----------------</option>
        <option value="dni">DNI</option>
    </select>

    <label for="email"><b>Número del documento</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->nudoc; ?>" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ejm: 77656756" name="numcl"  required>
    <label for="email"><b>Nombre del cliente</b></label>
    <input type="text" name="namcl" value="<?php echo $d->nocl; ?>"  placeholder="ejm: jjalver">

    <label for="email"><b>Apellido del cliente</b></label>
    <input type="text" name="apecl" value="<?php echo $d->apcl; ?>" placeholder="ejm: zapata">

     <label for="email"><b>Teléfono celular del cliente</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->telfcl; ?>" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ejm: 99898787" name="telcl"  required>

  
    <label for="email"><b>Nombre del usuario cliente</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->username; ?>" placeholder="ejm: jjalver" name="usrcl"  required>
    <input type="hidden" name="clid" value="<?php echo $d->idcli; ?>">

    <hr>
   
    <button type="submit" name="upd_customer" class="registerbtn">Guardar</button>
  </div>
  
</form>
 <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
            
            </div>
            
        </main>
        
    </div>
    <script src="../../backend/js/jquery.min.js"></script>
   
    <script type="text/javascript">
        $(window).on("load",function(){
            $(".load_animation").fadeOut(1000);
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/upd_customer.php' ?>
    <script type="text/javascript" src="../../backend/js/reenvio.js"></script>
</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>