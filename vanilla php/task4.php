<?php 
    require_once 'vendor/autoload.php';
    $filename = './data/blog.json';
    $fileExists = false;
    $postById = null;
    if(file_exists($filename)) {
        $fileExists = true;
        $posts = json_decode(file_get_contents($filename,true),true);
    }
    if(isset($_GET['id'])) {
        foreach($posts as $post){
            if($post['id'] == $_GET['id']) {
                $postById = $post;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <?php if($fileExists): ?>
        <?php if($postById == null): ?>
            <h1>Blogposts</h1>

            <pre> <?= print_r($posts) ?> </pre>
            <!-- <?php foreach($posts as $post): ?>
                <h2><?=$post['title']?></h2>
                <p>Author: <?=$post['author']?></p>
                <p><?=$post['desc']?></p>
                <a href="task4.php?id=<?=$post['id']?>">details</a>
            <?php endforeach; ?> -->
        <?php else: ?>
            <h1><?=$postById['title']?></h1>
            <p>Author: <?=$postById['author']?></p>
            <p><strong><?=$postById['desc']?></strong></p>
            <p><?=$postById['text']?></p>
            <a href="task4.php">back</a>
        <?php endif; ?>
    <?php endif; ?>
  </body>
</html>
