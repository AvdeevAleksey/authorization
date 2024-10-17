<?php
    session_start();
    require_once("crud.php");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(empty($_POST['id'])){
            $action->insert_member(); 
        }
    }
    $countries = ["Россия", "Абхазия", "Австралия", "Австрия", "Азербайджан", "Албания", "Алжир", "Ангола", "Ангуилья", "Андорра", "Антигуа и Барбуда", "Антильские острова", "Аргентина", "Армения", "Афганистан", "Багамские острова", "Бангладеш", "Барбадос", "Бахрейн", "Беларусь", "Белиз", "Бельгия", "Бенин", "Бермуды", "Болгария", "Боливия", "Босния/Герцеговина", "Ботсвана", "Бразилия", "Британские Виргинские о-ва", "Бруней", "Буркина Фасо", "Бурунди", "Бутан", "Вануату", "Ватикан", "Великобритания", "Венгрия", "Венесуэла", "Вьетнам", "Габон", "Гаити", "Гайана", "Гамбия", "Гана", "Гваделупа", "Гватемала", "Гвинея", "Гвинея-Бисау", "Германия", "Гернси остров", "Гибралтар", "Гондурас", "Гонконг", "Государство Палестина", "Гренада", "Гренландия", "Греция", "Грузия", "ДР Конго", "Дания", "Джерси остров", "Джибути", "Доминиканская Республика", "Египет", "Замбия", "Западная Сахара", "Зимбабве", "Израиль", "Индия", "Индонезия", "Иордания", "Ирак", "Иран", "Ирландия", "Исландия", "Испания", "Италия", "Йемен", "Кабо-Верде", "Казахстан", "Камбоджа", "Камерун", "Канада", "Катар", "Кения", "Кипр", "Китай", "Колумбия", "Коста-Рика", "Кот-д'Ивуар", "Куба", "Кувейт", "Кука острова", "Кыргызстан", "Лаос", "Латвия", "Лесото", "Либерия", "Ливан", "Ливия", "Литва", "Лихтенштейн", "Люксембург", "Маврикий", "Мавритания", "Мадагаскар", "Македония", "Малайзия", "Мали", "Мальдивские острова", "Мальта", "Марокко", "Мексика", "Мозамбик", "Молдова", "Монако", "Монголия", "Мьянма (Бирма)", "Мэн о-в", "Намибия", "Непал", "Нигер", "Нигерия", "Нидерланды (Голландия)", "Никарагуа", "Новая Зеландия", "Новая Каледония", "Норвегия", "О.А.Э.", "Оман", "Пакистан", "Палау", "Панама", "Папуа Новая Гвинея", "Парагвай", "Перу", "Питкэрн остров", "Польша", "Португалия", "Пуэрто Рико", "Республика Конго", "Реюньон", "Руанда", "Румыния", "США", "Сальвадор", "Самоа", "Сан-Марино", "Сан-Томе и Принсипи", "Саудовская Аравия", "Свазиленд", "Святая Люсия", "Северная Корея", "Сейшеллы", "Сен-Пьер и Микелон", "Сенегал", "Сент Китс и Невис", "Сент-Винсент и Гренадины", "Сербия", "Сингапур", "Сирия", "Словакия", "Словения", "Соломоновы острова", "Сомали", "Судан", "Суринам", "Сьерра-Леоне", "Таджикистан", "Таиланд", "Тайвань", "Танзания", "Того", "Токелау острова", "Тонга", "Тринидад и Тобаго", "Тувалу", "Тунис", "Туркменистан", "Туркс и Кейкос", "Турция", "Уганда", "Узбекистан", "Украина", "Уоллис и Футуна острова", "Уругвай", "Фарерские острова", "Фиджи", "Филиппины", "Финляндия", "Франция", "Французская Полинезия", "Хорватия", "Чад", "Черногория", "Чехия", "Чили", "Швейцария", "Швеция", "Шри-Ланка", "Эквадор", "Экваториальная Гвинея", "Эритрея", "Эстония", "Эфиопия", "ЮАР", "Южная Корея", "Южная Осетия", "Ямайка", "Япония",];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div id="container" class="container">
        <div class="header">
            <p class="c_id">Создание WEB ID</p>
            <p class="h_id">Уже есть WEB ID?</p>
            <a href="login.php"><p class="f_id">Найти его здесь ></p></a>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= isset($data["id"]) ? $data["id"] : ''?>">
            <input type="text" id="name" name="name" class="form-field name" placeholder="Имя" value="<?= isset($data["name"]) ? $data["name"] : ''?>" required="required">
            <input type="text" id="surname" name="surname" class="form-field surname" placeholder="Фамилия" value="<?= isset($data["surname"]) ? $data["surname"] : ''?>" required="required">
            <hr class="separator s1"/>
            <input type="text" id="born" name="born" class="form-field born" onfocus="toggleViewPass()" onblur="toggleViewPass()" placeholder="Дата рождения" value="<?= isset($data["born"]) ? $data["born"] : ''?>" required="required">
            <select class="form-field country" name="country" id="country" onselect="document.getElementById('country').innerHTML = "<?= isset($data["country"]) ? $data["country"] : ''?>";" required>
                <option value="">Страна</option>';
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo htmlspecialchars($country);?>" required><?php echo htmlspecialchars($country);?></option>';
                    <?php endforeach; ?>
            </select>
            <input type="email" id="email" name="email" class="form-field email" placeholder="example@mail.ru" value="<?= isset($data["email"]) ? $data["email"] : ''?>" required="required">
            <hr class="separator s2"/>
            <input type="password" id="password" name="password" class="form-field password" placeholder="Пароль" value="<?= isset($data["password"]) ? $data["password"] : ''?>" required="required">
            <input type="password" id="r_pass" name="r_pass" class="form-field r_pass" placeholder="Повторите пароль"  value="<?= isset($data["r_pass"]) ? $data["r_pass"] : ''?>" required="required">
            <input type="submit" id="btn_next" name="btn_next" class="form-field btn_next" value="Продолжить">
            <input type="button" id="btn_toggle" name="btn_toggle" class="form-field btn_toggle" value="Сменить тему">
            <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success rounded-0">
                    <?= $_SESSION['success_msg'] ?>
                </div>
            <?php unset($_SESSION['success_msg']); ?>
            <?php endif; ?>
            <?php if(isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger rounded-0">
                    <?= $_SESSION['error_msg'] ?>
                </div>
            <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>
        </form>
    </div>
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