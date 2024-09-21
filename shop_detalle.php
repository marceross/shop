<?php	
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/shop-plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<?php
include("conex.php");
$categorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE activa='S' AND cod_padre=0");

if(isset($_GET['cod_cat']))
{
	$_SESSION['pcategoria']="SI";
	//Determinamos si la categoria es padre o no
	$categorias_padre = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod=" . $_GET['cod_cat']);
    $categoria_padre=mysqli_fetch_array($categorias_padre);
    if($categoria_padre['cod_padre']==0)
    {
		$_SESSION['cat_padre_activa']=$_GET['cod_cat'];
    }
}
?>
<head>
<link rel="icon" href="http://www.boardhouse.com.ar/4.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.boardhouse.com.ar/4.ico" type="image/x-icon" />
<meta http-equiv="" content="text/html; charset=iso-8859-1">
<META NAME="Description" CONTENT="Casa de Deportes Extremos">
<META NAME="Keywords" CONTENT="skate,wakeboard,kitesurf,snowboard,longboard,surf,kite,wake,wakeskate,wakesurf,tablas,decks,boards">
<META NAME="Robots" CONTENT="All">
<script>

function awmShowMenu(x,y,z,v){} 

document.oncontextmenu = rightclickmenu; 

function rightclickmenu(e) {if (document.all) {awmShowMenu('rightCLICK',event.clientX+document.body.scrollLeft,event.clientY+document.body.scrollTop); return false;} 

if (navigator.userAgent.indexOf('Gecko')>-1) {awmShowMenu('rightCLICK',e.pageX,e.pageY); return false;}} 
// End -->

<!-- Begin
/*function right(e) {
if (navigator.appName == 'Netscape' && 
(e.which == 3 || e.which == 2))
return false;
else if (navigator.appName == 'Microsoft Internet Explorer' && 
(event.button == 2 || event.button == 3)) {
//alert("SOLO BOTON IZQUIERDO");
return false;
}
return true;
}

document.onmousedown=right;
document.onmouseup=right;
if (document.layers) window.captureEvents(Event.MOUSEDOWN);
if (document.layers) window.captureEvents(Event.MOUSEUP);
window.onmousedown=right;
window.onmouseup=right;
//  End -->*/
</script>
<!-- InstanceBeginEditable name="doctitle" -->
<title>GRAVITAL BOARD HOUSE</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body link="#0000FF" vlink="#0000FF" alink="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
  <table width="930" height="600" border="0" align="center">
    <!--DWLayoutTable-->
    <tr> 
      <td height="104" colspan="3"><img src="banner_shop4.gif" width="920" height="150" border="0" usemap="#Map2"></td>
    </tr>
    <tr> 
      <td width="143" height="416" valign="top"><table width="143" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="143" height="24" valign="top"><form name="form1" method="post" action="shop_productos.php">
                <label> 
                <input name="criterio" type="text" id="textfield" size="8" maxlength="20">
                </label>
                <input type="submit" name="Submit2" value="buscar">
              </form></td>
          </tr>
          <tr> 
            <td height="20" valign="top"><strong><font color="#000000" size="3" face="Verdana, Arial, Helvetica, sans-serif">Productos</font></strong></td>
          </tr>
          <?php
	while($categoria=mysqli_fetch_array($categorias))
	{
?>
          <tr> 
            <td height="18" valign="top"><p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $categoria['cod'];?>"><strong><font color="#666666" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?php
                echo $categoria['nombre'];
                ?>
                </font></strong></a></p></td>
            <?php
                if($_SESSION['pcategoria']=="SI")
                {
                	if($categoria['cod']==$_SESSION['cat_padre_activa'])
                    {
                		
                		$subcategorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod_padre=" . $_SESSION['cat_padre_activa'] . " AND activa='S'");
                		while($subcategoria=mysqli_fetch_array($subcategorias))
                		{
?>
          <tr> 
            <td height="18" valign="top"><p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $subcategoria['cod'];?>"><strong><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?php
                            echo $subcategoria['nombre'];
    ?>
                </font></strong></a></p></td>
          </tr>
          <?php
         				}
                 	  }
                   }
	}
	mysqli_data_seek($categorias,0);
	
?>
        </table></td>
      <td width="601" valign="top"><!-- InstanceBeginEditable name="EditRegion3" -->
<?php	
	$cod=$_GET['cod'];
	//Contabilizamos el click
	mysqli_query($mysqli,"UPDATE productos SET clicks=clicks+1 WHERE cod='$cod'");
	//$cod_cat=$_GET['cod_cat'];
	$productos=mysqli_query($mysqli,"SELECT cod, productos.nombre as nombre, marcas.nombre as marca, logo, descripcion, costo, foto, stock, cod_cat,marcas.id_marca as id_marca FROM productos,marcas WHERE marcas.id_marca=productos.id_marca AND cod='$cod'");
	$producto=mysqli_fetch_array($productos);	
	$cod_cat=$producto['cod_cat'];
	$categorias2=mysqli_query($mysqli,"SELECT * FROM categorias WHERE cod='$cod_cat'");
	$categoria_activa=mysqli_fetch_array($categorias2);
	$imagenes=mysqli_query($mysqli,"SELECT * FROM productos_imagenes WHERE cod='$cod'");
?>      
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
		  <tr> 
            <td width="419" height="31" valign="top"><strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop.php">inicio 
              </a></font></strong><strong><font size="4" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $cod_cat;?>&v=1"> 
              <?php echo "-"." ".$categoria_activa['nombre'];?></a></font></strong><strong><font color="#0000CC" size="5"> 
              <?php echo " "."-"." ".$producto['nombre'];?></font></strong></td>
          </tr>
        </table><table width="545" border="0" align="center" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="190" rowspan="5" valign="top"><img src="<?php echo $producto['foto'];?>" alt="" width="190" height="190" /></a></td>
            <td width="45" height="21">&nbsp;</td>
            <td width="330" valign="top"><strong><font color="#006600">Producto:</font></strong> 
              <?php echo $producto['nombre'];?> </td>
            <td width="4"></td>
          </tr>
          <tr> 
            <td height="21">&nbsp;</td>
            <td valign="top"><strong><font color="#006600">Marca:</font></strong> 
              <?php echo $producto['marca'];?> </td>
            <td></td>
          </tr>
          <tr> 
            <td height="21">&nbsp;</td>
            <td valign="top"><strong><font color="#006600">Descripcion:</font></strong> 
             <?php echo $producto['descripcion'];?> </td>
            <td></td>
          </tr>
          <tr> 
            <td height="21">&nbsp;</td>
            <td valign="top"><strong><font color="#006600">Precio:</font></strong> 
              <?php echo round($producto['costo']*$categoria_activa['margen']);?> </td>
            <td></td>
          </tr>
          <tr> 
            <td height="108">&nbsp;</td>
            <td><a href="shop_productos.php?marca=<?php echo $producto['id_marca'];?>"><img src="<?php echo $producto['logo'];?>" alt="" border="0" /></a></td>
            <td></td>
          </tr>
          <tr> 
            <td height="18"></td>
            <td></td>
            <td><div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">stock:<?php echo ($producto['stock']);?> 
                </font></div></td>
            <td></td>
          </tr>
          <tr> 
            <td height="136" colspan="3" valign="top"><div align="center"> 
                <form name="form2" id="form2" method="post" action="procesa_consulta.php?cod=<?php echo $producto['cod'];?>">
                  <p> 
                    <textarea name="consulta" cols="50" id="consulta"></textarea>
                    consulta</p>
                  <p> 
                    <input name="mail" type="text" id="mail" />
                    mail 
                    <input type="submit" name="Submit" value="Enviar" />
                  </p>
                </form>
              </div></td>
            <td></td>
          </tr>
        </table><!-- InstanceEndEditable --></td>
      <td width="172" valign="top"><img src="marcas.gif" width="169" height="377" border="0" usemap="#Map" /></td>
    </tr>
    <tr> 
      <td height="32" colspan="3" background="fondopie2.png"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>GRAVITAL 
          BOARD HOUSE ¢î | Rafael Nu&ntilde;ez 3491 | Cerro de las Rosas | Cordoba 
          | Argentina<br>
          0351-5988630 | gravital@boardhouse.com.ar</strong></font></div></td>
    </tr>
  </table>
</div>

<map name="Map"><area shape="rect" coords="5,7,110,26" href="shop_productos.php?marca=10">
  <area shape="circle" coords="146,23,21" href="shop_productos.php?marca=11">
  <area shape="rect" coords="11,32,105,56" href="shop_productos.php?marca=4">
  <area shape="rect" coords="8,61,51,110" href="shop_productos.php?marca=5">
  <area shape="rect" coords="62,58,115,112" href="shop_productos.php?marca=17">
  <area shape="rect" coords="123,63,164,102" href="shop_productos.php?marca=8">
  <area shape="rect" coords="8,123,101,158" href="shop_productos.php?marca=6">
  <area shape="rect" coords="7,168,79,193" href="shop_productos.php?marca=15">
  <area shape="rect" coords="4,201,88,217" href="shop_productos.php?marca=7">
  <area shape="rect" coords="98,203,164,246" href="shop_productos.php?marca=3">
  <area shape="rect" coords="3,223,56,296" href="shop_productos.php?marca=1">
  <area shape="rect" coords="130,317,164,372" href="shop_productos.php?marca=9">
  <area shape="rect" coords="79,320,122,369" href="shop_productos.php?marca=16">
  <area shape="rect" coords="2,306,67,333" href="shop_productos.php?marca=18">
  <area shape="rect" coords="63,253,165,278" href="shop_productos.php?marca=20">
  <area shape="rect" coords="1,341,70,370" href="shop_productos.php?marca=2">
  <area shape="rect" coords="75,281,162,309" href="shop_productos.php?marca=19">
</map>
<map name="Map2">
  <area shape="rect" coords="10,129,57,147" href="shop.php">
  <area shape="rect" coords="855,0,911,18" href="shop_contacto.php">
  <area shape="rect" coords="763,0,840,19" href="shop_comollegar.php">
  <area shape="rect" coords="653,0,745,18" href="shop_comocomprar.php">
  <area shape="rect" coords="119,1,173,19" href="shop_horarios.php">
  <area shape="rect" coords="14,0,105,17" href="shop_quienessomos.php">
</map>
</body>
<!-- InstanceEnd --></html>
