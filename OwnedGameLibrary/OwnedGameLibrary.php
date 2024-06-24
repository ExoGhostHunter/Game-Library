<?php
require_once 'GameManager.php';

$gameManager = new GameManager();
$games = $gameManager->getAllGames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Game Library Joddi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Style.css"> <!-- Include styles.css before script.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body> 
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

<div id="container" class="row bg-dark">
  <div id="sidebar-container" class="col-2 bg-dark min-vh-100">
    <div class="sidebar">
      <ul>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#addGameModal">Add Game</a></li>
      </ul>
    </div>
  </div>

  <div id="mainInfo-container" class="col-6 bg-dark">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php foreach ($games as $game): ?>
        <div class="col">
          <div class="game">
            <a href="viewGame.php?id=<?php echo $game['id']; ?>">
              <img src="<?php echo "../../images/" . $game['image']; ?>" alt="<?php echo $game['title']; ?>" class="img-fluid game-img" />
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- Add Game Modal -->
<div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGameModalLabel">Add Game</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a game -->
        <form action="AddGame.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="gameTitle" class="form-label">Game Title:</label>
            <input type="text" id="gameTitle" name="gameTitle" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="platform" class="form-label">Platform:</label>
            <input type="text" id="platform" name="platform" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="genre" class="form-label">Genre:</label>
            <input type="text" id="genre" name="genre" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="steamid" class="form-label">Steam ID:</label>
            <input type="text" id="steamid" name="steamid" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="descriptie" class="form-label">Description:</label>
            <textarea id="descriptie" name="descriptie" class="form-control" rows="4" required></textarea>
          </div>

          <div class="mb-3">
            <label for="fileToUpload">Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          
          <input type='submit' class="btn btn-primary" name='submit' value='Submit'>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="OpenGame.js"></script>
</body>
</html>
