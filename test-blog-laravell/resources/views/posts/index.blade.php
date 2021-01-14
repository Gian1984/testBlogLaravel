@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 m-2 rounded-lg">
            <h1 class="text-2xl font-medium mb-1">
                NASA's Astronomy Picture of the Day
            </h1>
            <h2 id="title"></h2>
            <p id="date" class="mb-4"></p>
            <section class="picture-explanation-container">
                <img src="" id="picture" alt="astronomy image by NASA" />

            </section>
            <p id="explanation" class="mt-4"></p>
        </div>
        <div class="w-8/12 bg-white p-6 m-2 rounded-lg">
                @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post somenthing!"></textarea>

                        @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium w-full">Post</button>
                </div>

                </form>
                @endauth
                @if($posts->count())
                    @foreach ($posts as $post)
                        
                        <x-post :post="$post"/>

                    @endforeach
                    <!-- tailwind automatically style this -->
                    {{ $posts->links() }}
                    <!-- end of autostyle  -->
                @else
                    <p>There is no post</p>
                @endif

        </div>       
    </div>
   
    <script>

    fetch("https://api.nasa.gov/planetary/apod?api_key=YQcvCrtT07JREAmVX12qSDBfrytYf6pe4hEvlO90")
    .then(response => response.json())
    .then((data) => {
        document.getElementById('title').textContent = data.title
        document.getElementById('date').textContent = data.date
        document.getElementById('picture').src = data.hdurl
        document.getElementById('explanation').textContent = data.explanation
    })

    </script>
@endsection


