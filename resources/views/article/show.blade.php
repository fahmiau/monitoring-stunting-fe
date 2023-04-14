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
      </div>
      <hr class="my-4">
      <div>
        <h3 class="text-xl">Komentar</h3>
        <div class="pl-4">
          <div>
            <h5>Nama User</h5>
            <input class="w-full border-x-0 border-t-0 border-b-2 bg-slate-200"
            type="text"
            placeholder="Tambah komentar"
            >
            <textarea
              class="w-full border-x-0 border-t-0 border-b-2 bg-slate-200"
              name="" id="" rows="1"
              placeholder="Tambah komentar"
              ></textarea>
              <span
              class="w-full "
              contenteditable="true"
              >
              </span>
          </div>
          <div>
            <h5>Nama User</h5>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum voluptate dolores iste omnis non corrupti hic esse, laboriosam eos vero quisquam, corporis amet impedit dolore. Ea, aliquid! Ab, tempore. Rem.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    
  </script>
</body>
</html>