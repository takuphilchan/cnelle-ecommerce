
<?php 
session_start();
error_reporting(0);
if(!isset($_SESSION['loggedin']) && ($_SESSION['username']=='Administrator')){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<head>
<title>cnelle</title>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/> 
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<style>
iframe{
    height: 100%;
    width: 100%;
    border: none;
}
</style>
<script>
    function displayStoreMangementIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"storeManagement.php\"></iframe>";

    }
    function displayCustomerManangementIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"customerManagement.php\"></iframe>";

    }
    function displayCustomerHelpIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"admin.php\"></iframe>";

    }
    function displayTagsIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"productTags.php\"></iframe>";

    }
    function displayStoreHelpIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"adminStoreHelp.php\"></iframe>";

    }
    function displayCustomerOrdersIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"ordersAdmin.php\"></iframe>";

    }
    function displayCustomerReviewsIframe() {
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"reviewAdmin.php\"></iframe>";

    }
    
    function displayAdvertsIframe(){
        document.getElementById("iframeDisplay").innerHTML = "<iframe src=\"productAdvert.php\"></iframe>";

    }
</script>
<body>
  
<div class="management-top">
<h1 class="management-heading">Cnelle Management</h1>
<div style="text-align: center;">
<a  class="options-admin"  onclick="displayCustomerManangementIframe()">Customer Management</a>
<a class="options-admin"   onclick="displayStoreMangementIframe()">Store Management</a>
<a class="options-admin"   onclick="displayCustomerHelpIframe()">Customer Help</a>
<a class="options-admin"   onclick="displayStoreHelpIframe()">Store Help</a>
<a class="options-admin"   onclick="displayCustomerOrdersIframe()">Customer Orders</a>
<a  class="options-admin"  onclick="displayCustomerReviewsIframe()">Customer feedback</a>
<a  class="options-admin"  onclick="displayAdvertsIframe()">Adverts</a>
<a  class="options-admin"  onclick="displayTagsIframe()">Tags</a>
</div>
</div>
<div id="iframeDisplay"></div>
</body>
<?php }else{
   header("Location:index.php");  
} ?>