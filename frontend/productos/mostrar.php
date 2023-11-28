<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
  <?php $class="productos";   ?>
        <!-- arriba -->
<?php include("../arriba.php"); ?>
                <small>Inicio / Productos</small>
            </div>
            
            <div class="page-content">
            
            <div class="records table-responsive">
                     <div class="record-header">
                        <div class="add">                          
                            <button style="cursor: pointer;" onclick="location.href='nuevo.php'">Nuevo</button>
                        </div>
                    </div>
                    <div>
                        <?php 
require '../../backend/config/Conexion.php';
$sentencia = $connect->prepare("SELECT productos.idprod,productos.codpro ,productos.nomprd, productos.desprd, productos.foto, productos.precio, productos.stock, marca.idmar, marca.nomarc, categoria.idcate, categoria.nocate,productos.modelo, productos.peso, productos.state, productos.fere FROM productos INNER JOIN marca ON productos.idmar = marca.idmar INNER JOIN categoria ON productos.idcate = categoria.idcate ORDER BY idprod DESC;");
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
                                    <th>Código</th>
                                    <th><span class="las la-sort"></span>Producto</th>
                                    <th><span class="las la-sort"></span>Marca</th>
                                    <th><span class="las la-sort"></span>Modelo</th>
                                    <th><span class="las la-sort"></span>Categoria</th>
                                    <th><span class="las la-sort"></span>Precio</th>
                                    <th><span class="las la-sort"></span>Stock</th>
                                    <th><span class="las la-sort"></span>Estado</th>
                                 
                                    <th><span class="las la-sort"></span>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d):?>
                                <tr>
                                    <td><?php echo $d->codpro ?></td>
                                    <td>
                                        <div class="client">
                <div class="client-img bg-img" style="background-image: url(../../backend/img/subidas/<?php echo $d->foto ?>)"></div>
                                            <div class="client-info">
                                                <h4><?php echo $d->nomprd ?></h4>
                                               
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4><?php echo $d->nomarc ?></h4>
                                    </td>
                                    <td><h4><?php echo $d->modelo ?></h4></td>
                                    <td><h4><?php echo $d->nocate ?></h4></td>
                                    <td><h4>S/<?php echo number_format($d->precio,2) ?></h4></td>
                                    <td>
                                      <?php 
                                     if ($d->stock < 11) {
                                        echo '<span class="badge">Se esta agotando</span>';
                                     }else{
                                       echo '<h4>'.$d->stock.'</h4>';
                                       
                                     }

                                     ?>  
                                    </td>
                                    

                                    <td data-title="Estado">
    
                        <label class="switch">
                          <input type="checkbox" id="<?=$d->idprod?>" value="<?=$d->state ?>" <?=$d->state == '1' ? 'checked' : '' ;?>/> 

                          <span class="slider"></span>
                        </label>
                        </td>
                                   
                                    <td>
                                       <a title="Actualizar" href="../productos/editar.php?id=<?php echo $d->idprod ?>" class="fa fa-pencil tooltip"></a>

                                       <a title="Stock" href="../productos/stock.php?id=<?php echo $d->idprod ?>" class="fa fa-bookmark-o tooltip"></a>

                                       <a title="Imagen" href="../productos/foto.php?id=<?php echo $d->idprod ?>" class="fa fa-picture-o tooltip"></a>
                                     
                                     <form  onsubmit="return confirm('Realmente desea eliminar el registro?');" method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
<input type='hidden' name='idprod' value="<?php echo  $d->idprod; ?>">

<button name='delete_product' style="cursor: pointer;" class="fa fa-trash"></button>
</form> 
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
     <!-- abajo -->
     <?php include("../abajo.php")?>
<?php }else{ 
    header('Location: ../login.php');
 } ?>