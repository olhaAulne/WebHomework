<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Нове бронювання</title>
    <link id="theme-style" rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
</head>
<body>
<?php
require_once '_db.php';

$rooms = $db->query('SELECT * FROM rooms');

$start = $_GET['start'];
$end = $_GET['end'];
?>
<form id="f" action="backend_create.php" style="padding:20px;">
    <h1>Нове бронювання</h1>
    <div>Name:</div>
    <div><input type="text" id="name" name="name" value=""/></div>
    <div>Start:</div>
    <div><input type="text" id="start" name="start" value="<?php echo $start ?>"/></div>
    <div>End:</div>
    <div><input type="text" id="end" name="end" value="<?php echo $end ?>"/></div>
    <div>Room:</div>
    <div>
        <select id="room" name="room">
            <?php
            foreach ($rooms as $room) {
                $selected = $_GET['resource'] == $room['id'] ? ' selected="selected"' : '';
                $id = $room['id'];
                $name = $room['name'];
                print "<option value='$id' $selected>$name</option>";
            }
            ?>
        </select>

    </div>
    <div class="space"><input type="submit" value="Save"/> <a href="javascript:close();">Cancel</a></div>
</form>
<script type="text/javascript">
    function close(result) {
        if (parent && parent.DayPilot && parent.DayPilot.ModalStatic) {
            parent.DayPilot.ModalStatic.close(result);
        }
    }

    $("#f").submit(function () {
        var f = $("#f");
        $.post(f.attr("action"), f.serialize(), function (result) {
            close(eval(result));
        });
        return false;
    });

    $(document).ready(function () {
        $("#name").focus();
    });

</script>
</body>
</html>