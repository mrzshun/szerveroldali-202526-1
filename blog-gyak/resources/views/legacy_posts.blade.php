<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @empty($posts->toArray())
        <h1>Nincsenek Blogposztok!</h1>
    @else
        <h1>Minden Blogposzt</h1>
        @foreach ($posts as $post)
            <h2>{{$post->title}}</h2>
            <cite>
                @if ($post->author)
                    {{$post->author->name}}
                @else
                    unknown
                @endif
            </cite>
            <p>{{$post->description}}</p>
            <p><strong>Tags:</strong>&nbsp;
            @foreach ($post->categories as $cat)
                <span style="color: {{$cat->txt_color}};background-color: {{$cat->bg_color}}">{{$cat->name}}</span>&nbsp;
            @endforeach
            </p>
        @endforeach
    @endempty
</body>
</html>