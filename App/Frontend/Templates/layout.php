<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?= isset($title) ? $title : 'Mon super site' ?>
    </title>
</head>
<body>
    <div id="wrap">
        <header>
            <h1>Chill Voc Layout Frontend</h1>
        </header>

        <nav>
            <ul>
                <li><a href="/test/ChillVoc/Web/">Home</a></li>
                <li><a href="/test/ChillVoc/Web/Inscription/">Inscription</a></li>
                <li><a href="/test/ChillVoc/Web/admin/DerniersInscrits">Derniers Inscrits</a></li>
                <?php if ($user->isAuthenticated()) { ?>

                <?php } ?>
            </ul>
        </nav>

        <div id="content-wrap">
            <section id="main">

                <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

                <?= $content ?>
            </section>
        </div>

        <footer></footer>
    </div>
</body>
</html>

