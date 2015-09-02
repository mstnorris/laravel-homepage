<!DOCTYPE html>
<html>
<head>
    <title>Laravel Homepage</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            padding-top: 2em;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body>
<div id="sites" class="container">

    <form method="POST" action="{{ route('sites_path') }}">

        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" class="form-control" autocomplete="off" autofocus>
        </div>

        <div class="form-group">
            <label for="url">
                URL:
            </label>
            <input type="text" name="url" id="url" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Add Site</button>
        </div>

    </form>

    <hr/>

    <div class="card-columns">
        @foreach ( $sites as $site )
        <a href="{{ $site->url }}">
            <div class="card" style="background-image: {{ $site->background_image }}">
                <div class="card-block">
                    <h4 class="card-title" style="color: {{ $site->color }}">{{ $site->title }}</h4>

                    <p class="card-text">{{ $site->url }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/geopattern.min.js"></script>
</body>
</html>
