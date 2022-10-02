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
    <div class="p-2">
      <h2 class="text-3xl text-center font-medium my-8">Artikel</h2>
      <div class="flex flex-col items-center">
        @foreach ($articles as $article)
          <a href="{{ url('/article/published/'.$article->slug) }}" class="block">
            <div class="max-w-screen-sm my-4 p-2 bg-white rounded-lg grid grid-cols-4 gap-2 shadow-xl">
              <div class="">
                @if (empty($article->images))
                <img class="object-cover w-full h-full" src="/img/icons/logo_kecil.png" alt="">
                @endif
                @foreach ($article->images as $image)
                <img class="object-cover w-full h-full" src="{{ $image->image_url }}" alt="">
                @endforeach
              </div>
              <div class="col-span-3 pl-2 py-1">
                <div class="h-full grid grid-cols-1 content-between">
                  <h3 class="text-xl md:text-2xl font-medium">{{ $article->title }}</h3>
                  <div class="flex justify-between pr-4">
                    <span class="inline-block">{{ $article->publish_date }}</span>
                    <span class="inline-block">Views : {{ $article->views->views }}</span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>
