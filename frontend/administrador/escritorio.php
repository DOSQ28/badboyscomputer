<?php
ob_start();
session_start();

if (!isset($_SESSION['rol']))  {
    header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
    <!-- arriba -->
<?php $class="panel";
include("../arriba.php"); ?>

                    <small>Inicio / Panel de Control</small>
                </div>

                <div class="page-content">

                    <div class="analytics">

                        <div class="card">
                            <div class="card-head">
                                <?php
                                require_once('../../backend/config/Conexion.php');
                                $sql = "SELECT COUNT(*) total FROM clientes";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>
                                    <?php echo $total; ?>
                                </h2>
                                <span class="las la-user-friends"></span>
                            </div>
                            <div class="card-progress">
                                <small>Clientes</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php
                                $fe= strval(date('d-M-Y'));
                                $sql = "SELECT SUM(total_price) total FROM orders WHERE placed_on='$fe'";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>Bs./
                                    <?php echo number_format($total, 2) ?>
                                </h2>
                                <span class="las la-money-bill"></span>
                            </div>
                            <div class="card-progress">
                                <small>Ventas</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php

                                $sql = "SELECT COUNT(*) total FROM productos";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>
                                    <?php echo $total; ?>
                                </h2>
                                <span class="las la-shopping-cart"></span>
                            </div>
                            <div class="card-progress">
                                <small>Productos</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php

                                $sql = "SELECT COUNT(*) total FROM usuarios";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>
                                    <?php echo $total; ?>
                                </h2>
                                <span class="las la-user-friends"></span>
                            </div>
                            <div class="card-progress">
                                <small>Accesos</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php
                                $fe= strval(date('d-M-Y'));
                                $sql = "SELECT SUM(total_price) total FROM orders_purchase WHERE placed_on='$fe'";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>Bs./
                                    <?php echo number_format($total, 2) ?>
                                </h2>
                                <span class="las la-store"></span>
                            </div>
                            <div class="card-progress">
                                <small>Compras</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php

                                $sql = "SELECT COUNT(*) total FROM categoria";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>
                                    <?php echo $total; ?>
                                </h2>
                                <span class="las la-paperclip"></span>
                            </div>
                            <div class="card-progress">
                                <small>Categorias</small>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <?php

                                $sql = "SELECT COUNT(*) total FROM marca";
                                $result = $connect->query($sql); //$pdo sería el objeto conexión
                                $total = $result->fetchColumn();

                                ?>
                                <h2>
                                    <?php echo $total; ?>
                                </h2>
                                <span class="las la-thumbtack"></span>
                            </div>
                            <div class="card-progress">
                                <small>Marca</small>

                            </div>
                        </div>

                    </div>


                    <div class="records table-responsive">
                        <div class="record-header">
                            <h1>Clientes nuevos</h1>
                        </div>
                        <div>
                            <?php
                            $sentencia = $connect->prepare("SELECT * FROM clientes ORDER BY idcli DESC;");
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
                                            <th>#</th>
                                            <th><span class="las la-sort"></span> CLIENTES</th>
                                            <th><span class="las la-sort"></span> TELEFONO</th>
                                            <th><span class="las la-sort"></span> ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $d->idcli ?>
                                                </td>
                                                <td>
                                                    <div class="client">
                                                        <div class="client-img bg-img"
                                                            style="background-image: url(../../backend/img/images.jpeg)"></div>
                                                        <div class="client-info">
                                                            <h4>
                                                                <?php echo $d->nocl ?>&nbsp;
                                                                <?php echo $d->apcl ?>
                                                            </h4>
                                                            <small>
                                                                <?php echo $d->nudoc ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $d->telfcl ?>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" id="<?= $d->idcli ?>" value="<?= $d->state ?>"
                                                            <?= $d->state == '1' ? 'checked' : ''; ?> />

                                                        <span class="slider"></span>
                                                    </label>
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

                    <br>


                </div>

                <div class="page-content">

                    <div class="records table-responsive">
                        <div class="record-header">
                            <h1>Gráficas</h1>
                        </div>
                        <div>


                            <hr>
                            <div id="chartDiv" class="pie-chart"></div>
                            <div class="text-center"></div>
                        </div>

                    </div>

                </div>



            </main>
        </div>
        <!-- abajo -->
        <?php include("../abajo.php")?>

<?php } else {
    header('Location: ../login.php');
} ?>