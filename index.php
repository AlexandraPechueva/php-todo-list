<?php 
    include_once 'Task.php';
    $task = new Task();
    $task->setStatus(0);
    $taskInfo = $task->getAllTask();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <title>todo</title>
</head>

<body class="body">

<div class="lists-container d-flex">
    <div class="task-container">
        <h3>Список задач</h3>
        <form class="form-container d-flex  justify-content-between pt-3 pb-4" id="taskForm"> 
            <div class="input-block flex-grow-1">
                <input type="text" class="form-control todo-list-input" placeholder="Название задачи" required> 
                <small class="error-message hidden">Обязательное поле</small>
            </div>

            <button class="add btn btn-primary todo-list-add-btn">Добавить</button> 
        </form>
                            
        <div class="list-wrapper">
            <ul class="d-flex flex-column todo-list">
                
                <?php 
                    $numTasks = 0;

                    foreach($taskInfo as $key=>$element) {
                        if(empty($element['status']) || $element['status'] == 0){
                            $class = '';
                            $checked = '';
                        } 
                        
                        if(empty($element['status']) || $element['status'] == 0){
                            $numTasks = $numTasks + 1;
                    ?>
                        
                        <li <?php print $class; ?>>
                            <div class="form-check">
                                <label class="form-check-label"> 
                                    <input class="checkbox" type="checkbox" <?php print $checked; ?>
                                        data-utaskid="<?php print $element['id']; ?>"> <?php print $element['title']?> 
                                        <span class="checkmark"></span>
                                </label>  
                            </div>      
                        </li>
                    <?php } ?>
                <?php } ?>

            </ul>
        </div>
        
        <p class="not-done"><span class="tasks-count"><?php print $numTasks?></span> задач(и) не выполнено</p>
    </div>

    <div class="task-container">
        <h3>Выполненные задачи</h3>

        <div class="list-wrapper">
            <ul class="d-flex flex-column done-list">
                
                <?php foreach($taskInfo as $key=>$element) {
                    if(!empty($element['status']) && $element['status']==1){
                        $class = 'class="done"';
                    } 
                    
                    if(!empty($element['status']) && $element['status']==1){                                          
                    ?>
                    
                        <li <?php print $class; ?>>
                        <div class="form-check">
                            <?php print $element['title']?> 
                        </div>
                        </li>

                    <?php  } ?>
                <?php }  ?>

            </ul>
        </div>
    </div>    
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/todo.js"></script> 
</body>
</html>
