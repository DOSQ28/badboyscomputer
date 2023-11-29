<?php
ob_start();
session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
    <?php $class = "compras";
    include("../arriba.php"); ?>
    <small>Inicio / Ventas / Carrito de compras </small>
    </div>

    <div class="page-content">

        <div class="records table-responsive">

            <div>


                <table width="100%" id="example">
                    <thead>
                        <tr>

                            <th><span class="las la-sort"></span>Código</th>
                            <th><span class="las la-sort"></span>Producto</th>
                            <th><span class="las la-sort"></span>Precio</th>
                            <th><span class="las la-sort"></span>Stock</th>
                            <th><span class="las la-sort"></span>Cantidad</th>
                            <th><span class="las la-sort"></span>Subtotal</th>
                            <th><span class="las la-sort"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require '../../backend/config/Conexion.php';
                        $grand_total = 0;
                        $select_cart = $connect->prepare("SELECT cart.idv, usuarios.id, usuarios.nombre, productos.precio,productos.stock,productos.foto,productos.idprod, productos.codpro, productos.nomprd, cart.name, cart.price, cart.quantity FROM cart INNER JOIN usuarios ON cart.user_id = usuarios.id INNER JOIN productos ON cart.idprod = productos.idprod;");
                        $select_cart->execute();
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>

                                    <td>
                                        <h4>
                                            <?= $fetch_cart['codpro']; ?>
                                        </h4>
                                    </td>
                                    <td>
                                        <h4>
                                            <?= $fetch_cart['nomprd']; ?>
                                        </h4>
                                    </td>
                                    <td>
                                        <h4>Bs./
                                            <?php echo number_format($fetch_cart['precio'], 2) ?>
                                        </h4>
                                    </td>
                                    <td>
                                        <h4>
                                            <?= $fetch_cart['stock']; ?>
                                        </h4>
                                    </td>
                                    <td class="btn-group" role="group">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <input type="hidden" name="prdt" value="<?= $fetch_cart['idv']; ?>">
                                                <input type="number" name="p_qty" value="<?= $fetch_cart['quantity']; ?>"
                                                    style="width:100px;" min="1" max="99" class="form-control"
                                                    placeholder="Cantidad">
                                            </div>
                                            <button type="submit" name="update_qty" class="btn btn-primary"
                                                style="cursor: pointer;"> <i class="fa fa-refresh"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <h4>S/
                                            <?= number_format($sub_total = ($fetch_cart['precio'] * $fetch_cart['quantity']), 2); ?>
                                        </h4>
                                    </td>
                                    <td style="width:260px;">
                                        <a title="Eliminar" onclick="return confirm('Eliminar del carrito?');"
                                            href="../ventas/eliminar.php?id=<?= $fetch_cart['idv']; ?>" class="fa fa-trash"></a>
                                    </td>
                                </tr>
                                <?php
                                $grand_total += $sub_total;
                            }
                        } else {
                            echo '<p class="alert alert-warning">Tu carrito esta vació</p>';
                        }
                        ?>
                    </tbody>
                </table>
                <h1 style="font-size:42px; color:#000000;">Precio Total: Bs./
                    <?php echo number_format($grand_total, 2); ?>
            </div>


            <div>
                <button onclick="location.href='nuevo.php'" class="registerbtn">CONTINUAR COMPRANDO </button>

                <button class="pabtn <?= ($grand_total > 1) ? '' : 'disabled'; ?>"
                    onclick="location.href='checkout.php'">PRECEDER PAGO</button>
            </div>

        </div>

    </div>

    </main>

    </div>
    <?= include("../abajo.php"); ?>

<?php } else {
    header('Location: ../login.php');
} ?>