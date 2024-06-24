<?php
require_once 'Database.php';
require_once 'Game.php';

class GameManager {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllGames() {
        $conn = $this->db->connectDB();
        $sql = "SELECT * FROM games";
        $result = $conn->query($sql);
        $games = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $games[] = $row;
            }
        }

        return $games;
    }

    public function getGameById($id) {
        $conn = $this->db->connectDB();
        $sql = "SELECT * FROM games WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function addGame(Game $game) {
        $conn = $this->db->connectDB();
        $sql = "INSERT INTO games (title, platform, genre, steamid, descriptie, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $game->getTitle(), $game->getPlatform(), $game->getGenre(), $game->getSteamid(), $game->getDescriptie(), $game->getImage());

        return $stmt->execute();
    }

    public function updateGame(Game $game) {
        $conn = $this->db->connectDB();
        $sql = "UPDATE games SET title = ?, platform = ?, genre = ?, steamid = ?, descriptie = ?";

        if ($game->getImage()) {
            $sql .= ", image = ?";
            $stmt = $conn->prepare($sql . " WHERE id = ?");
            $stmt->bind_param("ssssssi", $game->getTitle(), $game->getPlatform(), $game->getGenre(), $game->getSteamid(), $game->getDescriptie(), $game->getImage(), $game->getId());
        } else {
            $stmt = $conn->prepare($sql . " WHERE id = ?");
            $stmt->bind_param("sssssi", $game->getTitle(), $game->getPlatform(), $game->getGenre(), $game->getSteamid(), $game->getDescriptie(), $game->getId());
        }

        return $stmt->execute();
    }

    public function deleteGame($id) {
        $conn = $this->db->connectDB();
        $sql = "DELETE FROM games WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameManager = new GameManager();

    if ($_POST['action'] === 'edit') {
        $game = new Game();
        $game->setId($_POST['id']);
        $game->setTitle($_POST['title']);
        $game->setPlatform($_POST['platform']);
        $game->setGenre($_POST['genre']);
        $game->setSteamid($_POST['steamid']);
        $game->setDescriptie($_POST['descriptie']);
        $currentImage = $_POST['current_image'];

        if ($_FILES['image']['name']) {
            $target_dir = "../../images";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $game->setImage($target_file);
        } else {
            $game->setImage($currentImage);
        }

        $gameManager->updateGame($game);
        header("Location: OwnedGameLibrary.php");
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $gameManager = new GameManager();
    $gameManager->deleteGame($_GET['id']);
    header("Location: OwnedGameLibrary.php");
}
?>
