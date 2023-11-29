<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
    <?php $class="proveedores";include("../arriba.php");?>
                <small>Inicio / Proveedores / Actualizar</small>
            </div>
            
            <div class="page-content">
            <?php 
require '../../backend/config/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("DELETE FROM proveedores  WHERE idprov= '$id';");
 $sentencia->execute();
 header('Location:mostrar.php');

}else{ 
    header('Location: ../login.php');
 } ?>