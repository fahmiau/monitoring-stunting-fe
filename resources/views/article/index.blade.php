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
  <div class="main-content flex-1 pb-24 md:pb-5">
    <div class="p-8">
      <h2 class="text-3xl text-center font-medium my-8">Artikel</h2>
      <div class="flex justify-center flex-col items-center">
        @foreach ($articles as $article)
          <div class="w-1/2 p-4">
            <a class="text-xl font-medium my-4" href="{{ url('/article/published/'.$article->slug) }}"><h3>{{ $article->title }}</h3></a>
            <article class="my-4 ml-4">
              {!! $article->excerpt !!}
            </article>
            <a class="ml-4 underline" href="{{ url('/article/published/'.$article->slug) }}">READ MORE...</a>
            <hr>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>
