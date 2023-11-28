<script src="../../backend/js/jquery.min.js"></script>
        <!-- Data Tables -->
        <script type="text/javascript" src="../../backend/js/datatable.js"></script>
        <script type="text/javascript" src="../../backend/js/datatablebuttons.js"></script>
        <script type="text/javascript" src="../../backend/js/jszip.js"></script>
        <script type="text/javascript" src="../../backend/js/pdfmake.js"></script>
        <script type="text/javascript" src="../../backend/js/vfs_fonts.js"></script>
        <script type="text/javascript" src="../../backend/js/buttonshtml5.js"></script>
        <script type="text/javascript" src="../../backend/js/buttonsprint.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>
        <script type="text/javascript">
            $(window).on("load", function () {
                $(".load_animation").fadeOut(1000);
            });
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <script src="https://www.google.com/jsapi"></script>


        <script type="text/javascript">
            window.onload = function () {
                google.load("visualization", "1.1", {
                    packages: ["corechart"],
                    callback: 'drawChart'
                });
            };

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Country', 'Popularity'],

                    <?php

                    $stmt = $connect->prepare("SELECT productos.idprod,productos.codpro ,productos.nomprd, productos.desprd, productos.foto, productos.precio, productos.stock, marca.idmar, marca.nomarc, categoria.idcate, categoria.nocate,productos.modelo, productos.peso, productos.state, productos.fere FROM productos INNER JOIN marca ON productos.idmar = marca.idmar INNER JOIN categoria ON productos.idcate = categoria.idcate");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        echo "['" . $row['nomprd'] . "', " . $row['stock'] . "],";
                    }

                    ?>


                ]);

                var options = {
                    pieHole: 0.4,
                    title: 'Productos por stock',
                };

                var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
                chart.draw(data, options);
            }

        </script>


    </body>

    </html>