<?php
    $db = new PDO("mysql:host=MySQL-8.0;dbname=movies", "root", "");
    $info = [];
    $category = [];

    if($query = $db->query("Select * from movies_list")){
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $info = $db->errorInfo();
    }
    if($query = $db->query("Select * from category")){
        $category = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $category = $db->errorInfo();
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
        
        <div class="genres">
            <a id="nav" href="index.php">Главная</a>
        </div>
        <a id="nav" href="genres.php">Жанры</a>
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
        <div class="head">
            <h5 class="company">НеКиноПоиск</h5>
            <img id="search" src="img/search.png" alt="" width="30" height="30">
            <form method="GET" action="">
                <input class="search" type="text" name="query" placeholder="Поиск" required>
            </form>
        </div>
        
        <div class="category">
            <h5>Сейчас смотрят</h5>
        </div>    
        <div class="container">
        <?php
    // Получение фильмов по запросу
            $queryParam = isset($_GET['query']) ? $_GET['query'] : '';

            if ($queryParam) {
                // Подготовка и выполнение запроса
                $query = $db->prepare("SELECT * FROM movies_list WHERE name LIKE :query");
                $searchTerm = "%" . $queryParam . "%"; // Добавляем символы подстановки для поиска
                $query->bindParam(':query', $searchTerm);
                $query->execute();
                $info = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            foreach($info as $data): ?>
            <div class="item">
                <div class="image">
                    <img class="poster" src="<?php echo $data['image']; ?>" alt="poster">
                </div>
                <div class="texts">
                    <p class="name"><?php echo $data['name']; ?></p>
                    <a class="link" href="<?php echo $data['url']; ?>">Посмотреть =></a>
                </div>
                <div id="rating">
                    <span><?php echo $data['rating']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>

    </footer>
</body>
</html>