<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Document</title>
</head>

<body>
    <h1>Blogposts:</h1>
    @foreach ($posts as $post)
        <h2>{{ $post['title'] }}</h2>
        <p>Author: {{ $post['author'] }}</p>
        <p><a class="button" href="post/{{$post['id']}}">details</a></p>
    @endforeach

</body>

</html>
