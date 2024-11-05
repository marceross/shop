<?php
session_start();
$_SESSION['pcategoria'] = "NO";

include("conex.php"); // Ensure that $mysqli is defined here

// Query to fetch active parent categories
$categorias = mysqli_query($mysqli, "SELECT * FROM categorias WHERE activa='S' AND cod_padre=0");

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
}
?>

<!DOCTYPE html>
<html>
<head>
<title>GRAVITAL BOARD HOUSE</title>
  
  
  <link rel="icon" href="fav.gif" type="image/gif" >


<meta charset="utf-8">
<meta name="description" content="GRAVITAL BOARD HOUSE">
<meta name="keywords" content="GRAVITAL BOARD HOUSE">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet">
 <script src="css/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="css/jquery.min.js"></script>
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
            <div class="col-lg-12 ">
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
            </div>
            
            
            <div class="col-lg-12" style="padding-left: 45px!important;padding-bottom:8px!important;">
                             <strong><font size="3" face="Arial, Helvetica, sans-serif"><a style="text-decoration:none" href="shop.php">inicio 
                      </a></font></strong>
                 </div>
            
           
            <div class="col-lg-12 col-sm-12">
                
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
                
                
                <div class="row">
                    
                    
                    <?php
        for ($j = 1; $j <= 3; $j++) {
            mysqli_data_seek($categorias, $numeros[$j]);
            $categoria = mysqli_fetch_array($categorias);
        ?>
         <div class="col-lg-4 col-12 col-sm-6">
            <div  class="p_list box_layout">
            <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
              <img  style="padding:10px;text-align:center;margin: 0 auto;display: block;" border="0" src="<?php echo $categoria['foto_generica']; ?>" />
            </a>
            </div>
            
          </div>
        <?php
        }
        ?>
                    
                    
                    
                   <?php
        for ($j = 4; $j <= 6; $j++) {
            mysqli_data_seek($categorias, $numeros[$j]);
            $categoria = mysqli_fetch_array($categorias);
        ?>
           <div class="col-lg-4 col-12 col-sm-6">
                <div  class="p_list box_layout">
            <a href="shop_productos.php?cod_cat=<?php echo $categoria['cod']; ?>">
              <img  style="padding:10px;text-align:center;margin: 0 auto;display: block;" border="0" src="<?php echo $categoria['foto_generica']; ?>" />
            </a>
            </div>
          </div>
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
</html>
