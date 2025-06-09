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
      <button type="button" class="dateButton" id = "datetime">Страница даты</button>
      <button type="button" id = "logout" class="logout">Выход</button>
  </div>
</div>
