<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
    <?php $class="accesos";
include("../arriba.php");?>
                <small>Inicio / Accesos</small>
            </div>
            
            <div class="page-content">
            
            <div class="records table-responsive">
                    
                    <div>
                        <?php 
require '../../backend/config/Conexion.php';
$sentencia = $connect->prepare("SELECT * FROM usuarios ORDER BY id DESC;");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
                        <table width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span class="las la-sort"></span>Nombre</th>
                                    <th><span class="las la-sort"></span>Estado</th>
                                 
                                    <th><span class="las la-sort"></span>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d):?>
                                <tr>
                                    <td><?php echo $d->id ?></td>
                                    <td>
                                        <div class="client">
                                           
                                            <div class="client-info">
                                                <h4><?php echo $d->nombre ?></h4>
                                                <small><?php echo $d->username ?></small>
                                               
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Estado">
    
                        <label class="switch">
                          <input type="checkbox" id="<?=$d->id?>" value="<?=$d->state ?>" <?=$d->state == '1' ? 'checked' : '' ;?>/> 

                          <span class="slider"></span>
                        </label>
                        </td>
                                   
                                    <td>
                                       <a title="Actualizar" href="../accesos/editar.php?id=<?php echo $d->id ?>" class="fa fa-pencil tooltip"></a>

                                       <a title="Cambiar contraseña" href="../accesos/cambiar.php?id=<?php echo $d->id ?>" class="fa fa-key tooltip"></a>
                                     
                                    </td>
                                   
                                </tr>
                                 <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                          <?php else:?>
                           <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>
    <?=include("../abajo.php");?>

<?php }else{ 
    header('Location: ../login.php');
 } ?>