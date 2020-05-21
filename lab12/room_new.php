<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Нова кімната</title>
    	<link id="theme-style" rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="js/daypilot-all.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
            
            require_once '_db.php';
            
            $rooms = $db->query('SELECT * FROM rooms');
        ?>
        <form id="f" style="padding:20px;">
            <h1>Нова кімната</h1>
            
            <div class="space">
                <div>Name: </div>
                <div><input type="text" id="name" name="name" value="" /></div>
            </div>
            
            <div class="space">
                <div>Capacity:</div>
                <div>
                    <select id="capacity" name="capacity">
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='4'>4</option>
                    </select>
                </div>
            </div>
            
            <div class="space"><input type="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
        </form>
        
        <script type="text/javascript">
        function close(result) {
            DayPilot.Modal.close(result);
        }

        $("#f").submit(function () {
            var f = $("#f");
            $.post("backend_room_create.php", f.serialize(), function (result) {
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
