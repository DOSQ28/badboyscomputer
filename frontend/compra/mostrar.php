<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
    <?php $class="compras";
        include("../arriba.php");?>                
        <small>Inicio / Compra</small>
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
$sentencia = $connect->prepare("SELECT orders_purchase.idordpur, orders_purchase.user_id, proveedores.idprov, proveedores.rucprv, proveedores.nomprv, orders_purchase.total_products, orders_purchase.total_price, orders_purchase.placed_on, orders_purchase.payment_status, orders_purchase.tipc FROM orders_purchase INNER JOIN proveedores ON orders_purchase.idprov = proveedores.idprov ORDER BY idordpur DESC;");
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
                                    <th><span class="las la-sort"></span>Comprobante</th>
                                    <th><span class="las la-sort"></span>Fecha</th>
                                    <th><span class="las la-sort"></span>Total</th>
                                    <th><span class="las la-sort"></span>Proveedores</th>
                                    <th><span class="las la-sort"></span>Productos</th>

                                    <th><span class="las la-sort"></span>Estado</th>
                                    <th><span class="las la-sort"></span>Acciones</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d):?>
                                <tr>
                                    <td><?php echo $d->idordpur ?></td>
                                    <td><h4><?php echo $d->tipc ?></h4></td>
                                    <td><h4><?php echo $d->placed_on ?></h4></td>
                                    <td><h4>S/<?php echo number_format($d->total_price, 2); ?></h4></td>
                                    <td>
                                        <div class="client">
                                           
                                            <div class="client-info">
                                                <h4><?php echo $d->nomprv ?></h4>
                                               
                                            </div>
                                        </div>
                                    </td>
                                    <td><h4><?php echo $d->total_products ?></h4></td>
                                    <td data-title="Estado">
    
                        <label class="switch">
                          <input type="checkbox" id="<?=$d->idordpur?>" value="<?=$d->payment_status ?>" <?=$d->payment_status == 'Aceptado' ? 'checked' : '' ;?>/> 

                          <span class="slider"></span>
                        </label>
                        </td>
        <td>
            
            <a title="Boleta" href="../ventas/boleta.php?id=<?php echo $d->idordpur ?>" class="fa fa-file-text-o tooltip"></a>
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
    <?php
        include("../abajo.php");?>  

<?php }else{ 
    header('Location: ../login.php');
 } ?>