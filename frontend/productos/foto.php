<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<?php $class="productos";include("../arriba.php"); ?>
                <small>Inicio / Productos / Foto</small>
            </div>
            
            <div class="page-content">
            <?php 
require '../../backend/config/Conexion.php';
$id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM productos  WHERE idprod= '$id';");
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
    <h1>Actualizar imagen del producto</h1>
    <div class="alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span>
</div>
    <hr>
    <br>


    <label for="email"><b>Foto del producto</b></label><span class="badge-warning">*</span>
    <div class="upload-box">
        <div class="upload-img">
            <img src="../../backend/img/subidas/<?php echo $d->foto; ?>" alt="">
        </div>
            <label for="upload-input" class="upload-label">Upload Image</label>
    <input type="file" name="foto" required  id="upload-input">
    <input type="hidden" value="<?php echo $d->idprod; ?>" name="prdid">
                   
    </div>


    <hr>
   
    <button type="submit" name="upd_foto_prodct" class="registerbtn">Guardar</button>
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
    <?php include_once '../../backend/php/upd_foto_prodct.php' ?>
    <script type="text/javascript" src="../../backend/js/reenvio.js"></script>
<script type="text/javascript">
  const uploadInput = document.querySelector('#upload-input') ;
const previewImg = document.querySelector('.upload-img img') ;

uploadInput.addEventListener('change',e => {
    if(e.target.files.length > 0) {
        const url = URL.createObjectURL(e.target.files[0]) ;
        previewImg.src = url ;
    }
})
</script>
 

</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>