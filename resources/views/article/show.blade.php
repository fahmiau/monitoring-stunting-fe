<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="shortcut icon" href="{{ asset('img/icons/logo_kecil.png') }}" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <hr class="my-4">
      <div>
        <article>
          {!! $article->body !!}
        </article>
      </div>
      <hr class="my-4">
      @if (Session::get('logged_in') == 1)
        <div class="cursor-pointer w-fit" onclick="likeArticle({{$article->id}},{{$article->liked}})">
          <a
            class="inline-block text-center font-medium border-2 {{ $article->liked ? 'text-red-500' : '' }} border-secondary hover:border-red-500 hover:text-red-500 hover:bg-gray-300 px-4 py-2 rounded-md object-center transform duration-300">
            <i class="fas fa-heart"></i>
            {{ count($article->likes) }}
            </a>
        </div>
        {{-- <form action="{{ url('/article/like') }}" method="post">
          @csrf
          <input type="text" name="article_id" value="{{ $article->id }}">
          <input type="text" name="liked" value="{{ $article->liked }}">
          <button type="submit">submit</button>
        </form> --}}
      @else
        <div class="cursor-not-allowed">
          <a
          class="inline-block text-center font-medium border-2 border-secondary px-4 py-2 rounded-md object-center">
            <i class="fas fa-heart"></i>
            {{ count($article->likes) }}
          </a>
        </div>
      @endif
      <div class="mt-8">
        <h2 class="text-2xl font-medium">Komentar</h2>
        <form class="mt-8" id="comment-form">
          @csrf
          <input type="hidden" name="article_id" value="{{ $article->id }}">
          <div class="flex flex-col">
            <textarea id="comment" name="comment" rows="3"
              class="w-full border rounded-md p-2"
              placeholder="Tambah Komentar"
              {{ !Session::get('logged_in') ? 'disabled' : '' }}></textarea>
          </div>
      
          <div class="mt-4 flex justify-end">
            <button
              class="bg-primary font-semibold text-secondary px-4 py-2 rounded-md hover:bg-secondary hover:text-primary"
              type="button"
              {{ !Session::get('logged_in') ? 'disabled' : 'onclick=addComment()' }}
              >
              Tambah Komentar
            </button>
          </div>
        </form>
      
        <div class="mt-8">
          @if (count($article->comments) > 0)
            <ul class="comments-list space-y-2">
              @foreach ($article->comments as $comment)
                <li class="comment-item p-4 bg-gray-100 rounded-lg shadow-md">
                  <div class="flex items-center">
                    <p class="text-gray-800 font-bold mr-2">{{ $comment->user->name }}</p>
                  </div>
                  <p class="text-gray-700 mt-2">{{ $comment->comment }}</p>
                  <hr class="my-2 h-1 bg-gray-400">
                  <div class="text-right">
                    <a class="font-semibold cursor-pointer hover:text-gray-600" onclick="toggleReply({{ $loop->index }})">Balas</a>
                  </div>
                  <div>
                    <form class="mt-4 hidden" id="reply-comment-form-{{ $loop->index }}">
                      @csrf
                      <input type="hidden" name="article_comment_id" value="{{ $comment->id }}">
                      <div class="flex flex-col">
                        <textarea name="reply_comment" rows="3"
                          class="w-full border rounded-md p-2"
                          placeholder="Tambah Komentar"
                          {{ !Session::get('logged_in') ? 'disabled' : '' }}></textarea>
                      </div>
                      <div class="mt-4 flex justify-end">
                        <button
                          class="bg-primary font-semibold text-secondary px-4 py-2 rounded-md hover:bg-secondary hover:text-primary"
                          type="button"
                          onclick="addReplyComment({{ $loop->index }})"
                          >
                          Balas Komentar
                        </button>
                      </div>
                    </form>
                  </div>
                  @if (count($comment->replies) > 0)
                    @foreach ($comment->replies as $reply)
                      <div class="ml-4 mt-2 p-4 bg-gray-200 rounded-lg shadow-md">
                        <div class="flex items-center">
                          <p class="text-gray-800 font-bold mr-2">{{ $reply->user->name }}</p>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $reply->reply_comment }}</p>
                      </div>
                    @endforeach
                  @endif
                </li>
              @endforeach
            </ul>
          @else
            <p class="text-gray-500">Belum ada komentar</p>
          @endif

        </div>
      </div>
      
    </div>
  </div>
  <script src="{{ asset('js/show-article.js') }}"></script>
</body>
</html>