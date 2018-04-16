<?php
	header("Content-type: text/html; charset= \"utf-8\"");
	$el_tiempo = "";
	$error = "";
	if (array_key_exists('ciudad',$_GET)){
    	$urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['ciudad'])."&APPID=cacc4f33605d6f09bd2a625099a31e65&lang=es&units=metric");
      	$array = json_decode($urlContents, true);
      	//print_r($array);
      	$estado = $array['weather'][0]['description'];
        $temperatura = intval($array['main']['temp']);
      	$tempMin = intval($array['main']['temp_min']);
      	$tempMax = intval($array['main']['temp_max']);
      	$el_tiempo = "El tiempo ahora en ".$_GET['ciudad']." presenta<br> <strong>".$estado."</strong><br>";
      	$el_tiempo .= "con una temperatura de <strong>".$temperatura." º C</strong><br>";
      	$el_tiempo .= "oscilando entre los ".$tempMin."º y los ".$tempMax."º a lo largo del día.";
      	if(urlencode($_GET['ciudad']) == ""){$el_tiempo = "Intenta escribir algo, igual hasta consigues adivinar una ciudad y todo.";}
    }
	
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>¿Qué tiempo hace?</title>
    <style>
        html{
            background: url(nubes.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body{
      	    background: none;
          }
        .container{
            text-align: center;
            margin-top: 3em;
        }
        #tarjeta{
            background-color:black;
            color:white;
            text-decoration:none;
            padding:4px 6px;
            font-size:12px;
            font-weight:bold;
            line-height:1.2;
            display:inline-block;
            border-radius:3px;
        }
        input{
            margin: 1em 0;
        }
    </style>
  </head>
  <body>
    <div class="container col-sm-9">
        <h1>¿Qué tiempo hace?</h1>
        <form>
          <div class="form-group">
            <label for="ciudad">Busca una ciudad:</label>
            <input type="text" class="form-control" id="ciudad" aria-describedby="emailHelp" name="ciudad" placeholder="Londres, Tokyo, Bogotá...">
            <small id="emailHelp" class="form-text text-muted">Puede ser una ciudad fea, si quieres.</small>
          </div>
          <button type="submit" class="btn btn-primary">A ver...</button>
        </form>
    </div>
    <div class="container col-sm-9" id="el_tiempo">
        <?php
            if($el_tiempo){
                echo '<div class="alert alert-info" role="alert">'.$el_tiempo.'</div>';
            }else if($error != ""){
            	echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
            }
        ?>
    </div>
    <div class="container">
        <a id="tarjeta" style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px;" href="https://unsplash.com/@frostroomhead?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Rodion Kutsaev"><span style="display:inline-block;padding:2px 3px;"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white;" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px;">Rodion Kutsaev</span></a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>