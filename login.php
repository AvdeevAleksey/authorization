<?php
    $html = '<!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Регистрация</title>
            <link rel="stylesheet" href="./style.css">

        </head>
        <body>
            <div id="container" class="container">
                <div class="header">
                    <p class="c_id">Войти в WEB ID</p>
                    <p class="forget_id">Забыли WEB ID?</p>
                </div>
                <form method="POST">
                    <input type="email" id="email" name="email" class="form-field email_enter" placeholder="example@mail.ru" required>
                    <input type="password" id="pass" name="pass" class="form-field pass_enter" placeholder="Пароль" required>
                    <p class="or">ИЛИ</p>
                    <div class="icons">
                        <button id="vk" class="vk" onclick="document.location=`https://vk.com`"></button>
                        <button id="tg" class="tg" onclick="document.location=`https://web.telegram.org`"></button>
                        <button id="inst" class="inst" onclick="document.location=`https://www.instagram.com/`"></button>
                    </div>
                    <input type="button" id="btn_enter" name="btn_enter" class="form-field btn_enter" value="Войти">
                    <input type="button" id="btn_toggle" name="btn_toggle" class="form-field btn_toggle" value="Сменить тему">
                </form>
            </div>
            <script>
                document.getElementById("btn_toggle").addEventListener("click", function () {
                    document.body.classList.toggle("dark-theme");
                });
            </script>
        </body>
        </html>';
    // Создаем новый DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    // Теперь вы можете работать с объектом DOM
    // Например, чтобы получить содержимое div
    $div = $dom->getElementById('container');
    if ($div) {
        $div->nodeValue; // Отображаем содержимое div
    }

    // Выводим весь HTML
    echo $dom->saveHTML();
    // $updatedHtml = preg_replace('/<div id="container" class="container">.*?<\/div>/', '<div id="container" class="container">' . $newContent . '</div>', $html);
    // echo $updatedHtml;
