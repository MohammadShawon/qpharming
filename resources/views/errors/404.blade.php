<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>404 Error</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="{{ asset('errors/css/style.css') }}">

  
</head>

<body>

  <div class="wrapper">
   <h1 class="oops">Oops!</h1>
   <p class="info">We couldn't find the page you were looking for.</p>
   <br />
   
   <img style="max-width: 20%;" src="{{ asset('errors/img/qiBoeyLgT.gif') }}" alt="Kitty" />

</div>
 <a href="{{ url('/') }}" class="button"><i class="fa fa-angle-left"></i>Go Home</a>
  
  

</body>

</html>
