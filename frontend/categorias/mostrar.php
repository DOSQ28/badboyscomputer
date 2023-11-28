<?php
ob_start();
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
<?php $class="categorias";
     require("../arriba.php");?>

                    <small>Inicio / Categorias</small>
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
                            $sentencia = $connect->prepare("SELECT * FROM categoria ORDER BY idcate DESC;");
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
                                            <th><span class="las la-sort"></span>Nombre</th>
                                            <th><span class="las la-sort"></span>Estado</th>

                                            <th><span class="las la-sort"></span>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $d): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $d->idcate ?>
                                                </td>
                                                <td>
                                                    <div class="client">

                                                        <div class="client-info">
                                                            <h4>
                                                                <?php echo $d->nocate ?>
                                                            </h4>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-title="Estado">

                                                    <label class="switch">
                                                        <input type="checkbox" id="<?= $d->idcate ?>" value="<?= $d->state ?>"
                                                            <?= $d->state == '1' ? 'checked' : ''; ?> />

                                                        <span class="slider"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <a title="Actualizar"
                                                        href="../categorias/editar.php?id=<?php echo $d->idcate ?>"
                                                        class="fa fa-pencil tooltip"></a>

                                                    <form onsubmit="return confirm('Realmente desea eliminar el registro?');"
                                                        method='POST' action='<?php $_SERVER['PHP_SELF'] ?>'>
                                                        <input type='hidden' name='idcate' value="<?php echo $d->idcate; ?>">

                                                        <button name='delete_category' style="cursor: pointer;"
                                                            class="fa fa-trash"></button>
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
        <!-- abajo -->
        <?=include("../abajo.php");?>

<?php } else {
    header('Location: ../login.php');
} ?>