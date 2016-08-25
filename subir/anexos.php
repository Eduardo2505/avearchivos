
<?php
// Start the session
session_start();
include 'conexion.php';
?>


<?php
// Set session variables
$idreg = $_GET["idregistro"];
$_SESSION["idregistro"] = $idreg;
?>

<!DOCTYPE html>
<html lang="es">
    <head>        
        <title>AVE</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="icon" type="image/ico" href="logobfavicon.ico"/>

        <link href="js/plugins/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" type="text/css" />
        <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
        <link href="css/codemirror/theme/midnight.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../js/plupload.full.min.js"></script>

    </head>
    <body class="bg-img-num1"> 

        <div class="container">        
            <div class="row">                   
                <div class="col-md-12">

                    <nav class="navbar brb" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Navegador</span>
                                <span class="icon-reorder"></span>                            
                            </button>                                                
                            <a class="navbar-brand" href="http://helpmex.com.mx/Ave/solicitudes/mostrar"><img src="img/logo.png"/></a>                                                                                     
                        </div>
                        <div class="collapse navbar-collapse navbar-ex1-collapse">                                     
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="http://helpmex.com.mx/Ave/solicitudes/mostrar">
                                        <span class="icon-home"></span> Regresar
                                    </a>
                                </li>                            



                            </ul>

                        </div>
                    </nav>               

                </div>            
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>                    
                        <li><a href="#">Solicitudes</a></li>                    
                        <li class="active">Anexos</li>
                    </ol>
                </div>
            </div>                                                


            <div class="row">
                <div class="col-md-1" ></div>

                <div class="col-md-4" >

                    <div class="block block-transparent" >
                        <div class="header">
                            <h2>Anexos</h2>
                        </div>
                        <div class="content np">
                            <div id="filelist" style="width: 100%; height: 250px;">Su navegador no tiene soporte para Flash , Silverlight o HTML5..</div>
                        </div>

                        <div id="container">
                            <a id="pickfiles" href="javascript:;" class="btn btn-success">Seleccione Archivos</a> 
                            <a id="uploadfiles" href="javascript:;" class="btn btn-default">Subir Archivos</a>
                        </div>  



                        <script type="text/javascript">
                            // Custom example logic

                            var uploader = new plupload.Uploader({
                                runtimes: 'html5,flash,silverlight,html4',
                                browse_button: 'pickfiles', // you can pass an id...
                                container: document.getElementById('container'), // ... or DOM Element itself
                                url: 'upload.php',
                                flash_swf_url: '../js/Moxie.swf',
                                silverlight_xap_url: '../js/Moxie.xap',
                                filters: {
                                    max_file_size: '40mb',
                                    mime_types: [
                                        {title: "Image files", extensions: "jpg,gif,png,pdf,xls,xlsx,xlsm,dwg"},
                                        {title: "Zip files", extensions: "zip"}
                                    ]
                                },
                                init: {
                                    PostInit: function() {
                                        document.getElementById('filelist').innerHTML = '';

                                        document.getElementById('uploadfiles').onclick = function() {
                                            uploader.start();
                                            return false;
                                        };
                                    },
                                    FilesAdded: function(up, files) {
                                        plupload.each(files, function(file) {
                                            document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';

                                        });
                                    },
                                    UploadProgress: function(up, file) {
                                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";

                                    },
                                    Error: function(up, err) {
                                        document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                                    },
                                    UploadComplete: function(up, files) {
                                         location.reload();
                                    }


                                }


                            });
                        

                            uploader.init();

                        </script>						  
                    </div>


                </div>
                <div class="col-md-6" >


                    <div class="block">
                        <div class="header">
                            <h2>Archivos</h2>
                        </div>
                        <div class="content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descargar</th>
                                        <th>Eliminar</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT * FROM archivos where idRegistro='".$idreg."'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td><?php echo $row["nombre"] ?></td>
                                                <td>

                                                    <a href="<?php echo $row["url"] ?>" target="_black" class="btn btn-info">Descargar</a>
                                                </td>
                                                <td>

                                                    <a href="eliminar.php?idarchivo=<?php echo $row["idarchivos"] ?>&idregistro=<?php echo $idreg ?>" class="btn btn-danger">Eliminar</a>
                                                </td>

                                            </tr>




                                            <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>





                                </tbody>
                            </table>                       
                        </div>
                    </div>    






                </div>	

            </div>



        </div>

    </body>
</html>