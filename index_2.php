<?php
	header("Content-type: text/html; charset= \"utf-8\"");
	$el_tiempo = "";
	$error = "";
	$ciudad = str_replace('  ',' ',$_GET['ciudad']);
	$file = "https://www.weather-forecast.com/locations/".$ciudad."/forecasts/latest";
	$file_headers = @get_headers($file);
	if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
      	$error = "No he encontrado esa ciudad. Prueba a escribirla en inglés.";
    }else{
      	$paginaRobada = file_get_contents($file);
        $trozo = explode('</span></p></td><td colspan="9"><span class="b-forecast__table-description-title"><h2>', $paginaRobada);
      	if(sizeof($trozo)>1) {
        	$parte = explode('</span></p></td></tr><tr class="b-forecast__table-days js-forecast-header js-daynames">',$trozo[1]);
          	if(sizeof($parte)>0)
              $el_tiempo = $parte[0];
            else
              $error = "No he encontrado esa ciudad. Prueba a escribirla en inglés.";
        }else
        	$error = "No he encontrado esa ciudad. Prueba a escribirla en inglés.";
    }
	
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
            width: 460px;
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
            margin: 20px 0;
        }
    </style>
  </head>
  <body>
    <div class="container">
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
    <div class="container" id="el_tiempo">
        <?php
            if($el_tiempo){
                echo '<div class="alert alert-light" role="alert">'.$el_tiempo.'</div>';
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