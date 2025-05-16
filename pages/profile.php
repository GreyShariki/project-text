 <!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>Document</title>
</head>
<body>
 <div class="profile">
        <h2>Личный кабинет</h2>
        
        <div class="user">
            <div class="avatar"></div>
            <div>
                <h3><?php echo $_SESSION["user"] ?></h3>
                <p>Имя</p>
                <p>почта@домен</p>
            </div>
        </div>
        <div class="actions">
            <form action="/" method="POST">
                <input type="hidden" name="action" value="datetime">
                <button type="submit">Страница даты</button>
            </form>
            <form action="/" method="POST">
                <input type="hidden" name="action" value="">
                <button type="submit" class="logout">Выход</button>
            </form>
        </div>
    </div>
    </body>
</html>