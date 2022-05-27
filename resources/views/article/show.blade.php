<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>Artikel</title>
</head>
<body class="bg-primary">
  <div class="main-content flex-1 bg-primary mt-12 md:mt-2 pb-24 md:pb-5">
    <div class="p-8 ml-4">
      <h2 class="text-2xl font-medium ml-8 my-8">{{ $article->title }}</h2>
      <div>
        <article>
          {!! $article->body !!}
        </article>
        <hr>
      </div>
    </div>
  </div>
</body>
</html>