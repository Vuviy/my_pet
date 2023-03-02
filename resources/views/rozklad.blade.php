<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Розклад</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

{{--<div class="container mt-5">--}}
{{--    <form action="process-form.php" method="POST" class="bg-dark text-light p-4 rounded mx-auto" style="width: 50%;">--}}
{{--        <div class="mb-3">--}}
{{--            <label for="name" class="form-label">Ім'я:</label>--}}
{{--            <input type="text" id="name" name="name" class="form-control" required>--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="email" class="form-label">Email:</label>--}}
{{--            <input type="email" id="email" name="email" class="form-control" required>--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="subject" class="form-label">Тема:</label>--}}
{{--            <input type="text" id="subject" name="subject" class="form-control" required>--}}
{{--        </div>--}}

{{--        <div class="mb-3">--}}
{{--            <label for="message" class="form-label">Повідомлення:</label>--}}
{{--            <textarea id="message" name="message" class="form-control" required></textarea>--}}
{{--        </div>--}}

{{--        <button type="submit" class="btn btn-primary">Надіслати</button>--}}
{{--    </form>--}}
{{--</div>--}}

{{--@php--}}

{{--    function factorial($n) {--}}
{{--      if ($n <= 1) { // базовий випадок--}}
{{--        return 1;--}}
{{--      } else { // рекурсивний випадок--}}
{{--        return $n * factorial($n - 1);--}}
{{--      }--}}
{{--    }--}}

{{--    echo factorial(5); // виведе 120--}}

{{--@endphp--}}

<div class="container">
    <h1 class="text-center my-4">Розклад на день</h1>
    <div class="row">
        <div class="col-md-4">
            <h4 class="text-center">Ранкова рутина</h4>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td>7:00 - 8:00</td>
                    <td>Прокидання, сніданок</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h4 class="text-center">Робочий день</h4>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td>8:00 - 10:00</td>
                    <td>Поставка цілей на день</td>
                </tr>
                <tr>
                    <td>10:00 - 10:20</td>
                    <td>Перерва</td>
                </tr>
                <tr>
                    <td>10:20 - 12:20</td>
                    <td>Програмування</td>
                </tr>
                <tr>
                    <td>12:20 - 13:20</td>
                    <td>Обід</td>
                </tr>
                <tr>
                    <td>13:20 - 15:20</td>
                    <td>Програмування</td>
                </tr>
                <tr>
                    <td>15:20 - 15:40</td>
                    <td>Перерва</td>
                </tr>
                <tr>
                    <td>15:40 - 17:40</td>
                    <td>Програмування</td>
                </tr>
                <tr>
                    <td>17:40 - 18:40</td>
                    <td>Вечеря</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h4 class="text-center">Вечірня рутина</h4>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td>18:40 - 20:40</td>
                    <td>Розваги/відпочинок</td>
                </tr>
                <tr>
                    <td>20:40 - 21:40</td>
                    <td>Саморозвиток/читання</td>
                </tr>
                <tr>
                    <td>21:40 - 22:40</td>
                    <td>Гігієна, підготовка до сну</td>
                </tr>
                <tr>
                    <td>22:40 - </td>
                    <td>Сон</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


{{--<div class="container">--}}
{{--    <h1>Зарплати у різних країнах</h1>--}}
{{--    <table class="table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Країна</th>--}}
{{--            <th>Професія</th>--}}
{{--            <th>Зарплата</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>Україна</td>--}}
{{--            <td>Програміст</td>--}}
{{--            <td>1 000 $</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>США</td>--}}
{{--            <td>Програміст</td>--}}
{{--            <td>5 000 $</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>Індія</td>--}}
{{--            <td>Програміст</td>--}}
{{--            <td>500 $</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}


<script>
    // отримуємо елементи таблиці за допомогою класів Bootstrap
    const tableRows = document.querySelectorAll(".table-striped tbody tr");

    // цикл для перевірки кожного рядка таблиці
    for (let i = 0; i < tableRows.length; i++) {
        const time = tableRows[i].querySelector("td:first-child").innerText; // отримуємо час рядка таблиці
        const now = new Date();
        const [hours, minutes] = time.split(" - ")[0].split(":");
        const [hours2, minutes2] = time.split(" - ")[1].split(":");
        const startTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);
        const endTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours2, minutes2);
        // const endTime = new Date(`January 1, 2022 ${time.split(" - ")[1]}:00`); // перетворюємо час у об'єкт Date

        // перевіряємо, чи поточний час знаходиться між початковим та кінцевим часом рядка таблиці
        if (now >= startTime && now < endTime) {
            tableRows[i].classList.add("table-info"); // додаємо клас, який підсвічує поточний рядок таблиці
        }
        // перевіряємо, чи поточний час знаходиться між початковим та кінцевим часом рядка таблиці
        if (now > endTime) {
            tableRows[i].classList.add("table-success"); // додаємо клас, який підсвічує поточний рядок таблиці
        }
    }







</script>

{{--<script>--}}
{{--    // отримуємо елементи таблиці за допомогою класів Bootstrap--}}
{{--    const tableRows = document.querySelectorAll(".table-striped tbody tr");--}}

{{--    // console.log(tableRows);--}}
{{--    // цикл для перевірки кожного рядка таблиці--}}
{{--    for (let i = 0; i < tableRows.length; i++) {--}}
{{--        const time = tableRows[i].querySelector("td:first-child").innerText; // отримуємо час рядка таблиці--}}


{{--        const startTime = new Date(`February 24, 2023 ${time.split(" - ")[0]}:00`); // перетворюємо час у об'єкт Date--}}
{{--        const endTime = new Date(`February 24, 2023 ${time.split(" - ")[1]}:00`); // перетворюємо час у об'єкт Date--}}
{{--        const now = new Date(); // отримуємо поточний час--}}

{{--        // перевіряємо, чи поточний час знаходиться між початковим та кінцевим часом рядка таблиці--}}
{{--        if (now >= startTime && now < endTime) {--}}
{{--            tableRows[i].classList.add("table-info"); // додаємо клас, який підсвічує поточний рядок таблиці--}}
{{--        }--}}
{{--    }--}}

{{--</script>--}}


</body>
</html>

