<?php
ob_start();
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('location: ../login.php');

}
?>
<?php if (isset($_SESSION['id'])) { ?>
    <?php $class="clientes";include("../arriba.php");?>
                    <small>Inicio / Clientes / Nuevo</small>
                </div>

                <div class="page-content">

                    <form action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                        <div class="containerss">
                            <h1>Nuevos clientes</h1>
                            <div class="alert-danger">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span
                                    class="badge-warning">*</span>
                            </div>
                            <hr>
                            <br>

                            <label for="psw"><b>Tipo de documento</b></label><span class="badge-warning">*</span>
                            <select required name="tipcl">
                                <option>Seleccione</option>
                                <option value="dni">DNI</option>
                            </select>

                            <label for="email"><b>Número del documento</b></label><span class="badge-warning">*</span>
                            <input type="text" maxlength="8"
                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                placeholder="ejm: 77656756" name="numcl" required>

                            <label for="email"><b>Nombre del cliente</b></label><span class="badge-warning">*</span>
                            <input type="text" placeholder="ejm: Alberto" name="nomcl" required>

                            <label for="email"><b>Apellido del cliente</b></label><span class="badge-warning">*</span>
                            <input type="text" placeholder="ejm: Juarez" name="apecl" required>

                            <label for="email"><b>Teléfono celular del cliente</b></label><span
                                class="badge-warning">*</span>
                            <input type="text" maxlength="9"
                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                placeholder="ejm: 99898787" name="telcl" required>


                            <hr>

                            <button type="submit" name="add_customer" class="registerbtn">Guardar</button>
                        </div>

                    </form>

                </div>

            </main>

        </div>
        <script src="../../backend/js/jquery.min.js"></script>

        <script type="text/javascript">
            $(window).on("load", function () {
                $(".load_animation").fadeOut(1000);
            });
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <?php include_once '../../backend/php/add_customer.php' ?>
        <script type="text/javascript" src="../../backend/js/reenvio.js"></script>
    </body>

    </html>

<?php } else {
    header('Location: ../login.php');
} ?>