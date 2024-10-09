<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <?php
        include("register.php");
    ?>
    <script>
        function toggleViewPass() {
            var x = document.getElementById("born");
            if (x.type === "date") {
                x.type = "text";
            } else {
                x.type = "date";
            }
        }
        document.getElementById('btn_toggle').addEventListener('click', function () {
            document.body.classList.toggle('dark-theme');
        });
    </script>
</body>
</html>