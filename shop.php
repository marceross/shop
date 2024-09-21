<?php
session_start();
$_SESSION['pcategoria'] = "NO";

include("conex.php"); // Ensure that $mysqli is defined here

// Query to fetch active parent categories
$categorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE activa='S' AND cod_padre=0");

if (isset($_GET['cod_cat'])) {
    $_SESSION['pcategoria'] = "SI";
    // Determine if the category is a parent category
    $categorias_padre = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod=" . $_GET['cod_cat']);
    $categoria_padre = mysqli_fetch_array($categorias_padre);
    if ($categoria_padre['cod_padre'] == 0) {
        $_SESSION['cat_padre_activa'] = $_GET['cod_cat'];
    }
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>GRAVITAL BOARD HOUSE</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body link="#0000FF" vlink="#0000FF" alink="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
  <table width="930" height="600" border="0" align="center">
    <tr> 
      <td height="104" colspan="3">
        <img src="../shop/banner_shop4.gif" width="920" height="150" border="0" usemap="#Map2">
      </td>
    </tr>
    <tr> 
      <td width="143" height="416" valign="top">
        <table width="143" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="143" height="24" valign="top">
              <form name="form1" method="post" action="shop_productos.php">
                <label> 
                <input name="criterio" type="text" id="textfield" size="8" maxlength="20">
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
          while ($categoria = mysqli_fetch_array($categorias)) {
          ?>
          <tr> 
            <td height="18" valign="top">
              <p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
                <strong><font color="#666666" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                  <?php echo $categoria['nombre']; ?>
                </font></strong></a></p>
            </td>
          </tr>
          <?php
              if ($_SESSION['pcategoria'] == "SI" && $categoria['cod'] == $_SESSION['cat_padre_activa']) {
                  $subcategorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod_padre=" . $_SESSION['cat_padre_activa'] . " AND activa='S'");
                  while ($subcategoria = mysqli_fetch_array($subcategorias)) {
          ?>
          <tr> 
            <td height="18" valign="top">
              <p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $subcategoria['cod']; ?>">
                <strong><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <?php echo $subcategoria['nombre']; ?>
                </font></strong></a></p>
            </td>
          </tr>
          <?php
                  }
              }
          }
          // Reset the pointer of the result set for categories
          mysqli_data_seek($categorias, 0);
          ?>
        </table>
        <br>
        <table width="90%" border="0" align="left">
          <tr>
            <td><a href="../shop/undiadewake.php"><img src="../shop/undiadewake2.gif" width="128" height="66" border="0"></a></td>
          </tr>
        </table>
      </td>
      <td width="601" valign="top">
      <?php
      // Getting the total number of categories
      $cantidad = mysqli_num_rows($categorias);
      $numeros = array_fill(1, 6, -1);
      for ($i = 1; $i <= 6; $i++) {
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
        for ($j = 1; $j <= 3; $j++) {
            mysqli_data_seek($categorias, $numeros[$j]);
            $categoria = mysqli_fetch_array($categorias);
        ?>
          <td width="571" height="192" valign="top">
            <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
              <img width="190" height="190" border="0" src="<?php echo $categoria['foto_generica']; ?>" />
            </a>
          </td>
        <?php
        }
        ?>
        </tr>
        <tr> 
        <?php
        for ($j = 4; $j <= 6; $j++) {
            mysqli_data_seek($categorias, $numeros[$j]);
            $categoria = mysqli_fetch_array($categorias);
        ?>
          <td height="192" valign="top">
            <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
              <img width="190" height="190" border="0" src="<?php echo $categoria['foto_generica']; ?>" />
            </a>
          </td>
        <?php
        }
        ?>
        </tr>
      </table>
      </td>
      <td width="172" valign="top"><img src="../shop/marcas.gif" width="169" height="377" border="0" usemap="#Map" /></td>
    </tr>
    <tr> 
      <td height="32" colspan="3" background="../shop/fondopie2.png">
        <div align="center">
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
            GRAVITAL BOARD HOUSE © | Rafael Nuñez 3491 | Cerro de las Rosas | Cordoba | Argentina<br>
            0351-5988630 | gravital@boardhouse.com.ar
          </strong></font>
        </div>
      </td>
    </tr>
  </table>
</div>

<map name="Map">
  <!-- Map areas go here -->
</map>
<map name="Map2">
  <!-- Map areas go here -->
</map>
</body>
</html>
