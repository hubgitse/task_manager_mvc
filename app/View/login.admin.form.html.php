<?php
require 'parts/header.html.php';
?>

<form action="/login/" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="login">Login:</label>
        <div class="col-sm-10">
            <input type="text" name="login" id="login"  class="form-control" placeholder="Enter login" required="required"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">
            <input type="password" id="pwd" class="form-control" name="pass" placeholder="Enter password" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>


<?php
require 'parts/footer.html.php';
?>