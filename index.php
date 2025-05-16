
  <?php
  session_start();
  $action = $_POST['action'] ?? '';
  require_once "controllers/auth.php";
  require_once "controllers/apiController.php";
  switch($action){
    case "login":
      (new AuthController())->login();
      break;
    case "profile":
      (new ApiController())->profile();
      break;
    case "datetime":
      (new ApiController())->datetime();
      break;
    default:
      include './pages/auth.php';
  }
  ?>


