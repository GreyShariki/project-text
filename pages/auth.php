<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>Document</title>
</head>
    <body>
        <form id = "loginForm" method = "post" action="/">
            <legend>Вход</legend>
            <input type="hidden" name="action" value="login">
            <input id = "login" name = "login" type="text" placeholder = "Логин">
            <input id = "password" name = "password" type="password" placeholder = "Пароль">
            <button type = "submit">Войти</button>
        </form>
    </body>
</html>