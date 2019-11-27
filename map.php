<!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>I-ItemRecovery|Item Recovery made Easy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <style>
          .mycard {
              width: 60vw; /*optional*/
              height: 60vh;
              margin: 20vh auto;
          }
          .mybtn{
              border-radius: 20px;
              background: #48B983;
          }
          .customInput{
              border-radius: 20px;
          }
          #map{
              height: 100%;
          }
          html,body{
              height: 100%;
              margin: 0;
              padding: 0;
          }


      </style>
      </head>
<body class="container" id="map">

</div>
<script>
    var map;
    function initMap() {
        var sydney={lat:-34.397,lng:150.644}
        map=new google.maps.Map(document.getElementById("map"),{center:sydney,zoom:8});
        var marker=new google.maps.Marker({position:sydney,map:map})
        
    }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXtypPKWXXdxj8hO5sBk1mGZghHINDYTY&callback=initMap" async defer></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>