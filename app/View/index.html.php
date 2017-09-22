<?php
require 'parts/header.html.php';
?>

<div class="masthead">

   <h3 class="text-muted">Task Manager <?php if($admin) echo ' | Hello, '. $admin->getLogin();?></h3>

    <ul class="nav nav-justified">

        <li class="active"><a href="/">Home</a></li>
        <?php if(!$admin):?>
            <li><a href="/login/">Admin Login</a></li>
        <?php endif;?>
    </ul>

</div>
<div class="jumbotron">
    <h1>
        <?php if(!$admin):?>
            Add Your Task
        <?php else:?>
            Hi! You can edit Tasks
        <?php endif;?>
    </h1>
    <p class="lead">Click edit button to edit specific task</p>
    <?php if(!$admin):?>
        <p><a class="btn btn-lg btn-success" href="/task/add/" role="button">Add Now</a></p>
    <?php endif;?>
</div>


<div class="row">
    <div class="col-lg-12">
        <p style="text-align:center">
            <a class="btn btn-lg btn-default" href="/<?php echo 'sort=mail'; ?>" role="button">Sort by Mail</a>
            <a class="btn btn-lg btn-default" href="/<?php echo 'sort=user_name'; ?>" role="button">Sort by Name</a>
            <a class="btn btn-lg btn-default" href="/<?php echo 'sort=completed'; ?>" role="button">Sort by Status</a>
        </p>

    <?php if (!$tasks): ?>
        <p>No tasks found</p>
    <?php else:?>

     <?php foreach ($tasks as $task): ?>
         <article class="panel panel-default">
             <div class="panel-heading">
                 <h2 class="panel-title">Name: <?php echo $task->getUserName(); ?> | Email: <?php echo $task->getMail(); ?>
                     <?php if($admin) echo '<a class="btn btn-primary btn-sm" style="color:#fff"" href="/edit/'.$task->getId().'">Edit</a>'?>
                 </h2>
             </div>
             <div class="panel-body">
                 <img src="<?php
                    $img = $task->getImg() ? $task->getImg() : 'default.jpg';
                    echo '/app/upload/'.$img; ?>" class="img-rounded left"
                 >
                 <p>
                     <?php echo $task->getTaskText(); ?>
                 </p>
             </div>
             <div class="panel-footer">
                 <span class="label <?php echo $style = ($task->isCompleted()) ? 'label-success' : 'label-danger';?>">
                     <?php echo $status = ($task->isCompleted()) ? 'completed' : 'not completed'; ?>
                 </span>
             </div>
         </article>
      <?php endforeach; ?>
      <?php endif;?>

        <p><?php echo $pagination->makePaginationHtml();?></p>

    </div>
</div>


<?php
require 'parts/footer.html.php';
?>