<?php
require('header.php');
$message = "";
$error = "";

if($_GET['city']) {
    
    $urlcontent = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=353f0d96eed8ff6ed62b5372aac28fe5");
    
    $weather = json_decode($urlcontent, true);
   // print_r($weather);
    if($weather['cod'] == 200){
    $message = "<div class='alert alert-success' role='alert'>The 
   weather in ".$_GET['city']." is currently '".$weather['weather'][0]['description']."'; 
</div>";
    
    $temp = intval($weather['main']['temp'] - 273);
     $message = "<div class='alert alert-success' role='alert'>The 
   Temperature is ".$temp."&deg;C and the wind speed is ".$weather['wind']['speed']."m/s 
</div>";
}else{
        $error = "<div class='alert alert-danger' role='alert'>Could not find city - try again 
</div>";
    }
}

?>  
      <main role="main" class="inner cover">
          <form method="get">
            <div class="form-group">
          <input class="form-control form-control-lg padding" name="city" type="text" placeholder="Enter City">
          <input name="submit" type="submit" class="btn btn-lg btn-success" value="Check Weather">
          <?php echo $error.$message; ?>
                </div>
      </main>
<?php
require('footer.php');
?>