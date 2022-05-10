<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

        
    </head>
    <body  class="font-sans leading-normal tracking-normal">
      <div class="min-h-screen flex flex-wrap content-center justify-center">
        <div class="w-1/3 p-8 shadow-md rounded-md bg-gray-100">
          <form action="/login" method="post">
            @csrf
            <div>
              <label class="font-medium" for="email">Email Address</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror " type="email" name="email" id="email" placeholder="name@example.email" required value="{{ old('email') }}" autofocus>
            </div>
            <div>
              <label class="font-medium" for="password">Password</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror" type="password" name="password" id="password" placeholder="password" required>
              @error('email')
              <div class="text-red-500 ml-2 text-medium">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="flex justify-center mt-4">
              <button class="font-medium text-lg bg-[#06CA51] py-2 px-10 rounded-md object-center" type="submit">Login</button>
            </div>
          </form>
        </div>
      </div>
    
    </body>
</html>