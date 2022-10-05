
<!DOCTYPE html> 
<html>
<head>
<title>cnelle</title>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpg" type="image/x-icon" />
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<script src="javascript/authoptions-toggle.js?version=1.0" ></script>
<script src="javascript/scroll-back-top.js?version=1.0" ></script>
<script src="javascript/notify.js?version=1.0"></script>
<script src="javascript/onclick-iframes.js?version=1.0"></script>
<script src="javascript/image-slider.js?version=1.0"></script>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
</head>
<body class="main">
<!--TOP NAVIGATION DIV-->
<div class="enclose">
<!--NOTIFICATION ANG MESSAGES BUYER-->
<?php  
error_reporting(0);
session_start();
include ('connect.php');
if(!empty($_SESSION["username"])){ ?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
          <div class="notification-dropdown">
          <div  class="notifybtn"><i  class="fa fa-bell"></i></div>
          <span class="notify"></span>
          </div>
          <div id="notification" class="dropdownNotification"></div>
          <div class="dropdown">
          <div class="dropbtn"><i class="fa fa-envelope"></i></div>
          <span class="badge badge-danger"></span>
          </div>
          <div id="myDropdown" class="dropdown-content"></div>
</div>
<!--NOTIFICATION ANG MESSAGES SELLER-->
<?php }else if(!empty($_SESSION["company"])){ ?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
          <div class="notification-dropdown">
          <div  class="notifybtn"><i  class="fa fa-bell"></i></div>
          <span class="notify"></span>
          </div>
          <div id="notification" class="dropdownNotification"></div>
          <div class="dropdown">
          <div  class="dropbtn"><i class="fa fa-envelope"></i></div>
          <span class="badge badge-danger"></span>
          </div>
          <div id="myDropdown" class="dropdown-content"></div>
</div>
<?php }else{?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
<a onclick="displayLoginNotifyIframe()" id="iframe-login-notify"><div  class="notifybtn"><i  class="fa fa-bell"></i></div></a>
<a onclick="displayLoginMessageIframe()" id="iframe-login-message"><div class="dropbtn"><i class="fa fa-envelope"></i></div></a>
</div>
<?php }?>
<!--NAVIGATION OPTIONS AFTER LOGGED IN ALL -->
<div class="enclose-inner-container">
<div>
<?php if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){  ?>    
      <div class="top-dropper-container-all"> 
        <a id="topdropper2" class="top-dropper-main-options"><i class="fa fa-bars"></i></a>   
        <nav class="authoptions">
        <div class="authoptions-and-grey-area-container">    
                        <div class="authoptions-inner-container"> 
                        <a class="authoptions-remover">×</a>
                        <?php
                        if(isset($_SESSION['username'])){
                        $customer_sql = "SELECT * FROM customers WHERE username='{$_SESSION['username']}'";
                        $customer_result = mysqli_query($con, $customer_sql); 
                        if($customer_result==true){
                            while($row = $customer_result->fetch_assoc()){
                              $my_profile = 'customerprofile/'.$row["CustomerImage"];?>
                              <div class="main-options">
                                <div class="profile-image-sidebar">
                                <?php echo '<img src="'.$my_profile.'" class="profile-picture" alt="">'; ?>
                                <h2 class="username-sidebar"><?php echo substr($_SESSION['username'], 0 , 18);?></h2>
                               </div>
                              </div>
                            <?php } 
                              } ?>
                            <div class="main-option-container">
                                  <a onclick="displayAccountIframe()" id="iframe-account" class="main-options">Account</a>
                              </div>
                              <div class="main-option-container">
                                  <a onclick="displayOrdersIframe()" id="iframe-all-orders"  class="main-options">My Orders</a>
                              </div>
                              <div class="main-option-container">
                                  <a onclick="displayAllChatsIframe()" id="iframe-all-chats"  class="main-options">Chats</a>
                              </div>
                              <div class="main-option-container">
                                  <a onclick="displayWishlistIframe()" id="iframe-wishlist"  class="main-options">My wishlist</a>
                              </div>  
                            <?php }else if(isset($_SESSION['company'])){
                              $company_sql = "SELECT * FROM owners WHERE company='{$_SESSION['company']}'";
                              $company_result = mysqli_query($con, $company_sql); 
                              if($company_result==true){
                                while($rows = $company_result->fetch_assoc()){
                                  $company_profile = 'storeprofile/'.$rows["OwnerImage"];?>
                               <div class="profile-image-sidebar">
                                <?php echo '<img src="'.$company_profile.'" class="profile-picture" alt="">'; ?>
                                <h2 class="username-sidebar"><?php echo substr($_SESSION['company'], 0 , 18);?></h2>
                               </div>
                                <?php }
                                } ?> 
                            <div class="main-option-container">
                                  <a onclick="displayAccountIframe()" id="iframe-account"  class="main-options">Account</a>
                              </div>
                              <div class="main-option-container">
                                  <a onclick="displayStoreOrdersIframe()" id="iframe-store-orders"  class="main-options">Orders</a>
                              </div>
                              <div class="main-option-container">
                                  <a onclick="displayAllChatsIframe()" id="iframe-all-chats"  class="main-options">Chats</a>
                              </div>
                            <?php 
                                }?>
                          <div class="main-option-container">
                            <a id="dropper-three-mobile"  class="main-options">Region</a> 
                            <div id="dropdownRegion-content-mobile" class="all-dropdown">
                                                    <a href="index.php?r=Zimbabwe">Zimbabwe</a>
                                                    <a href="index.php?r=China">China</a>
                                                    <a href="index.php?r=South Africa">South Africa</a>
                                                    <a href="index.php?r=Rwanda">Rwanda</a>
                                                    <a href="index.php?r=Ethiopia">Ethiopia</a>
                                                    <a href="index.php?r=Tanzania">Tanzania</a>
                            </div>
                            </div>
                           <div class="main-option-container" >
                            <a id="dropper-four-mobile" class="main-options">Category</a>
                            <div id="dropdownCategory-content-mobile" class="all-dropdown">
                                                    <a href="index.php?c=Clothing">Clothing</a>
                                                    <a href="index.php?c=Women">Women</a>
                                                    <a href="index.php?c=Men">Men</a>
                                                    <a href="index.php?c=Sports">Sports</a>
                                                    <a href="index.php?c=Children">Children</a>
                                                    <a href="index.php?c=Youth">Youth</a>
                                                    <a href="index.php?c=Gaming">Gaming</a>
                                                    <a href="index.php?c=Beverages">Beverages</a>
                                                    <a href="index.php?c=Appliances">Appliances</a>
                                                    <a href="index.php?c=Gadgets">Gadgets</a>
                                                    <a href="index.php?c=Vegetables">Vegetables</a>
                                                    <a href="index.php?c=Hardware">Hardware</a>
                                                    <a href="index.php?c=Shoes">Shoes</a>
                                                    <a href="index.php?c=Grocery">Grocery</a>
                                                    <a href="index.php?c=Bags">Bags</a>
                                                    <a href="index.php?c=Books">Books</a>
                                                    <a href="index.php?c=Services">Services</a>
                                                    <a href="index.php?c=Dairy">Dairy</a>
                                                    <a href="index.php?c=Housing">Housing</a>
                                                    <a href="index.php?c=Cars">Cars</a>
                                                    <a href="index.php?c=Entertainment">Entertainment</a>
                                                    <a href="index.php?c=Other">Other</a>
                                    </div>
              </div>                        
              <div class="main-option-container">      
              <a onclick="displayPrivacyIframe()" id="iframe-privacy" class="main-options">Privacy Policy</a>
              </div>          
              <div class="main-option-container">      
              <a onclick="displayAboutUsIframe()" id="iframe-about" class="main-options">About</a>
              </div>
              <?php 
                  if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){
                    ?>
             <div class="main-option-container">      
              <a href="logout.php" class="main-options">Log Out</a>
                  <?php }?>
              </div>
              <footer class="authoptions-footer">&copy; 2021 cnelle.com <br> Designed and Developed by cnelle technology</footer>
              </div>
              <div class="authoptions-grey-area"></div> 
              </div>
            </nav>
            <a class="company" href="index.php">cnelle.com</a> 
        </div>
<!--NAVIGATION OPTIONS AFTER LOGGED IN -->
<?php }else if(empty($_SESSION["company"]) && empty($_SESSION["username"])){ ?>    
      <div class="top-dropper-container"> 
      <a id="topdropper2" class="top-dropper-main-options"><i class="fa fa-bars"></i></a>
        <nav class="authoptions">
          <div class="authoptions-and-grey-area-container">
                     <div class="authoptions-inner-container">
                       <a class="authoptions-remover">×</a>
                              <div class="main-option-container">
                              <a id="dropper1" class="main-options">Log In</a>
                                <div id="dropdownMainLogin-content" class="all-dropdown">
                                  <a onclick="displayLoginIframe()" id="iframe-login">Buyer</a>
                                  <a onclick="displayStoreLoginIframe()" id="iframe-store-login">Seller</a>
                                </div>
                              </div>
                <div class="main-option-container">      
              <a onclick="displayPrivacyIframe()" id="iframe-privacy" class="main-options">Privacy Policy</a>
              </div>       
              <div class="main-option-container">      
              <a onclick="displayAboutUsIframe()" id="iframe-about" class="main-options">About</a>
              </div>
              <footer class="authoptions-footer">&copy; 2021 cnelle.com<br> Designed and Developed by cnelle technology</footer> 
            </div>
            <div class="authoptions-grey-area"></div>
            </div>
          </nav>
            <a class="company" href="index.php">cnelle.com</a> 
        </div>
    <?php } ?>
      <div class="search-main-container">
        <?php
        $query_name_search = mysqli_query($con, "SELECT prodname FROM products ORDER BY RAND() ");
        while($name_search  = mysqli_fetch_array($query_name_search)){
                $placeholder = $name_search['prodname'];
        }
        ?>
        <!--SEARCH-->
        <form action="index.php" method="GET" >
            <div class="search-main"> 
                      <input type="text" class="searchbar" name="search" placeholder="<?php if(empty($_GET['search'])){echo $placeholder; }else{ echo $_GET['search'];}?>"/>
                      <button type="submit" class="icon"><i class="fa fa-search"></i></button>
            </div>
        </form>
      </div>
       <div class="maintop-container">
       <div class="maintop">
          <div class="main-option-container">
          <a id="dropper3" class="anchorindex"><span class="anchorindex-names">Region</span></a> 
          <div id="dropdownRegion-content" class="anchorindex-all-dropdown-outer">
                <div class="anchorindex-all-dropdown-inner">
                <div class="anchorindex-dropdown-inner-div"> 
                <a href="index.php?r=Zimbabwe">Zimbabwe</a>
                <a href="index.php?r=China">China</a>
                <a href="index.php?r=South Africa">South Africa</a>
                </div>
                <div class="anchorindex-dropdown-inner-div">
                <a href="index.php?r=Rwanda">Rwanda</a>
                <a href="index.php?r=Ethiopia">Ethiopia</a>
                <a href="index.php?r=Tanzania">Tanzania</a>
                </div>  
              </div>
          </div>
          </div>
          <div class="main-option-container">
          <a id="dropper4" class="anchorindex"><span class="anchorindex-names">Category</span></a>
          <div id="dropdownCategory-content" class="anchorindex-all-dropdown-outer">
                <div class="anchorindex-all-dropdown-inner">
                <div class="anchorindex-dropdown-inner-div">
                <a href="index.php?c=Women">Women</a>
                <a href="index.php?c=Men">Men</a>
                <a href="index.php?c=Sports">Sports</a>
                <a href="index.php?c=Kids">Kids</a>
                <a href="index.php?c=Youth">Youth</a>
                <a href="index.php?c=Clothing">Clothing</a>
                <a href="index.php?c=Gaming">Gaming</a>
                <a href="index.php?c=Beverages">Beverages</a>
                <a href="index.php?c=Appliances">Appliances</a>
                <a href="index.php?c=Gadgets">Gadgets</a>
                <a href="index.php?c=Vegetables">Vegetables</a>               
                </div>
                <div class="anchorindex-dropdown-inner-div"> 
                <a href="index.php?c=Bags">Bags</a>
                <a href="index.php?c=Books">Books</a>
                <a href="index.php?c=Services">Services</a> 
                <a href="index.php?c=Hardware">Hardware</a>  
                <a href="index.php?c=Shoes">Shoes</a>
                <a href="index.php?c=Grocery">Grocery</a>
                <a href="index.php?c=Dairy">Dairy</a>
                <a href="index.php?c=Housing">Housing</a>
                <a href="index.php?c=Cars">Cars</a>
                <a href="index.php?c=Entertainment">Entertainment</a>
                <a href="index.php?c=Other">Other</a>
                </div>
              </div>
            </div>
       </div>  
        <?php
      if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){

       if(isset($_SESSION["company"])){?> 
       <div class="anchorindex-container"><a onclick="displayStoreHelpIframe()" id="iframe-store-help" class="anchorindex"><span class="anchorindex-names">Service</span></a></div> 
       <div class="anchorindex-container"><a onclick="displaySellIframe()" id="iframe-sell"  class="anchorindex"><span class="anchorindex-names">Sell</span></a></div>
       <div class="anchorindex-container"><a onclick="displayMyStoreIframe()" id="iframe-mystore" class="anchorindex"><span class="anchorindex-names">MyStore</span></a></div>
       <div class="anchorindex-container"><a onclick="displayAccountAnchorIndexIframe()" id="iframe-account-anchorindex" class="anchorindex"><span class="anchorindex-names">Account</span></a></div>  
       
       <?php }else if(isset($_SESSION["username"])){ 
        if (($_SESSION["username"]) == 'Administrator'){ ?>   
      <div class="anchorindex-container"> <a onclick="displayManagementIframe()" id="iframe-management" class="anchorindex"><span class="anchorindex-names">ControlPanel</span></a></div>         
       <div class="anchorindex-container"><a onclick="displaySellIframe()" id="iframe-sell"  class="anchorindex"><span class="anchorindex-names">Sell</span></a></div> 
       <div class="anchorindex-container"><a onclick="displayFeedbackIframe()" id="iframe-feedback" class="anchorindex"><span class="anchorindex-names">Feedback</span></a></div>
       <div class="anchorindex-container"><a onclick="displayAccountAnchorIndexIframe()" id="iframe-account-anchorindex" class="anchorindex"><span class="anchorindex-names">Account</span></a></div>  
       
      <?php }else{ ?>
      <div class="anchorindex-container"><a onclick="displayHelpIframe()" id="iframe-help" class="anchorindex"><span class="anchorindex-names">Service</span></a></div> 
      <div class="anchorindex-container"><a href="cart.php" class="anchorindex"><span class="anchorindex-names">Cart</span></a></div> 
      <div class="anchorindex-container"><a onclick="displayFeedbackIframe()" id="iframe-feedback" class="anchorindex"><span class="anchorindex-names">Feedback</span></a></div>
      <div class="anchorindex-container"> <a onclick="displayAccountAnchorIndexIframe()" id="iframe-account-anchorindex" class="anchorindex"><span class="anchorindex-names">Account</span></a></div>
      <?php }
       }
        }else if(empty($_SESSION["company"]) && empty($_SESSION["username"])){ ?>
      <div class="anchorindex-container"><a onclick="displayHelpIframe()" id="iframe-help" class="anchorindex"><span class="anchorindex-names">Service</span></a></div> 
      <div class="anchorindex-container"><a onclick="displayCartIframe()"  id="iframe-cart" class="anchorindex"><span class="anchorindex-names">Cart</span></a></div> 
      <div class="anchorindex-container"><a onclick="displaySellIframe()" id="iframe-sell"  class="anchorindex"><span class="anchorindex-names">Sell</span></a></div>
      <div class="anchorindex-container"><a onclick="displayFeedbackIframe()" id="iframe-feedback" class="anchorindex"><span class="anchorindex-names">Feedback</span></a></div>
      <div class="anchorindex-container"> <a onclick="displayAccountAnchorIndexIframe()" id="iframe-account-anchorindex" class="anchorindex"><span class="anchorindex-names">Account</span></a></div>

        <?php }?>
      
      </div>
       <a class="note-anchorindex"><span class="anchorindex-names">Buy affordable and high quality products</span></a>
      </div>
</div>
</div>
<!--OPTIONS-->
</div>
<div id="iframeDisplay"></div>
<div class="category-top-section-container-outer">
<div class="category-top-section-container-inner">
<!--TOP CATEGORY-->
<div class="top-category-outer">
<div class="category-background">
<div class="top-container-category">
<h1 class="section-heading">Top categories</h1>
<div class="top-category">
<div class="category-container"><a href="index.php?c=Women" style="text-decoration: none; " class="main-category-names"><span>Women</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Men" style="text-decoration: none; " class="main-category-names"><span>Men</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Kids" style="text-decoration: none; " class="main-category-names"><span>Kids</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Shoes" style="text-decoration: none; " class="main-category-names"><span>Shoes</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Gadgets" style="text-decoration: none; " class="main-category-names" ><span>Gadgets</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Books" style="text-decoration: none; " class="main-category-names" ><span>Books</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Bags" style="text-decoration: none; " class="main-category-names"><span>Bags</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Other" style="text-decoration: none; " class="main-category-names"><span>Other</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Sports" style="text-decoration: none; " class="main-category-names"><span>Sports</span><span class="right-arrow">&#8250;</span></a></div>
<div class="category-container"><a href="index.php?c=Clothing" style="text-decoration: none; " class="main-category-names"><span>Clothing</span><span class="right-arrow">&#8250;</span></a></div>
</div>
</div>
</div>
</div>
<?php
if(empty($_GET['search']) && empty($_GET['l']) && empty($_GET['c']) && empty($_GET['r'])){?>
<div>
<div class="top-section-container">
<div class="top-display-container">
<div>
<h1 class="section-heading">Latest Arrivals</h1>
<?php
  $product = mysqli_query($con, "SELECT * FROM Adverts where current='active' limit 1");
     while($product_array = $product->fetch_assoc()){
      $imgURL = 'advertimages/'.$product_array["image1"];
      $imgURL2 = 'advertimages/'.$product_array["image2"];
      $imgURL3 = 'advertimages/'.$product_array["image3"];?> 
        <!--image slider start-->
      <div class="slider">
   
       <div class="slides">
        <!--radio buttons start-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <!--radio buttons end-->
        <!--slide images start-->
      
          <div class="slide first">
          <a href="index.php?l=Gadgets" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL."' draggable='false'>"?><div class="top-section-hidden-div"><h2 class="hidden-div-text">Check out the latest Gadgets</h2></div>      
           </a>
          </div>
          <div class="slide">
          <a href="index.php?l=Shoes" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL2."' draggable='false'>"?><div class="top-section-hidden-div"><h2 class="hidden-div-text">Check out the latest Shoes</h2></div>      
           </a>
          </div>
          <div class="slide">
          <a href="index.php?l=Clothing" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL3."' draggable='false'>"?><div class="top-section-hidden-div"><h2 class="hidden-div-text">Check out the latest Clothing</h2></div>      
           </a>
          </div>
        <!--automatic navigation start-->
        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>       
        <!--automatic navigation end-->
      </div>
      <!--manual navigation start-->
      <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
      </div>
      <!--manual navigation end-->
    </div>
  <?php
       }?>
</div>
</div>
</div>
</div>
</div><br>
<div class="top-mobile-category-container">
<h1 class="section-heading">Top categories</h1>
<div class="top-container-category">
<div class="top-category">
<div class="category-container"><a href="index.php?c=Women" style="text-decoration: none;" class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/women.jpeg');"></div><span>Women</span></a></div>
<div class="category-container"><a href="index.php?c=Men" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/men.jpeg');" ></div><span>Men</span></a></div>
<div class="category-container"><a href="index.php?c=Kids" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/kids.jpeg');"></div><span>Kids</span></a></div>
<div class="category-container"><a href="index.php?c=Shoes" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/Shoes.jpeg');"></div><span>Shoes</span></a></div>
<div class="category-container"><a href="index.php?c=Gadgets" style="text-decoration: none; " class="main-category-names" ><div class="main-category" style="background-image: url('categoryIcons/gadgets.png');"></div><span>Gadgets</span></a></div>
</div>
<div class="top-category">
<div class="category-container"><a href="index.php?c=Books" style="text-decoration: none; " class="main-category-names" ><div class="main-category" style="background-image: url('categoryIcons/books.jpeg');"></div><span>Books</span></a></div>
<div class="category-container"><a href="index.php?c=Bags" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/bags.jpeg');" ></div><span>Bags</span></a></div>
<div class="category-container"><a href="index.php?c=Other" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/others.jpeg');"></div><span>Other</span></a></div>
<div class="category-container"><a href="index.php?c=Sports" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/Sports.jpeg');"></div><span>Sports</span></a></div>
<div class="category-container"><a href="index.php?c=Clothing" style="text-decoration: none; " class="main-category-names"><div class="main-category" style="background-image: url('categoryIcons/clothing.jpeg');"></div><span>Clothing</span></a></div>
</div>
</div>
</div>
<?php  } ?>   

<!--ALL PRODUCTS-->
<?php
if(empty($_GET['r']) && empty($_GET['c']) && empty($_GET['search']) && empty($_GET['l'])){
  $gadgets = "Gadgets";
  $seller = "cnelle";
  $shoes = "Shoes";
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) ORDER BY RAND() ");
  $queryGadgets = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category = '$gadgets' ORDER BY RAND()");
  $querySeller = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.company = '$seller' ORDER BY RAND()"); 
  $queryShoes = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category = '$shoes' ORDER BY RAND()");
  ?>
<div class="category-section-container">
<h1 class="section-heading">Hot Gadgets</h1> 
<div class="category-section-container-outer">
  <div class="category-section-container-inner">
<?php 
while($product_array = mysqli_fetch_array($queryGadgets)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"];  
  $product = $product_array["id"]; 
  $company = $product_array["company"];
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a onclick="displayProductIframe('<?php echo $product;?>')" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
       </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
        <a class="product-company" onclick="displayClientSideStoreIframe('<?php echo $company;?>')">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a>       
       <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
      </div>
	</div>
  <?php } ?>  
</div>
</div>
</div>
<div class="category-section-container">
<h1 class="section-heading">Hot Shoes</h1>
<div class="category-section-container-outer">
  <div class="category-section-container-inner">
<?php
while($product_array = mysqli_fetch_array($queryShoes)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"]; 
  $product = $product_array["id"];
  $company = $product_array["company"];
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a onclick="displayProductIframe('<?php echo $product;?>')" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
       </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
        <a class="product-company" onclick="displayClientSideStoreIframe('<?php echo $company;?>')">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a>       
       <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
      </div>
	</div>
  <?php } ?> 
</div>
</div>
</div>
<div class="category-section-container">
<h1 class="section-heading">Hot Seller</h1>
<div class="category-section-container-outer">
  <div class="category-section-container-inner"> 
<?php
while($product_array = mysqli_fetch_array($querySeller)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"];
  $product = $product_array["id"];
  $company = $product_array["company"];
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a onclick="displayProductIframe('<?php echo $product;?>')" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
       </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
        <a class="product-company" onclick="displayClientSideStoreIframe('<?php echo $company;?>')">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a>       
       <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
      </div>
	</div>
  <?php } ?>
</div> 
</div>
</div>
<div class="products-main-page-allproducts">
<h1 class="section-heading">All products</h1>
<!--ALL SEARCH CATEGORIES-->
<?php
 }else if(!empty($_GET['r']) || !empty($_GET['c']) || !empty($_GET['l']) || !empty($_GET['search'])){
?>
<div class="products-main-page">
<?php
if(isset($_GET['c'])){
  ?>
  <!--CATEGORY SEARCH-->
<h1 class="section-heading"><?php echo $_GET['c'];?> category </h1>
<?php
  $category = $_GET['c'];
  $safe_value = stripcslashes(htmlspecialchars($category));
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_value}' ORDER BY RAND()");
  if ($query ->num_rows > 0) {  
  }else{
    echo "<div class='no-products'>No products yet in this category</div>";
  }
 }else if(!empty($_GET['search'])){
?>
<!--SEARCH-->
<h1 class="section-heading">Search results for <?php echo $_GET['search']; ?></h1>
<?php
  $search = $_GET['search'];
  $safe_search = stripcslashes(htmlspecialchars($search));
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and (t1.prodname like '%$safe_search%' or t1.company like '%$safe_search%') ORDER BY RAND()");
if ($query ->num_rows > 0){  
}else{
  echo "<div class='no-products'>No products or stores with this name</div>";
}
}else if(!empty($_GET['l'])){
  ?>
  <!--SEARCH-->
  <h1 class="section-heading">Latest <?php echo $_GET['l']; ?></h1>
  <?php
    $latest = $_GET['l'];
    $safe_latest = stripcslashes(htmlspecialchars($latest));
    $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_latest}' ORDER BY t1.Date DESC");
  if ($query ->num_rows > 0){  
  }else{
    echo "<div class='no-products'>No latest products</div>";
  }
}else if(!empty($_GET['r'])){
?>
  <!--REGION-->
<h1 class="section-heading">Results of products of suppliers in <?php echo $_GET['r']; ?></h1>
<?php
    $region = $_GET['r'];
    $safe_region = stripcslashes(htmlspecialchars($region));
    $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t2.Country,t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and (t2.Country like '%$safe_region%') ORDER BY RAND()");
  if ($query ->num_rows > 0) {  
  }else{
  echo "<div class='no-products'>No suppliers yet in this region</div>"; }
  }
} 
while($product_array = mysqli_fetch_array($query)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"]; 
  $product = $product_array["id"];
  $company = $product_array["company"];
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a onclick="displayProductIframe('<?php echo $product;?>')" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
       </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
        <a class="product-company" onclick="displayClientSideStoreIframe('<?php echo $company;?>')">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a>       
       <div class="product-price"><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></div>
      </div>
	</div>
  <?php } ?>
 </div>
</div>
</div>
</div>
<div class="main-footer">
  <div class="footer-section-container">
    <h3>ABOUT US</h3>
    <div>Cnelle ecommerce</div>
    <div onclick="displayAboutUsFooterIframe()" id="iframe-about-footer"><span>Read more</span></div>
  </div>
  <div class="footer-section-container">
  <h3>LOCATION</h3>
    <div>Harare Zimbabwe</div>
    <div>Gweru Zimbabwe</div>
    <div>Wuhan China</div>
  </div>
  <div class="footer-section-container">
  <h3>DELIVERY</h3>
    <div>We offer door to door delivery</div>
    <div>fast and reliable delivery service</div>
  </div>
  <div class="footer-section-container">
  <h3>CONTACT US</h3>
    <div>Phone  +8615871792071</div>
    <div>Email  cnelleofficial@gmail.com</div>
    <div>facebook page cnelle</div>
  </div>
  <div class="footer-section-container">
  <h3>TERMS AND CONDITIONS</h3>
    <div>To all our clients</div>
    <div onclick="displayTermsIframe()" id="iframe-terms"><span>Read terms and conditions</span> </div>
  </div>
  <div class="footer-section-container">
    <h3>PRIVACY POLICY</h3>
    <div>Data encryption</div>
    <div onclick="displayPrivacyFooterIframe()" id="iframe-privacy-footer"><span>Read more</span></div>
  </div>
</div> 
<div class="website-footer">
<h1 class="social-icons-heading">FOLLOW US ON</h1>
<ul class="social-icons">
    <li><a href="https://www.facebook.com/cnelleOfficial"><img src='images/facebook.png' class="about-icons"/></a></li>
    <li><a href="https://www.instagram.com/cnelle_"><img src='images/instagram.png' class="about-icons"/></a></li>
    <li><a href="https://wa.me/+8615871792071"><img src='images/whatsapp.jpeg' class="about-icons"/></a></li>
    <li><a href="https://twitter/phillipchananda"><img src='images/twitter.png' class="about-icons"/></a></li>
</ul> 
<p>PAYMENT METHODS</p>
<img src="images/payment-methods.png" class="payment-methods" alt="">
<p class="developer">designed and developed by cnelle technology</p>
<p class="copyright">&copy; 2021 www.cnelle.com</p>
</div>
<!--BACK TO TOP-->
<a id="back2Top" title="Back to top" href="#">&#10148;</a>
</body>
</html>
