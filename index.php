<?php


$connection = require_once './connection.php';

$notes = $connection->getNotes();

// crete array to crete a data placeholder for
$currentNote = [
        'id' => '',
        'title' => '',
        'description' => ''
];

// get note id to update a note
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

// echo "<pre>";
// var_dump($currentNote);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
<!--  <link rel="stylesheet" href="note.css">-->
  <title>Document</title>
</head>
<body>
  <div class="app">
    <form class="new-note" action="save.php" method="post">
<!--   id will be set when update is called otherwise value will be - ' ' -->
        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
      <input type="text" name="title" placeholder="Note title"
             autocomplete="off" value="<?php echo $currentNote['title']; ?>">
      <textarea name="description" cols="30" rows="4" placeholder="Note description"
      ><?php echo $currentNote['description']; ?></textarea>
      <button>
<!--    show btn text based on id value in the list   -->
          <?php if($currentNote['id']): ?>
                Update note
          <?php else: ?>
                New note
          <?php endif; ?>
      </button>
    </form>
      <div class="notes">
    <?php foreach ($notes as $note): ?>
          <div class="note">
              <div class="title">
                  <a href="?id=<?php echo $note['id'] ?>"> <?php echo $note['title']; ?></a>
              </div>
              <div class="description">
                  <?php echo $note['description']; ?>
              </div>
              <small><?php echo $note['create_date']; ?></small>

              <form action="delete.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
              <button class="close">X</button>
              </form>
          </div>
      <?php endforeach; ?>
      </div>
  </div>


  
</body>
</html>