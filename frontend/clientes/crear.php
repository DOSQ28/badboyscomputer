<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<?php $class="clientes"; include("../arriba.php");?>                <small>Home / Clientes / Perfil</small>
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
    <h1>Nuevo perfil de los clientes</h1>
    <div class="alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span>
</div>
    <hr>
    <br>

    <label for="email"><b>Nombre cliente</b></label>
    <input type="text" value="<?php echo $d->nocl; ?> &nbsp; <?php echo $d->apcl; ?>" placeholder="ejm: jjalver" disabled>
  
    <label for="email"><b>Nombre del usuario cliente</b></label><span class="badge-warning">*</span>
    <input type="text" placeholder="ejm: jjalver" name="usrcl"  required>
    <input type="hidden" name="clid" value="<?php echo $d->idcli; ?>">

    <label for="email"><b>Contraseña del cliente</b></label><span class="badge-warning">*</span>
    <input type="password" placeholder="ejm: ********" name="pswcl"  required>

    <label for="psw"><b>Rol</b></label>
    <select name="rolcl" required>
        <option value="2">CLIENTES</option>
        
      
    </select>

    <hr>
   
    <button type="submit" name="add_perfil" class="registerbtn">Guardar</button>
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
    <?php include_once '../../backend/php/add_perfil.php' ?>
    <script type="text/javascript" src="../../backend/js/reenvio.js"></script>
</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>