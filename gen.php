<?php
    $db = new PDO("mysql:host=MySQL-8.0;dbname=movies", "root", "");
    $info = [];
    $category = [];
    // Получаем жанр из URL
    $genre = isset($_GET['genre']) ? $_GET['genre'] : '';

    // Получаем категории для навигации
    $query = $db->query("SELECT * FROM category");
    $category = $query->fetchAll(PDO::FETCH_ASSOC);

    // Получаем фильмы по жанру, если он указан
    if ($genre) {
        $query = $db->prepare("SELECT * FROM movies_list WHERE genre = :genre");
        $query->execute(['genre' => $genre]);
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="menu">
        <div class="person">
            <div class="acc">
                <img src="img/account.png" alt="" height="60" width="60">
            </div>
            <p class="persn">Иван Иванов</p>
        </div>
        
        <a id="nav" href="index.php">Главная</a>
        <div class="genres">
            <a id="nav" href="genres.php">Жанры</a>
        </div>
        <a id="nav" href="">Любимое</a>
        <a id="nav" href="">Подборки</a>
        <div class="subscribe">
            <Button>Подписка</Button>
        </div>
        <div class="assistant">
            <div class="as">
                <img src="img/account.png" alt="" height="60" width="60">
            </div>
            <a id="help" href="">Помощь</a>
        </div>
    </div>
    <section>      
        <div class="category">
            <h5><?php echo htmlspecialchars($genre); ?></h5>
        </div>    
        <div class="container">
            <?php foreach($info as $data): ?>
            <div class="item">
                <div class="image">
                    <img class="poster" src="<?php echo htmlspecialchars($data['image']); ?>" alt="poster">
                </div>
                <div class="texts">
                    <p class="name"><?php echo htmlspecialchars($data['name']); ?></p>
                    <a class="link" href="<?php echo htmlspecialchars($data['url']); ?>">Посмотреть =></a>
                </div>
                <div id="rating">
                    <span><?php echo htmlspecialchars($data['rating']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>

    </footer>
</body>
</html>