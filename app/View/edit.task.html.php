<?php
require 'parts/header.html.php';
?>


<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-body">
            <form action="/task/add/" method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username" class="control-label">Name:</label>
                            <input type="text" id="username" name="username" required="required"  class="form-control" value="<?php echo $task->getUserName(); ?>" minlength="3">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mail" class="control-label">Email:</label>
                            <input type="email" id="mail" name="mail" required="required"  class="form-control" value="<?php echo $task->getMail(); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="tasktext" class="control-label">Text:</label>
                    <textarea name="tasktext" id="tasktext" class="form-control" rows="3" required="required"><?php echo $task->getTaskText(); ?></textarea>
                </div>
                <label for="completed">
                    Completed
                </label>
                <input type="checkbox" id="completed" name="status" <?php if ($task->isCompleted()) echo 'checked'; ?>>
                <input type="hidden" name="id" value="<?php echo $task->getId(); ?>">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>
    </div>
</div>