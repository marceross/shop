<?
	session_start();	
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/shop-plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<?
include("conex.php");
$categorias=mysql_query("SELECT * FROM categorias WHERE activa='S' AND cod_padre=0",$link);
if(isset($_GET['cod_cat']))
{
	$_SESSION['pcategoria']="SI";
	//Determinamos si la categoria es padre o no
	$categorias_padre=mysql_query("SELECT * FROM categorias WHERE cod=".$_GET['cod_cat'],$link);
    $categoria_padre=mysql_fetch_array($categorias_padre);
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
          <?
	while($categoria=mysql_fetch_array($categorias))
	{
?>
          <tr> 
            <td height="18" valign="top"><p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<? echo $categoria['cod'];?>"><strong><font color="#666666" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?
                echo $categoria['nombre'];
                ?>
                </font></strong></a></p></td>
            <?
                if($_SESSION['pcategoria']=="SI")
                {
                	if($categoria['cod']==$_SESSION['cat_padre_activa'])
                    {
                		$subcategorias=mysql_query("SELECT * FROM categorias WHERE cod_padre=".$_SESSION['cat_padre_activa']." AND activa='S'",$link);
                		while($subcategoria=mysql_fetch_array($subcategorias))
                		{
?>
          <tr> 
            <td height="18" valign="top"><p><a style="text-decoration:none" href="shop_productos.php?cod_cat=<? echo $subcategoria['cod'];?>"><strong><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?
                            echo $subcategoria['nombre'];
    ?>
                </font></strong></a></p></td>
          </tr>
          <?
         				}
                 	  }
                   }
	}
	mysql_data_seek($categorias,0);
	
?>
        </table></td>
      <td width="601" valign="top"><!-- InstanceBeginEditable name="EditRegion3" -->
<?	
	$cantidad=mysql_num_rows($categorias);
	if(!isset($_SESSION['nro_pagina']) or isset($_GET['cod_cat']))
	{
		if(!isset($_GET['v']))
		{
			$_SESSION['nro_pagina']=1;
		}
	}
	if(isset($_GET['pag']))
	{
		$_SESSION['nro_pagina']=$_GET['pag'];
	}
	/*if(!isset($_SESSION['productos_mostrados']))
	{
		$_SESSION['productos_mostrados']=0;
	}*/
	if(isset($_GET['accion']) or isset($_GET['v']) or isset($_GET['pag']))
	{
		$productos=mysql_query($_SESSION['consulta_guardada'],$link);
		/*if($_GET['accion']==1)
		{
			if($_SESSION['productos_mostrados']>6)
			{
				$_SESSION['productos_mostrados']=$_SESSION['productos_mostrados']-6;
			}
			else
			{
				$_SESSION['productos_mostrados']=0;
			}
		}
		else		
		{
			if($_SESSION['productos_mostrados']>6)
			{
				$_SESSION['productos_mostrados']=$_SESSION['productos_mostrados']-6;
			}
			else
			{
				$_SESSION['productos_mostrados']=0;
			}
		}*/
	}
	else
	{
		//20 mas buscados
		if(isset($_GET['ranking']))
		{
			$productos=mysql_query("SELECT productos.cod as cod, foto, costo, margen, productos.nombre as nombre, cod_cat FROM productos,categorias WHERE foto IS NOT NULL AND foto<>'' AND cod_cat=categorias.cod ORDER BY clicks DESC LIMIT 20",$link);
			$_SESSION['consulta_guardada']="SELECT productos.cod as cod, foto, costo, margen, productos.nombre as nombre, cod_cat FROM productos,categorias WHERE foto IS NOT NULL AND foto<>'' AND cod_cat=categorias.cod ORDER BY clicks DESC LIMIT 20";
			$_SESSION['nro_pagina']=1;
		}
		else
		{
			if(!isset($_POST['criterio']))
			{		
				if(!isset($_GET['marca']))
				{
					//Busqueda por categoria
					$_SESSION['pcategoria']="SI";
					$_SESSION['productos_mostrados']=0;
					$cod=$_SESSION['cod']=$_GET['cod_cat'];
					//Busco los datos de la categoria seleccionada
					$categorias_seleccionadas=mysql_query("SELECT * FROM categorias WHERE cod='$cod'",$link);
					$categoria_seleccionada=mysql_fetch_array($categorias_seleccionadas);
					if($categoria_seleccionada['cod_padre']==0)
					{
						$productos=mysql_query("SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod')) LIMIT 60",$link);
						$_SESSION['consulta_guardada']="SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod')) LIMIT 60";
					}
					else
					{
						$productos=mysql_query("SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod'))",$link);
						$_SESSION['consulta_guardada']="SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod'))";
					}
				}
				else
				{
					$_SESSION['nro_pagina']=1;
					//Busqueda por marca
					$_SESSION['pcategoria']="NO";
					$cod_marca=$_GET['marca'];
					$productos=mysql_query("SELECT productos.cod as cod, cod_cat, foto FROM productos, categorias WHERE categorias.cod=cod_cat AND id_marca='$cod_marca' AND activa='S' AND (foto IS NOT NULL AND foto<>'')",$link);
					
					$_SESSION['consulta_guardada']="SELECT productos.cod as cod, cod_cat,foto FROM productos, categorias WHERE categorias.cod=cod_cat AND id_marca='$cod_marca' AND activa='S' AND (foto IS NOT NULL AND foto<>'')";
				}
			}
			else
			{
				//Busqueda por criterio
				$_SESSION['pcategoria']="NO";
				if($_POST['criterio']<>"")
				{
					$_SESSION['nro_pagina']=1;
					//Inicializamos el arreglo vacio
					for ($i=0;$i<=19;$i++)
					{
						$palabras[$i]='';
					}
					$i=0;
					$pal='';
					//Separamos las palabras---------------------
					$_POST['criterio']=$_POST['criterio']." ";
					for($j=0;$j<strlen($_POST['criterio']);$j++)		
					{
						if(substr($_POST['criterio'],$j,1)<>' ')
						{
							$pal=$pal.substr($_POST['criterio'],$j,1);				
						}			
						else
						{		
							if(strlen($pal)>=3)
							{		
								$palabras[$i]=$pal;				
								$i++;
							}						
							$pal='';
						}			
					}
					$condiciones='';
					for($i=0;$i<=19;$i++)
					{
						if($palabras[$i]<>'')
						{
							if($condiciones<>'')
							{
								$condiciones=$condiciones." OR ";
							}
							$condiciones=$condiciones."categorias.nombre LIKE '%".$palabras[$i]."%' OR productos.nombre LIKE '%".$palabras[$i]."%' OR productos.descripcion LIKE '%".$palabras[$i]."%' OR marcas.nombre LIKE '%".$palabras[$i]."%'";
						}
					}		
					$productos=mysql_query("SELECT productos.cod as cod, categorias.cod as cod_cat, foto FROM productos, categorias, marcas WHERE (foto IS NOT NULL AND foto<>'') AND (activa='S' AND productos.id_marca=marcas.id_marca AND productos.cod_cat=categorias.cod) AND (".$condiciones.")",$link);				
					$_SESSION['consulta_guardada']="SELECT productos.cod as cod, categorias.cod as cod_cat, foto FROM productos, categorias, marcas WHERE (foto IS NOT NULL AND foto<>'') AND (activa='S' AND productos.id_marca=marcas.id_marca AND productos.cod_cat=categorias.cod) AND (".$condiciones.")";
				}	
				else
				{	
					header("Location:shop.php");
				}
			}
		}
}
	$cantidad_productos=mysql_num_rows($productos);		
	if($cantidad_productos>0)
	{
		$resto=$cantidad_productos%6;	
		if($resto>0)
		{
			$cantidad_paginas=intval($cantidad_productos/6)+1;
		}	
		else
		{
			$cantidad_paginas=intval($cantidad_productos/6);
		}
		if(isset($_GET['accion']))
		{
			if($_GET['accion']==2)
			{			
				if($_SESSION['nro_pagina']<$cantidad_paginas)
				{				
					$_SESSION['nro_pagina']++;
				}
			}
			else
			{
				if($_SESSION['nro_pagina']>1)
				{
					$_SESSION['nro_pagina']--;				
				}
			}
		}	
		mysql_data_seek($productos,(($_SESSION['nro_pagina']*6)-6));	
		//mysql_data_seek($productos,5);	
	}		
?>      
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="419" height="31" valign="top"><strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop.php">inicio</a></font></strong></td>
          </tr>
     </table>
<?
	if($cantidad_productos>0)
	{
?>                
     <table width="577" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <?
	//$mostrados=0;	
	for($mostrados=0;$mostrados<3;$mostrados++)
	//while($producto=mysql_fetch_array($productos) and $mostrados<3)
	{
		if($producto=mysql_fetch_array($productos))
		{
			//Esta cuenta la cantidad de productos mostrados POR PAGINA
			//$mostrados++;	
			//Esta variable contabiliza el total de productos mostrados EN TOTAL
			//$_SESSION['productos_mostrados']=$_SESSION['productos_mostrados']+1;
?>
            	<td><a href="shop_detalle.php?cod=<? echo $producto['cod'];?>&cod_cat=<? echo $_SESSION['cat_padre_activa'];?>"><img width="190" height="190" border="0" src="<? echo $producto['foto'];?>" /></a></td>        
<?
		}
	}	
?>
          </tr>
          <tr> 
<?
	//if($_SESSION['productos_mostrados']<$cantidad_productos)
	//{		
		//mysql_data_seek($productos,(($_SESSION['nro_pagina']*6)-6)+3);
		while($producto=mysql_fetch_array($productos) and $mostrados<6)
		{
			$mostrados++;			
			//$_SESSION['productos_mostrados']=$_SESSION['productos_mostrados']+1;
?>
            <td><a href="shop_detalle.php?cod=<? echo $producto['cod'];?>&cod_cat=<? echo $_SESSION['cat_padre_activa'];?>"><img width="190" height="190" border="0" src="<? echo $producto['foto'];?>" /></a></td>
<?
		}	
	//}	
?>
          </tr>
          <tr>
            <td>
              <div align="left">
                <table width="179" border="0" cellspacing="0">
                  <tr>
                    <td width="22"><center>
                      <a style="text-decoration:none" href="shop_productos.php?accion=1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&lt;&lt;</strong></font></a>
                    </center>                    </td>
                    <td width="131"><center>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
<?
	for($h=1;$h<=$cantidad_paginas;$h++)
	{
		if($h<>$cantidad_paginas)
		{
			echo "<a style=text-decoration:none href=shop_productos.php?cod_cat=".$_SESSION['cod']."&pag=".$h.">".$h."-</a>";
		}
		else
		{
			echo "<a style=text-decoration:none href=shop_productos.php?cod_cat=".$_SESSION['cod']."&pag=".$h.">".$h."</a>";
		}
	}
?>
                        </font>
                    </center>                    </td>
                    <td width="20"><center>
                      <a style="text-decoration:none" href="shop_productos.php?accion=2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>&gt;&gt;</strong></font></a>
                    </center>                    </td>
                  </tr>
                                  </table>
            </div></td>
          </tr>
        </table>
        <center>
          <?
	}
	else
	{
?>        
          
          <img src="archivos_recibidos/no_disponible.jpg" width="190" height="190">    
<?
	}
?>             
          </center>
        <!-- InstanceEndEditable --></td>
      <td width="172" valign="top"><img src="marcas.gif" width="169" height="377" border="0" usemap="#Map" /></td>
    </tr>
    <tr> 
      <td height="32" colspan="3" background="fondopie2.png"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>GRAVITAL 
          BOARD HOUSE ® | Rafael Nu&ntilde;ez 3491 | Cerro de las Rosas | Cordoba 
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
