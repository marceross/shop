<?php
	session_start();	
?>
<!DOCTYPE html>
<html>
<?php
include("conex.php");



$categorias =mysqli_query($mysqli,"SELECT * FROM categorias WHERE activa='S' AND cod_padre=0");





if(isset($_GET['cod_cat']))
{
	$_SESSION['pcategoria']="SI";
	//Determinamos si la categoria es padre o no
$categorias_padre = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod=" . $_GET['cod_cat']);
    $categoria_padre = mysqli_fetch_array($categorias_padre);
    if($categoria_padre['cod_padre']==0)
    {
		$_SESSION['cat_padre_activa']=$_GET['cod_cat'];
    }
}else if(isset($_POST['criterio'])){
			

}else if(isset($_GET['marca'])){

    
}else{
    header("Location:shop.php");
    exit();
}
?>
<head>
<link rel="icon" href="fav.gif" type="image/gif" >
<meta charset="utf-8">
<meta name="description" content="GRAVITAL BOARD HOUSE">
<meta name="keywords" content="GRAVITAL BOARD HOUSE">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet">
 <script src="css/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="css/jquery.min.js"></script>
<script>

//function awmShowMenu(x,y,z,v){} 
//document.oncontextmenu = rightclickmenu; 

//function rightclickmenu(e) {if (document.all) {awmShowMenu('rightCLICK',event.clientX+document.body.scrollLeft,event.clientY+document.body.scrollTop); return false;} 

//if (navigator.userAgent.indexOf('Gecko')>-1) {awmShowMenu('rightCLICK',e.pageX,e.pageY); return false;}} 



</script>

<title>GRAVITAL BOARD HOUSE</title>

</head>
<body>
    
  <style>
    
     @media screen and (max-width: 767px) {
            
           
            
            
        }
    
     @media screen and (min-width: 992px) {
        .container{
                max-width:930px!important;margin:0 auto;
            }
            
            
    }
    
    @media screen and (max-width: 991px) {
        .p_list img{
                width:200px;
                height:200px;
            }
            .container{
                max-width:100%!important;margin:0 auto;
            }
    }
    @media screen and (min-width: 576px) {
        .p_list img{
                width:200px;
                height:200px;
            }
            
    }
    
   
    
        
        
        
        
        
        .category_layout{
                 box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);

                margin-bottom: 15px;
                margin-top: 15px;
                padding:10px;
                border-radius: 7px;
            }
            
            
        
        
        .box_layout{
             box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
text-align: center;
    margin-bottom: 15px;
     border-radius: 7px;
        }
        
        .box_layout:hover {
   
}

 @media screen and (max-width: 330px) {
             .search_field{
                 width:50%!important;
             }
         }
         
         #slide_toogle ul li{
             list-style:none;
             width: 100%;
         }
          #slide_toogle ul{
                  margin-bottom: 0.5rem!important;
                   width: 100%;
          }
        .category_layout ul li{list-style:none;display: inline-block;}
    </style>
    
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <img src="../shop/banner_shop4.gif"  usemap="#Map2" class="img-fluid">
                </div>
            </div>
        </div>
        
        
         <div class="row" style="min-height:50px;">
             <div class="col-lg-12  col-sm-12">
                 
                
             
             <div class="category_layout">
             
             <div class="row" >
                <div class="col-lg-8 col-sm-8 col-8">
                    <ul style="margin-bottom:0px!important">
                        
                        
                        
                        <li><p style="margin-bottom:0px!important;"><strong><a class="btn btn-info btn-sm" style="text-decoration:none;color:#fff" href="shop.php">inicio</a></strong></p>
</li>
                    </ul>
                    
                    

                </div>
                <div class="col-lg-4 col-sm-4 col-4" style="text-align:end;">
                    
                    
                                
                                <a style="cursor:pointer;font-size:20px;color:#0d6efd;font-weight:bold;" class="slide_down_tag">
                    
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    


                </a>
                
                <a style="cursor:pointer;font-size:20px;color:red;font-weight:bold;display:none;" class="slide_up_tag" >
                    
                   
                    <i class="fa fa-times" aria-hidden="true"></i>


                </a>
                                </div>
                    
                    
                
                
                </div>
             
             
             
              <div class="row" id="slide_toogle" style="display:none;margin-top:10px">
                  
                  
                  
                  
                
                
                
                
                  
                 
                 <div class="col-lg-12 col-sm-12 col-12" style="margin-bottom:10px">
                         <form name="form1" method="post"  action="shop_productos.php" style="padding-left: 2rem;">
                   <label class="search_field"> 
                        <input name="criterio" style="border:1px solid #0d6efd;" type="text" id="textfield" class="form-control"    maxlength="20">
                    </label>
                    <input type="submit" name="Submit2" value="buscar"  class="btn btn-primary"> 
                </form>
                    </div>
             <?php
                    while ($categoria = mysqli_fetch_array($categorias)) {
                ?>
                 <div class="col-6 col-lg-4 col-sm-6">
                     
                     <?php
                      $count = 0;
                    //if ($_SESSION['pcategoria'] == "SI" && $categoria['cod'] == $_SESSION['cat_padre_activa']) {
                  $subcategorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod_padre=" . $categoria['cod'] . " AND activa='S'");
                  while ($subcategoria = mysqli_fetch_array($subcategorias)) {
                      
                      $count =  count($subcategoria);
                ?>
                
                <?php 
                  }
                    //}
                ?>
                     
                     <ul>
                         <li>
                             
                             <a style="text-decoration:none;color:#666666!important;cursor:pointer;" <?php if($count ==0 ){ ?> href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>" <?php }else{ ?> onclick="parent('<?php echo $categoria['cod']; ?>')"<?php } ?>>
                                 <?php echo $categoria['nombre']; ?>
                                  <?php if($count !=0 ){ ?>
                                 <svg xmlns="http://www.w3.org/2000/svg" style="float: right;" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg>
<?php } ?>
                                 <ul <?php if($count !=0 ){ ?> style="padding:0px;" <?php } ?>>
                                     <?php
                    //if ($_SESSION['pcategoria'] == "SI" && $categoria['cod'] == $_SESSION['cat_padre_activa']) {
                  $subcategorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod_padre=" . $categoria['cod'] . " AND activa='S'");
                  while ($subcategoria = mysqli_fetch_array($subcategorias)) {
                ?>
                                     
                                     
                                    <li class="cat_child_<?php echo $categoria['cod']; ?>" style="display:none;background: #F3F3F8;padding:10px;">
                                        <a style="text-decoration:none;color:#666666!important;" href="shop_productos.php?cod_cat=<?php echo $subcategoria['cod']; ?>">
                                            <?php
                                                echo $subcategoria['nombre'];
                                            ?>
                                            
                                            </a>
                                    </li>
                                    
                                    <?php 
                                    }
                    //}
                                    ?>
                                 </ul>
                             
                             
                             </a>
                         </li>
                     </ul>
                     
                     
                
                    
                    
                    
               
                
                    </div>
                <?php
                
          }
          mysqli_data_seek($categorias, 0);
          ?>
          
          
         
             </div>
             </div>
         </div>
         
         
        
         
         
         
         <div class="col-lg-12" style="padding-left: 54px!important;padding-bottom:10px!important;">
                             <strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop.php">inicio 
                      </a></font></strong>
                      
                      <?php 
                    
                    
                    if(isset($_GET['cod_cat'])){
                        
                        $cod = $_GET['cod_cat'];
                    
                    
                    $cate_t=mysqli_query($mysqli,"SELECT * FROM categorias WHERE cod='$cod'");
                    $cat_title = mysqli_fetch_array($cate_t);
                    
                    $c_p = $cat_title['cod_padre'];
                    
                    if($c_p !=0){
                    
                    $cate_m=mysqli_query($mysqli,"SELECT * FROM categorias WHERE cod='$c_p'");
                    
                    //echo "SELECT * FROM categorias WHERE cod='$c_p'";
                    
                    $cat_mtitle = mysqli_fetch_array($cate_m);
                    $p_cat = $cat_mtitle['nombre'];
                        
                    }else{
                        $p_cat = '';
                    }
                    
                ?>
                      
                      
                       <?php if($p_cat !=''){ ?>
              <strong><font color="#0000CC" size="3"> 
                <a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $cat_mtitle['cod']; ?>"> - <?php echo $p_cat;?></a></font></strong>
                
                <?php } ?>
                
               <strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $cat_title['cod']; ?>"> 
              - <?php echo $cat_title['nombre'];?></a></font></strong>
              
               <?php }else if(isset($_POST['criterio'])){ ?>
               <strong><font color="#490360" size="3"> 
                <a style="text-decoration:none;color:#490360!important;" href="#"> - Search - <?php echo $_POST['criterio'];?></a></font></strong>
               <?php } ?>
                 </div>
                 
                 
                 
        
          <div class="col-lg-12">
              
              <?php	
	$cantidad=mysqli_num_rows($categorias);
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
		$productos=mysqli_query($mysqli,$_SESSION['consulta_guardada']);
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
			$productos=mysqli_query($mysqli,"SELECT productos.cod as cod, foto, costo, margen, productos.nombre as nombre, cod_cat FROM productos,categorias WHERE foto IS NOT NULL AND foto<>'' AND cod_cat=categorias.cod ORDER BY clicks DESC LIMIT 20");
			
			
			
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
					$categorias_seleccionadas=mysqli_query($mysqli,"SELECT * FROM categorias WHERE cod='$cod'");
					$categoria_seleccionada=mysqli_fetch_array($categorias_seleccionadas);
					if($categoria_seleccionada['cod_padre']==0)
					{
						$productos=mysqli_query($mysqli,"SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod')) LIMIT 60");
						$_SESSION['consulta_guardada']="SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod')) LIMIT 60";
					}
					else
					{
						$productos=mysqli_query($mysqli,"SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod'))");
						$_SESSION['consulta_guardada']="SELECT * FROM productos WHERE foto<>'' AND (cod_cat='$cod' OR cod_cat IN(SELECT cod FROM categorias WHERE cod_padre='$cod'))";
					}
				}
				else
				{
					$_SESSION['nro_pagina']=1;
					//Busqueda por marca
					$_SESSION['pcategoria']="NO";
					$cod_marca=$_GET['marca'];
					$productos=mysqli_query($mysqli,"SELECT productos.cod as cod, cod_cat, foto FROM productos, categorias WHERE categorias.cod=cod_cat AND id_marca='$cod_marca' AND activa='S' AND (foto IS NOT NULL AND foto<>'')");
					
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
					$productos=mysqli_query($mysqli,"SELECT productos.cod as cod, categorias.cod as cod_cat, foto FROM productos, categorias, marcas WHERE (foto IS NOT NULL AND foto<>'') AND (activa='S' AND productos.id_marca=marcas.id_marca AND productos.cod_cat=categorias.cod) AND (".$condiciones.")");				
					$_SESSION['consulta_guardada']="SELECT productos.cod as cod, categorias.cod as cod_cat, foto FROM productos, categorias, marcas WHERE (foto IS NOT NULL AND foto<>'') AND (activa='S' AND productos.id_marca=marcas.id_marca AND productos.cod_cat=categorias.cod) AND (".$condiciones.")";
				}	
				else
				{	
					header("Location:shop.php");
				}
			}
		}
}
	$cantidad_productos=mysqli_num_rows($productos);		
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
		mysqli_data_seek($productos,(($_SESSION['nro_pagina']*6)-6));	
		//mysql_data_seek($productos,5);	
	}		
?>      
              <?php
	if($cantidad_productos>0)
	{
?> 
           <div class="row">
               <?php 
                    for($mostrados=0;$mostrados<3;$mostrados++){
                        if($producto=mysqli_fetch_array($productos)){
               ?>
               
               
               <div class="col-lg-4 col-12 col-sm-6">
                    <div  class="p_list box_layout">
                    <a href="shop_detalle.php?cod=<?php echo $producto['cod'];?>&cod_cat=<?php echo $producto['cod_cat'];?>">
                      <img  style="padding:10px;text-align:center;margin: 0 auto;display: block;" border="0" src="<?php echo $producto['foto'];?>" />
                    </a>
                    </div>
                </div>
               
               <?php 
                        }
               } ?>
               
               <?php
	
		while($producto=mysqli_fetch_array($productos) and $mostrados<6)
		{
			$mostrados++;			
		?>
               <div class="col-lg-4 col-12 col-sm-6">
                    <div  class="p_list box_layout">
                    <a href="shop_detalle.php?cod=<?php echo $producto['cod'];?>&cod_cat=<?php echo $producto['cod_cat'];?>">
                      <img  style="padding:10px;text-align:center;margin: 0 auto;display: block;" border="0" src="<?php echo $producto['foto'];?>" />
                    </a>
                    </div>
                </div>
               <?php 
		}
               ?>
               
                <div class="col-lg-12 col-12 col-sm-12" style="text-align:center;margin-top:20px;margin-bottom:20px;">
               <?php
	for($h=1;$h<=$cantidad_paginas;$h++)
	{
	    
	    if(isset($_GET['pag'])){
	        $pag_id = $_GET['pag'];
	    }else{
	        $pag_id = '';
	        
	        
	        
	    }
	    
	    if($h ==  $pag_id){
	        $style='text-decoration:none;background: green;
    color: #fff;
    padding: 5px;
    margin: 5px;';
	    }else{
	        $style='text-decoration:none;background: #0d6efd;
    color: #fff;
    padding: 5px;
    margin: 5px;width:25px;';
	    }
	    
	    if(isset($_GET['pag'])){
	        
	    }else{
	        if($h == 1){
	            $style='text-decoration:none;background: green;
    color: #fff;
    padding: 5px;
    margin: 5px;width:25px;';
	        }
	    }
	    
	    
		if($h<>$cantidad_paginas)
		{
			echo "<a style= '$style' href=shop_productos.php?cod_cat=".$_SESSION['cod']."&pag=".$h.">".$h."</a>";
		}
		else
		{
			echo "<a style='$style' href=shop_productos.php?cod_cat=".$_SESSION['cod']."&pag=".$h.">".$h."</a>";
		}
	}
?>
                </div>
              </div>
          
           <?php
	}
	
	else
	{
?>        
          
          <img src="archivos_recibidos/no_disponible.jpg" width="190" height="190">    
<?php
	}
?>  
              
              
        </div>
         
         
        </div>
        
        
        <div class="row">
            <div class="col-lg-12">
                <div  style="background:url('../shop/fondopie2.png');text-align:center;">
                <strong style="font-size: 12px;">
                GRAVITAL BOARD HOUSE &copy; | Rafael Nu&nacute;ez 3491 | Cerro de las Rosas | Cordoba | Argentina<br>
                0351-5988630 | gravital@boardhouse.com.ar
              </strong>
              </div>
            </div>
        </div>
        
    </div>
    
    
    
    



<script>
$(document).ready(function(){
  $(".slide_down_tag").click(function(){
    $("#slide_toogle").slideDown("slow");
    $(".slide_down_tag").hide();
    $(".slide_up_tag").show();
  });
  
  $(".slide_up_tag").click(function(){
    $("#slide_toogle").slideUp("slow");
    $(".slide_up_tag").hide();
    $(".slide_down_tag").show();
  });
});


function parent(id){
   
      $(".cat_child_"+id).slideToggle();

}
</script>
</body>
<!-- InstanceEnd --></html>
