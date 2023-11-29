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
                    language:{ 
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se Encontraron resultados",
                        "info": "Mostrando registros del _START_ al _END_ de un total _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate":{
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "sPorcessing":"Porcesando...",
                        },                     
                    responsive: "true",
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend:  'copyHtml5',
                            text:   "<i class='bi bi-clipboard-check-fill'>COPY</i>",
                            titleAttr:  'Copiar al Portapapeles',
                            className:  'btn btn-success'
                        },
                        {
                            extend:  'excel',
                            text:   "<i class='bi bi-file-earmark-excel'>Excel</i>",
                            titleAttr:  'Exportar a Excel',
                            className:  'btn bnt-sucess'
                        },
                        {
                            extend:  'pdf',
                            text:   "<i class='bi bi-file-earmark-pdf-fill'>PDF</i>",
                            titleAttr:  'Exportar a PDF',
                            className:  'btn bnt-sucess'
                        },
                        {
                            extend:  'print',
                            text:   "<i class='bi bi-printer-fill'>IMPRIMIR</i>",
                            titleAttr:  'Imprimir',
                            className:  'btn bnt-sucess'
                        }
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
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