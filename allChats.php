
<head>
<title>cnelle</title>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<nav class="top-relative">
<a href="allChats.php" class="chats-heading">All Chats</a>
</nav>
<body class="allChats-body">    
<div class="chats-design-container">
<div class="chats-design">
<?php
    if(!empty($_SESSION['username'])){
    $sql = "SELECT t2.OwnerImage,t2.company, t1.SendBy, t1.Reciever, t1.Date FROM customersellermessages as t1, owners as t2 WHERE ((t1.SendBy = '{$_SESSION['username']}') and (t1.Reciever = t2.company)) GROUP BY t2.company ORDER BY t1.Date DESC";
    $result = $con->query($sql);
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()){
                $sql_date = mysqli_query($con,"SELECT * FROM customersellermessages WHERE ((SendBy = '{$_SESSION['username']}') and (Reciever = '{$row['Reciever']}')) ORDER BY Date DESC");      
                $row_date= mysqli_fetch_array($sql_date);
                $imgURL = 'storeprofile/'.$row["OwnerImage"];
                $company = $row['Reciever'];
                $date = $row_date['Date'];?>
                    <button onclick='displayMessagesSellerIframe("<?php echo $company;?>")' class='chats-container'>
                    <img src='<?php echo $imgURL;?>' class='chats-profile-image'>
                            <strong class='chats-sender'><?php echo $company;?></strong><div class="chat-date-design"><?php echo $date; ?></div>
                    </button>
            <?php }
    }else {   echo "<div class='no-messages'>No chats</div>";  }
       }else if(!empty($_SESSION['company'])){
        $sql = "SELECT t2.CustomerImage,t2.username, t1.SendBy, t1.Reciever,t1.Date, t1.idMsg FROM customersellermessages as t1, customers as t2  WHERE ((t1.Reciever='{$_SESSION['company']}') and (t2.username = t1.SendBy)) GROUP BY t2.username ORDER BY t1.Date DESC";
        $result = $con->query($sql);
              if ($result->num_rows > 0) {     
                while($row = $result->fetch_assoc()) {
                    $sql_date = mysqli_query($con,"SELECT * FROM customersellermessages WHERE ((Reciever = '{$_SESSION['company']}') and (SendBy = '{$row['SendBy']}')) ORDER BY Date DESC");      
                    $row_date= mysqli_fetch_array($sql_date);
                    $date = $row_date['Date'];
                    $imgURL = 'customerprofile/'.$row["CustomerImage"];   
                    $username = $row['SendBy'];?>
                        <button  onclick='displayMessagesBuyerIframe("<?php echo $username;?>")' class='chats-container'>
                        <img src='<?php echo $imgURL;?>' class='chats-profile-image'>
                                <strong class='chats-sender'><?php echo $username;?></strong><div class="chat-date-design"><?php echo $date; ?></div>
                        </button>
                <?php } 
                 }else{
                    echo "<div class='no-messages'>No chats</div>";
                      }  
                }?>    
        </div>
        <script>
            let company = "";
            function displayMessagesSellerIframe(company){
                        document.getElementById("iframeDisplayMessages").innerHTML = "<iframe src=\"update_notification_status.php?company="+company+"\"></iframe>";
                    } 
            let username = "";
            function displayMessagesBuyerIframe(username){
                        document.getElementById("iframeDisplayMessages").innerHTML = "<iframe src=\"update_notification_status.php?username="+username+"\"></iframe>";
            }
                            
        </script>  
        <div class="message-iframe-placeholder"><div id="iframeDisplayMessages" class="messages-iframe"></div></div>
    </div>
</body>