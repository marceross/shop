<?php
session_start();
$_SESSION['pcategoria'] = "NO";

// Conexión a la base de datos (usando mysqli)
include("conex.php");

// Consulta segura para obtener categorías principales activas
$query = "SELECT * FROM categorias WHERE activa = 'S' AND cod_padre = 0";
$categorias = mysqli_query($link, $query);

if (isset($_GET['cod_cat'])) {
    $_SESSION['pcategoria'] = "SI";
    
    // Usamos prepared statements para mayor seguridad
    $stmt = $link->prepare("SELECT * FROM categorias WHERE cod = ?");
    $stmt->bind_param("i", $_GET['cod_cat']);
    $stmt->execute();
    $result = $stmt->get_result();
    $categoria_padre = $result->fetch_assoc();

    // Determinamos si la categoría es padre o no
    if ($categoria_padre['cod_padre'] == 0) {
        $_SESSION['cat_padre_activa'] = $_GET['cod_cat'];
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>GRAVITAL BOARD HOUSE</title>
    <script>
        // Función de clic derecho (comentada por ahora)
        /*
        function rightclickmenu(e) {
            if (document.all) {
                awmShowMenu('rightCLICK', event.clientX + document.body.scrollLeft, event.clientY + document.body.scrollTop);
                return false;
            }
            if (navigator.userAgent.indexOf('Gecko') > -1) {
                awmShowMenu('rightCLICK', e.pageX, e.pageY);
                return false;
            }
        }
        document.oncontextmenu = rightclickmenu;
        */
    </script>
</head>
<body link="#0000FF" vlink="#0000FF" alink="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
    <table width="930" height="600" border="0" align="center">
        <tr> 
            <td height="104" colspan="3">
                <img src="../banner_shop4.gif" width="920" height="150" border="0" usemap="#Map2">
            </td>
        </tr>
        <tr> 
            <td width="143" height="416" valign="top">
                <table width="143" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                        <td width="143" height="24" valign="top">
                            <form name="form1" method="post" action="shop_productos.php">
                                <label>
                                    <input name="criterio" type="text" size="8" maxlength="20">
                                </label>
                                <input type="submit" name="Submit2" value="buscar">
                            </form>
                        </td>
                    </tr>
                    <tr> 
                        <td height="20" valign="top">
                            <strong><font color="#000000" size="3" face="Verdana, Arial, Helvetica, sans-serif">Productos</font></strong>
                        </td>
                    </tr>
                    <?php
                    while ($categoria = mysqli_fetch_assoc($categorias)) {
                    ?>
                    <tr> 
                        <td height="18" valign="top">
                            <p>
                                <a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
                                    <strong><font color="#666666" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                                    </font></strong>
                                </a>
                            </p>
                        </td>
                    </tr>
                    <?php
                    // Mostrar subcategorías si hay una categoría seleccionada
                    if ($_SESSION['pcategoria'] == "SI" && $categoria['cod'] == $_SESSION['cat_padre_activa']) {
                        $subcategorias_query = "SELECT * FROM categorias WHERE cod_padre = ? AND activa = 'S'";
                        $stmt = $link->prepare($subcategorias_query);
                        $stmt->bind_param("i", $_SESSION['cat_padre_activa']);
                        $stmt->execute();
                        $subcategorias_result = $stmt->get_result();

                        while ($subcategoria = $subcategorias_result->fetch_assoc()) {
                    ?>
                    <tr> 
                        <td height="18" valign="top">
                            <p>
                                <a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $subcategoria['cod']; ?>">
                                    <strong><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                                    <?php echo htmlspecialchars($subcategoria['nombre']); ?>
                                    </font></strong>
                                </a>
                            </p>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    }
                    // Reiniciar puntero de la consulta
                    mysqli_data_seek($categorias, 0);
                    ?>
                </table>
                <br>
                <table width="90%" border="0" align="left">
                    <tr>
                        <td><a href="undiadewake.php"><img src="undiadewake2.gif" width="128" height="66" border="0"></a></td>
                    </tr>
                </table>
                <p>&nbsp;</p>
            </td>
            <td width="601" valign="top">
            <?php
            // Selección aleatoria de categorías
            $cantidad = mysqli_num_rows($categorias);
            $numeros = array_fill(0, 6, -1);

            for ($i = 0; $i < 6; $i++) {
                do {
                    $aleatorio = rand(0, $cantidad - 1);
                } while (in_array($aleatorio, $numeros));

                $numeros[$i] = $aleatorio;
            }
            ?>      
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                    <td width="419" height="31" valign="top">&nbsp;</td>
                </tr>
            </table>
            <table width="577" border="0" cellpadding="0" cellspacing="0">
                <tr>
                <?php
                // Mostrar las primeras 3 categorías
                for ($j = 0; $j < 3; $j++) {
                    mysqli_data_seek($categorias, $numeros[$j]);
                    $categoria = mysqli_fetch_assoc($categorias);
                ?>
                    <td width="571" height="192" valign="top">
                        <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
                            <img width="190" height="190" border="0" src="<?php echo htmlspecialchars($categoria['foto_generica']); ?>" />
                        </a>
                    </td>
                <?php
                }
                ?>
                </tr>
                <tr>
                <?php
                // Mostrar las siguientes 3 categorías
                for ($j = 3; $j < 6; $j++) {
                    mysqli_data_seek($categorias, $numeros[$j]);
                    $categoria = mysqli_fetch_assoc($categorias);
                ?>
                    <td height="192" valign="top">
                        <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
                            <img width="190" height="190" border="0" src="<?php echo htmlspecialchars($categoria['foto_generica']); ?>" />
                        </a>
                    </td>
                <?php
                }
                ?>
                </tr>
            </table>
            </td>
            <td width="172" valign="top">
                <img src="../marcas.gif" width="169" height="377" border="0" usemap="#Map" />
            </td>
        </tr>
        <tr> 
            <td height="32" colspan="3" background="../fondopie2.png">
                <div align="center">
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        <strong>GRAVITAL BOARD HOUSE &copy; | Rafael Nuñez 3491 | Cerro de las Rosas | Córdoba | Argentina<br>
                        0351-5988630 | gravital@boardhouse.com.ar</strong>
                    </font>
                </div>
            </td>
        </tr>
    </table>
</div>
<map name="Map">
    <!-- Áreas de imagen mapeadas -->
</map>
<map name="Map2">
    <!-- Áreas de imagen mapeadas -->
</map>
</body>
</html>
