
<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<html>
<head>
<title>cnelle</title> 
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
<script src="javascript/scroll-back-top.js" ></script>
<link href="css/main.css?version=1.0" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
</head>


<body class="main">
        <?php 
          error_reporting(0);
          include ('connect.php');
          if($_SESSION["company"]){
            $sql_cover = "SELECT * FROM owners WHERE company='{$_SESSION["company"]}'";
            $result_cover = mysqli_query($con, $sql_cover); 
            if($result_cover==true){
                while($row_cover = $result_cover->fetch_assoc()){
                  $imgURL1 = 'storeprofile/'.$row_cover["OwnerImage"];
          ?>
        <div class="top-store">
        <form action="myStore.php" method="GET">
        <div class="search-name-container">
          <div class="side-name-heading"><strong>Your store <?php echo $_SESSION['company'];?></strong></div>
          <div class="search"> 
                    <input type="text" class="searchbar" name="search" placeholder="Search..."/>
                    <button type="submit" name="submit" class="icon"><i class="fa fa-search"></i></button>
          </div>
        </div>
        </form>
        <div class="txt-heading-store" >
            <a href="myStore.php?company=<?php echo $_SESSION['company'];?>" id="companyname" ><?php
            if(!empty($_SESSION['company'])){?></a>
        </div>
    </div>
    <div class="container-all">
    <?php
        if(isset($_GET['search'])){
          ?>
          <h1 class="section-heading">Search results of <?php echo $_GET['search'];?> </h1>	
              <?php 
              $search = $_GET['search'];
              $safe_search = stripcslashes(htmlspecialchars($search));
              $search_query = mysqli_query($con, "SELECT * FROM products WHERE (company='{$_SESSION['company']}') and (prodname like '%$safe_search%') ORDER BY RAND()");
              if ($search_query ->num_rows > 0) { 
              while($product_array = $search_query->fetch_assoc()){
                $imgURL = 'productimages/'.$product_array["image"];
            ?> 
            
            <div class="productdeco">
              <div class="productImg-container"> 
                <a href="product.php?p=<?php echo $product_array["id"]; ?>" class="productImg-link">
                <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
                </a>
              </div>
              <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 12); ?></div>
              <div class="product-det">
              <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
                <div class="cart-action">
                <button class="buttonprod-mystore-update" onclick="location.href='productUpdate.php?p=<?php echo $product_array['id']; ?> && company=<?php echo $product_array['company']; ?>'" style='background-color:<?php echo $row_cover['storeColor'];?>'>Update</button>
                <button class="buttonprod-mystore-delete" onclick="location.href='deleteProduct.php?p=<?php echo $product_array['id']; ?>'">Delete</button>
                </div>
                </div>
              </div>
            <?php
            }
          }else{
            echo "<div class='no-products'>No products with this name</div>";
          }
        }else{ 
          $sql_banner = mysqli_query($con, "SELECT * FROM owners WHERE company='{$_SESSION["company"]}'"); 
          $row_banner = mysqli_fetch_array($sql_banner);
          if(!empty($row_banner['Banner'])){
            $bannerImg = 'storeprofile/'.$row_banner['Banner']; 
          }else{
            $bannerImg = 'images/top-seller.jpeg';
          }
          ?>
        <div class="ad-container-store">
          <h1 class="section-heading">Promotion Banner</h1>
          <div class="ad-store">
          <?php echo "<img src='".$bannerImg."' class='ad-container-store' alt='' draggable='false'>"?>
          </div>
        </div>
        <h1 class="section-heading">All products</h1>
        <?php
        $product = mysqli_query($con, "SELECT * FROM products where company='{$_SESSION['company']}' ORDER BY RAND()");
         if ($product ->num_rows > 0) { 
          while($product_array = $product->fetch_assoc()){
            $imgURL = 'productimages/'.$product_array["image"];
        ?>	
        <div class="productdeco">
          <div class="productImg-container"> 
            <a href="product.php?p=<?php echo $product_array["id"]; ?>" class="productImg-link">
            <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
            </a>
          </div>
          <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 12); ?></div>
          <div class="product-det">
          <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
            <div class="cart-action">
            <button class="buttonprod-mystore-update" onclick="location.href='productUpdate.php?p=<?php echo $product_array['id']; ?> && company=<?php echo $product_array['company']; ?>'" style="background-color: <?php echo $row_cover['storeColor'];?>">Update</button>
            <button class="buttonprod-mystore-delete" onclick="location.href='deleteProduct.php?p=<?php echo $product_array['id']; ?>'">Delete</button>
            </div>
            </div>
          </div>
        <?php
        }
      }else{
        echo "<div class='no-products'>No products yet</div>";
      }
        }
      }
        ?>  
    </div>
     <?php }
        }
        }?>
    </body>
</html>