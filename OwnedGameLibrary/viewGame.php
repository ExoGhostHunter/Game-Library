<?php
require_once 'GameManager.php';

$gameManager = new GameManager();
$game = null;

if (isset($_GET['id'])) {
    $gameId = $_GET['id'];
    $game = $gameManager->getGameById($gameId);
}

if (!$game) {
    echo "Game not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $game['title']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light"> 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../../main.php">HoofdPagina</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../School.php">School</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../Mijzelf.php">Mijzelf</a>
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Games</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Game Library</a></li>
            <li><a class="dropdown-item" href="../CustomGameLibrary/CustomGameLibrary.php">Custom Games</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1><?php echo $game['title']; ?></h1>
  <img src="<?php echo $game['image']; ?>" alt="<?php echo $game['title']; ?>" class="img-fluid">
  <p><?php echo $game['descriptie']; ?></p>
  <form action="GameManager.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $game['id']; ?>">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="current_image" value="<?php echo $game['image']; ?>">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $game['title']; ?>">
    </div>
    <div class="mb-3">
      <label for="platform" class="form-label">Platform</label>
      <input type="text" class="form-control" id="platform" name="platform" value="<?php echo $game['platform']; ?>">
    </div>
    <div class="mb-3">
      <label for="genre" class="form-label">Genre</label>
      <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $game['genre']; ?>">
    </div>
    <div class="mb-3">
      <label for="steamid" class="form-label">Steam ID</label>
      <input type="text" class="form-control" id="steamid" name="steamid" value="<?php echo $game['steamid']; ?>">
    </div>
    <div class="mb-3">
      <label for="descriptie" class="form-label">Description</label>
      <textarea class="form-control" id="descriptie" name="descriptie" rows="3"><?php echo $game['descriptie']; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="GameManager.php?action=delete&id=<?php echo $game['id']; ?>" class="btn btn-danger">Delete</a>
    <button type="button" class="btn btn-success" onclick="launchGame('<?php echo $game['steamid']; ?>')">Play</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function launchGame(steamid) {
  window.location.href = 'steam://rungameid/' + steamid;
}
</script>

</body>
</html>
