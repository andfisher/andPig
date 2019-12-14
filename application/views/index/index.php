<!DOCTYPE html>
<html class="no-js" lang="">
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="x-ua-compatible" content="ie=edge">
	  <title>Pig Dice game</title>
	  <meta name="description" content="">

	  <link rel="stylesheet" href="/css/main.css">

	</head>
	<body>

        <h1>PIG Game</h1>
        <?php foreach ($players AS $player): ?>
        <h2>player <?php echo $player->getId(); ?>: <?php echo $player->getScore(); ?></h2>
        <?php endforeach; ?>

        <form action="/" method="post">
            Active Player <?php echo $activePlayer->getId(); ?>
            <input type="submit" name="roll" value="Roll">
            <input type="submit" name="pass" value="Pass">

            <br>
            <br>
            <input type="submit" name="restart" value="Restart">
        </form>

	</body>
</html>