
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
        
        .box_layout_form{
             box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);

    margin-bottom: 15px;
     border-radius: 7px;
     padding:10px;
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
        
        
         <div class="row" style="min-height: 50px;">
             
             
             <div class="col-lg-12  col-sm-12">
                 
                
             
             <div class="category_layout">
             
             <div class="row" >
                <div class="col-lg-8 col-sm-8 col-8">
                    <ul>
                        <li><h4>Productos</h4></li>
                        <li><p style="margin-bottom:0px!important;padding-left: 20px;"><strong><a class="btn btn-info btn-sm" style="text-decoration:none;color:#fff" href="shop.php">inicio</a></strong></p>
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
             
             
             
             <div class="row" id="slide_toogle" style="display:none;">
                 
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
             
             
             
             
             
             
             
             
         
          <div class="col-lg-12">
              
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
            
            <div class="row">
                 <div class="col-lg-12">
                     <strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop.php">inicio 
              </a></font></strong><strong><font size="4" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop_productos.php?cod_cat=<?php echo $cod_cat;?>&v=1"> 
              <?php echo "-"." ".$categoria_activa['nombre'];?></a></font></strong><strong><font color="#0000CC" size="5"> 
              <?php echo " "."-"." ".$producto['nombre'];?></font></strong>
                 </div>
                 
                 <div class="col-lg-6" >
                     
                     
                     <div  class="p_list box_layout-">
            
              <img  style="padding:10px;text-align:center;margin: 0 auto;display: block;" border="0" src="<?php echo $producto['foto'];?>" />
            
            </div>
                     
                 </div>
                 <div class="col-lg-6" >
                     <p style="width:100%"><strong><font color="#006600">Producto:</font></strong> 
                        <?php echo $producto['nombre'];?></p>
                        <p style="width:100%"><strong><font color="#006600">Marca:</font></strong> 
                        <?php echo $producto['marca'];?> </p>
                        <p style="width:100%"><strong><font color="#006600">Descripcion:</font></strong> 
             <?php echo $producto['descripcion'];?> </p>
             <p style="width:100%"><strong><font color="#006600">Precio:</font></strong> 
              <?php echo round($producto['costo']*$categoria_activa['margen']);?> </p>
             <p style="width:100%"> <a href="shop_productos.php?marca=<?php echo $producto['id_marca'];?>"><img src="<?php echo $producto['logo'];?>" alt="" border="0" /></a></p>
                 </div>
                 
                 <div class="col-lg-12" >
                     <div class="box_layout_form-">
                     <p style="width:100%;margin-bottom:0px!important;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">stock:<?php echo ($producto['stock']);?> 
                </font></p>
                
                <form name="form2" id="form2" method="post" action="procesa_consulta.php?cod=<?php echo $producto['cod'];?>">
                  <p> 
                  <label for="consulta">consulta:</label>
                    <textarea name="consulta" class="form-control" rows="2" id="consulta" style="border:1px solid #0d6efd!important;"></textarea>
                    </p>
                  <p> 
                  <label for="mail">mail:</label>
                    <input name="mail" class="form-control" type="text" id="mail" style="border:1px solid #0d6efd!important;margin-bottom: 5px;">
                     
                    <input type="submit" name="Submit" class="btn btn-primary" value="Enviar" />
                  </p>
                </form>
                </div>
                    </div>
                 
            </div>
              
              
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

















