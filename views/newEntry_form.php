
<hr>

<h3>Enter a new task that you are focusing on.</h3>
<p>(Focus name, Sub Focus, Date, Start Time, End Time)</p>

<hr>

<form action="newEntry.php" method="post">
    <fieldset>
        <div class="focusButton">
            <input autocomplete="on" autofocus class="form-control" name="focus" placeholder="Focus" type="text"/>
        </div>
        <div class="focusButton">
            <input autocomplete="on" autofocus class="form-control" name="subfocus" placeholder="SubFocus" type="text"/>
        </div>
        <div class="focusButton">
            <input class="form-control" name="date" placeholder="startDate" type="date" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="focusButton">
            <input autocomplete="off" autofocus class="form-control" name="start" placeholder="startTime" type="time" />
        </div>
        <div class="focusButton">
            <input autocomplete="off" autofocus class="form-control" name="end" placeholder="End Time" type="time"/>
        </div>
        <br>
        <br>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Submit
            </button>
        </div>
    </fieldset>
</form>

<hr>