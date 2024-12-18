<?php
require_once '../../app/db.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$db = connectMongoDB();
$collection = $db->NewsOne;
if (isset($_GET['delete'])) {
    $newsId = $_GET['delete'];

    if (preg_match('/^[a-f0-9]{24}$/', $newsId)) {
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($newsId)]);
        header("Location: list-news.php");
        exit;
    } else {
        echo "Invalid ObjectId format.";
    }
}

$searchQuery = '';
// Cek apakah ada input pencarian
if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);
}

$filter = [];
if ($searchQuery) {
    $filter = [
        '$or' => [
            ['title' => new MongoDB\BSON\Regex($searchQuery, 'i')],
            ['content' => new MongoDB\BSON\Regex($searchQuery, 'i')],
            ['author' => new MongoDB\BSON\Regex($searchQuery, 'i')]
        ]
    ];
}

$newsList = $collection->find($filter);

$newsArray = iterator_to_array($newsList);
?>

<?php
include '../partials/cdn.php';
?>
<title>Dashboard</title>

<body>
    <?php
    include '../partials/navbar.php';
    ?>

    <div class="d-flex">

        <?php
        include '../partials/sidebar.php';
        ?>

        <div class="container">
            <?php
            include '../partials/table.php';
            ?>
        </div>
        
    </div>
</body>