<?php
require 'parts/header.html.php';
?>

<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-body">
            <form action="/task/add/" id="addform" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username" class="control-label">Name:</label>
                            <input type="text" id="username" name="username" class="form-control" required="required" minlength="3">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mail" class="control-label">Email:</label>
                            <input type="email" id="mail" name="mail" class="form-control" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="tasktext" class="control-label">Text:</label>
                    <textarea name="tasktext" id="tasktext" class="form-control" rows="3" required="required"></textarea>
                </div>
                <div class="form-group ">
                    <label for="taskimg" class="col-form-label">Image</label>
                    <input type="file" id="taskimg" class="form-control" name="taskimg">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>

            </form>
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Preview</button>
            </div>
    </div>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Priview</h4>
            </div>
            <div class="modal-body">
                <p><b>Name:</b></p>
                <p class="name"></p>
                <p><b>Email:</b></p>
                <p class="email"></p>
                <p><b>Text:</b></p>
                <p class="text"></p>
            </div>
            <div class="modal-footer"><button class="btn btn-default submit" type="button">Submit</button></div>
        </div>
    </div>
</div>


