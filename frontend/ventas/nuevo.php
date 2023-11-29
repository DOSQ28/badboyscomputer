<?php
ob_start();
session_start();

if (!isset($_SESSION['rol'])) {
  header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
  <?php $class = "ventas";
  include("../arriba.php"); ?>
  <small>Inicio / Ventas / Nueva </small>
  </div>

  <div class="page-content">

    <div class="records table-responsive">

      <div>
        <?php
        require '../../backend/config/Conexion.php';
        $sentencia = $connect->prepare("SELECT productos.idprod,productos.codpro ,productos.nomprd, productos.desprd, productos.foto, productos.precio, productos.stock, marca.idmar, marca.nomarc, categoria.idcate, categoria.nocate,productos.modelo, productos.peso, productos.state, productos.fere FROM productos INNER JOIN marca ON productos.idmar = marca.idmar INNER JOIN categoria ON productos.idcate = categoria.idcate ORDER BY productos.idprod DESC;");
        $sentencia->execute();
        $data = array();
        if ($sentencia) {
          while ($r = $sentencia->fetchObject()) {
            $data[] = $r;
          }
        }
        ?>
        <?php if (count($data) > 0): ?>
          <table width="100%" id="example">
            <thead>
              <tr>

                <th><span class="las la-sort"></span>Foto</th>
                <th><span class="las la-sort"></span>Código</th>
                <th><span class="las la-sort"></span>Producto</th>
                <th><span class="las la-sort"></span>Precio</th>
                <th><span class="las la-sort"></span></th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $d): ?>
                <tr>
                  <td>
                    <?php echo "<img src='../../backend/img/subidas/" . $d->foto . "'width='50'"; ?>
                  </td>
                  <td>
                    <h4>
                      <?php echo $d->codpro ?>
                    </h4>
                  </td>
                  <td>
                    <h4>
                      <?php echo $d->nomprd ?>
                    </h4>
                  </td>
                  <td>
                    <h4>Bs./
                      <?php echo number_format($d->precio, 2) ?>
                    </h4>
                  </td>

                  <td style="width:260px;" class="btn-group" role="group">
                    <form class="form-inline btn-group" method="post" action="" role="group">
                      <input type="hidden" name="prdt" value="<?php echo $d->idprod; ?>">
                      <input type="hidden" name="pdrus" value="<?php echo $_SESSION['id']; ?>">
                      <input type="hidden" name="name" value="<?php echo $d->nomprd; ?>">
                      <input type="hidden" name="prec" value="<?php echo $d->precio; ?>">

                      <div class="form-group">
                        <input type="number" name="p_qty" value="1" style="width:100px;" min="1" class="form-control"
                          placeholder="Cantidad">
                      </div>
                      <button type="submit" name="add_to_cart" class="registerbtn">Agregar</button>
                    </form>
                  </td>

                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        <?php else: ?>
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
  <?= include("../abajo.php"); ?>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <?php include_once '../../backend/php/add_cart.php' ?>
<?php } else {
  header('Location: ../login.php');
} ?>