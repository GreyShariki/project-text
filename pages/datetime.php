<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>Document</title>
</head>
<body>
<div id = "clock"></div>
<form action="/" method = "POST">
    <input type="hidden" name = "action" value = "profile">
    <button class = "dateButton" type = "submit">Личный кабинет</button>
</form>
<script>
    const putDate = () =>{
        const date = new Date();
        const timeNow = date.toLocaleTimeString();
        document.getElementById("clock").textContent = timeNow;
    }
    putDate()
    setInterval(putDate, 1000);
</script>
    </body>
</html>