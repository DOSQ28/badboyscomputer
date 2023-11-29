<?php
ob_start();
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
    <!DOCTYPE html>
    <?php $class = "clientes";
    include("../arriba.php"); ?>
    <small>Inicio / Clientes</small>    
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
                                <th><span class="las la-sort"></span>Clientes</th>
                                <th><span class="las la-sort"></span>Estado</th>

                                <th><span class="las la-sort"></span>Acciones</th>

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
                                    <td data-title="Estado">

                                        <label class="switch">
                                            <input type="checkbox" id="<?= $d->idcli ?>" value="<?= $d->state ?>" <?= $d->state == '1' ? 'checked' : ''; ?> />

                                            <span class="slider"></span>
                                        </label>
                                    </td>

                                    <td class="btn-group" role="group">
                                        <a title="Actualizar" href="../clientes/editar.php?id=<?php echo $d->idcli ?>"
                                            class="fa fa-pencil tooltip"></a>
                                        <?php
                                        if ($d->rol == '2') {
                                            // code...
                                            echo '<a title="Cambiar contraseña"  href="../clientes/password.php?id=' . $d->idcli . '" class="fa fa-key"></a>';
                                        } else {
                                            echo '<a title="Crear perfil" href="../clientes/crear.php?id=' . $d->idcli . '" class="fa fa-user-plus"></a>';
                                        }

                                        ?>


                                        <form onsubmit="return confirm('Realmente desea eliminar el registro?');" method='POST'
                                            action='<?php $_SERVER['PHP_SELF'] ?>'>
                                            <input type='hidden' name='idcli' value="<?php echo $d->idcli; ?>">

                                            <button name='delete_customer' style="cursor: pointer;" class="fa fa-trash"></button>
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
    <?php include("../abajo.php"); ?>

<?php } else {
    header('Location: ../login.php');
} ?>