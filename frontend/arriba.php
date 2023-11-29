<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Computer Bad Boys</title>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" href="../../backend/img/favicon.ico">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">
    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script> -->
    <style type="text/css">
        .disabled {
            cursor: not-allowed;
            pointer-events: none;
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            vertical-align: middle
        }

        .btn-group .btn+.btn-group,
        .btn-group .btn-group+.btn,
        .btn-group .btn-group+.btn-group,
        .btn-group-vertical .btn+.btn,
        .btn-group-vertical .btn+.btn-group,
        .btn-group-vertical .btn-group+.btn,
        .btn-group-vertical .btn-group+.btn-group {
            margin-left: -1px
        }

        .btn-group-vertical .btn-group {
            width: 100%
        }

        .btn-group-vertical>.btn+.btn,
        .btn-group-vertical>.btn+.btn-group,
        .btn-group-vertical>.btn-group+.btn,
        .btn-group-vertical>.btn-group+.btn-group {
            margin-top: -1px;
            margin-left: 0
        }

        /*  */
        .loader-container {}

        .load_animation {
            width: 100%;
            height: 100vh;
            font-size: 4rem;
            background-color: #fff;
            z-index: 500;
            position: fixed;
            top: 0;
            left: 0;
            overflow: hidden;

        }

        .animation {
            position: absolute;
            top: 50%;
            left: 50%;
            border: 3px solid rgb(0, 0, 0);
            border-radius: 50%;
            box-sizing: content-box;
            padding: 10px;
            transform: translate(-50%, -50%);
            opacity: .5;
            animation: spinner 1s infinite;
            transition: .1s;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes spinner {
            50% {
                transform: translate(-50%, -50%);
                border: 2px solid rgba(0, 0, 0, 0.178);
                padding: 30px;
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -50%) rotate(360deg);
                border: 3px solid rgba(0, 0, 0, 0);
                padding: 17rem;
                color: #233975;
            }

        }

        .pie-chart {

            width: 100%;
            padding: 0 10px;
            margin: 0px;
        }

        .text-center {
            text-align: center;
        }

        /* Responsive columns */
        @media screen and (max-width: 600px) {

            .pie-chart,
            .text-center {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }
        .menu-head{
            background-color: whitesmoke;
            color: #233975;
            font-family: sans-serif;
            padding-top: 20px;
            padding-bottom: 20px;
            font-weight: bolder;
        }
        .menu-cont{
            background-color: bisque;
            color: white;
            /* font-family: sans-serif;
            padding-top: 20px;
            padding-bottom: 20px;
            font-weight: bolder; */
        }
        .fondo{
            background-color: black;
        }
    </style>

</head>

<?php
switch ($class) {
    case 'panel':
        $pa = "active ";
        break;
    case 'productos':
        $pro = "active";
        break;
    case 'categorias':
        $cat = "active";
        break;
    case 'accesos':
        $acc = "active";
        break;
    case 'clientes':
        $cli = "active";
        break;
    case 'proveedores':
        $provee = "active";
        break;
    case 'ventas':
        $ven = "active";
        break;
    case 'compras':
        $com = "active";
        break;

    default:
        # code...
        break;
}
($class)
    ?>

<body>
    <div class="loader-container">
        <div class="load_animation">
            <ion-icon name="bag-handle-outline" class="animation">Bad Boys</ion-icon>
        </div>
    </div>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="menu-head">
            <h3>Bad Boys<span>Computer</span></h3>
        </div>

        <div class="side-content menu-cont">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../backend/img/images.jpeg)"></div>
                <h4>
                    <?php echo $_SESSION['username']; ?>
                </h4>
                <small>
                    <?php echo '<strong>' . $_SESSION['nombre'] . '</strong>'; ?>
                </small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="../administrador/escritorio.php" class="<?= $pa; ?> ">
                            <span class="las la-home "></span>
                            <small>Panel</small>
                        </a>
                    </li>

                    <li>
                        <a href="../productos/mostrar.php" type="hidden" class="<?= $pro; ?> <?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-shopping-cart"></span>
                            <small>Productos</small>
                        </a>
                    </li>
                    <li>
                        <a href="../categorias/mostrar.php" class="<?= $cat; ?> <?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-paperclip"></span>
                            <small>Categorias</small>
                        </a>
                    </li>
                    <li>
                        <a href="../accesos/mostrar.php" class="<?= $acc; ?> <?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-user-friends"></span>
                            <small>Accesos</small>
                        </a>
                    </li>
                    <li>
                        <a href="../clientes/mostrar.php" class="<?= $cli; ?><?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-user-friends"></span>
                            <small>Clientes</small>
                        </a>
                    </li>
                    <li>
                        <a href="../proveedores/mostrar.php" class="<?= $provee; ?><?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-user-friends"></span>
                            <small>Proveedores</small>
                        </a>
                    </li>

                    <li>
                        <a href="../ventas/venta.php" class="<?= $ven; ?>">
                            <span class="las la-money-bill"></span>
                            <small>Ventas</small>
                        </a>
                    </li>

                    <li>
                        <a href="../compra/mostrar.php" class="<?= $com; ?><?=($_SESSION['rol']==2)?'disabled':""?>">
                            <span class="las la-store"></span>
                            <small>Compras</small>
                        </a>
                    </li>

                    <li>
                        <a href="../salir.php">
                            <span class="las la-power-off"></span>
                            <small>Salir</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="main-content ">

        <header class="">
            <div class="header-content ">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">

                    <div class="user">
                        <div class="bg-img" style="background-image: url(../../backend/img/images.jpeg)"></div>

                    </div>
                </div>
            </div>
        </header>

        <main class="">

            <div class="page-header">
                <h1>Bienvenido
                    <?php echo '<strong>' . $_SESSION['nombre'] . '</strong>'; ?>
                </h1>