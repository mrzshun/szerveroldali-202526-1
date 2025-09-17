<?php 
    function generateName() {
        $familyNames = ['Smith','Doe','Radford','Coltrane'];
        $givenNames = ['Sarah','Joe','James','Jessica','Jane','Joe'];
        return $givenNames[array_rand($givenNames)].' '.$familyNames[array_rand($familyNames)];
    }
    function generateEmail($name) {
        $emailEndings = ['gmail.com','protonmail.com','yahoo.com'];
        $nameArray = explode(' ',$name);
        $simpleName = '';
        if(sizeof($nameArray) == 0) {
            $simpleName = 'johndoe';
        }
        elseif(sizeof($nameArray) == 1) {
            $simpleName = $nameArray[0];
        }
        else {
            $simpleName = $nameArray[0].$nameArray[1];
        }
        $simpleName = strtolower($simpleName);
        return $simpleName.'@'.$emailEndings[array_rand($emailEndings)];
    }
    $name = generateName();
    $email = generateEmail($name);
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
    <h1>Hello <?php echo $name; ?></h1>
    <p>You email address is <?php echo $email; ?></p>
  </body>
</html>
