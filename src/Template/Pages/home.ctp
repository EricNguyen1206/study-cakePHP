<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (!empty($title)): ?>
        <h1><?= h($title) ?></h1>
    <?php else: ?>
        <h1>Hello World!</h1>
    <?php endif; ?>

</body>

</html>