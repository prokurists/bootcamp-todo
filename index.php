<!doctype html>
<?php include_once "functions.php";?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css">

<script>
    const PAGE = "<?= @$_GET['page']; ?>";
    <?php
        $tasks = getTasks();
        krsort($tasks);
    ?>
    const TASKS = JSON.parse('<?= json_encode($tasks); ?>');

</script>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">TODO_LIST</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link <?= isPage('design'); ?> " href="?page=design">Design</a>
        <a class="nav-link <?= isPage('code'); ?> " href="?page=code">Code</a>
      </div>
    </div>
  </div>
</nav>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col align-self-center">
        <form action="api.php?page=<?= @$_GET['page']; ?>" onsubmit="postRequest(event, this, addTask);">
            <div class="input-group mb-3">
                <input name="task" type="text" class="form-control" placeholder="New task">
                <button class="btn btn-success" type="submit" id="button-addon2">Add</button>
            </div>
        </form>
    </div>

  </div>
  <div class="row justify-content-center">
    <ul id="task_list" class="col-lg-6 col align-self-center">
        <?php
        
        foreach ($tasks as $id => $task_message) {
            $task_message = htmlentities($task_message);
        ?>
    <li class='list-group-item todo-list-item'>
        <span class='description'><?=$task_message;?></span>
        <a href="#" class="delete" data-id="<?=$id;?>" onclick="requestApi.bind(this)(event);"><i class='bi bi-x-square'></i></a>
    </li>
        <?php
        }
        ?>
        <li class="list-group-item todo-list-item template">
            <span class="description"></span>
            <a href="#" class="delete" onclick="requestApi.bind(this)(event);"><i class="bi bi-x-square"></i></a>
        </li>
    </ul>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="script.js"></script>


