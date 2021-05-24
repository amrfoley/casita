<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>
    <style>
        .container {padding: 20px 40px;}
        .text-primary {color: blue;}
        .text-danger {color: red;}
        .text-info {color: green;}
    </style>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
    <!-- <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' /> -->
  </head>
  <body>
    <div class="container">
        @forelse($feeds as $rate => $msgs)
            <h2 class="text-{{ $rate == 'Neutral'? 'primary' : ($rate == 'Negative' ? 'danger' : 'info') }}">
                {{$rate}}
            </h2>
            <ul>
                @foreach($msgs as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        @empty
            <p>No DATA!</p>
        @endforelse
        <div id='map' style='width: 100%; height: 100vh;'></div>
    </div>
    <script>
        // mapboxgl.accessToken = '{{ $key }}';
        // var map = new mapboxgl.Map({
        //     container: 'map',
        //     style: 'mapbox://styles/mapbox/streets-v11'
        // });
    </script>
  </body>
</html>