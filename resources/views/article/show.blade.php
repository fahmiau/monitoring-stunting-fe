<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    @media only screen and (max-width: 600px) {
      .img-responsive{ max-width: 20rem;}
    }
  </style>
  <title>Artikel</title>
</head>
<body class="bg-primary">
  <div class="main-content flex flex-col items-center md:pb-5">
    <div class="p-8 max-w-screen-sm bg-white rounded-lg shadow-md">
      <h2 class="text-2xl text-center font-medium mb-4">{{ $article->title }}</h2>
      <div>
        <article>
          {!! $article->body !!}
        </article>
        <hr>
      </div>
    </div>
  </div>
  <script>
    
  </script>
</body>
</html>