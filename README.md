# Cписок команды и роли:
1. Капралов ИВТ-365 (вторая подгруппа): Работа с базами данных
2. Жабунин ИВТ-365 (вторая подгруппа): Работа с веб приложением
3. Добролюбов ИВТ-365 (первая подгруппа): Работа с настольным приложением

# Предметная область: Предметная область данного проекта — это прокат автомобилей (каршеринг). Точку зрения у нас со стороны клиента.
Каршеринг — это один из видов аренды автомобиля. В отличие от обычной аренды каршеринг предназначен для тех, кому нужна машина на очень непродолжительное время, при этом оплачивается только время пользования автомобилем, то есть сумма счета будет зависеть от того, как долго машина находилась у вас и сколько вы проехали. Получить доступ к автомобилю можно в любое время суток, а не только в рабочее время. Поскольку машины находятся на стоянках, разбросанных по всему городу, высока вероятность, что одна из них окажется в пешей доступности от вас.
Планируется создать настольное приложение для редактирования базы данных и сайт для бронирования авто клиентами.

# Используемые базы данных: NoSQL, SQLite, MongDB
Все три базы данных имеют одинаковый набор таблиц, но отличные данные. Пользователь сможет в любой момент переключиться с одной базы данных на другую.

# Функциональные требования:
1. Транзакционные:
* Добавить новый автомобиль.
* Изменить данные клиента.
* Удалить заказ.
* Добавить новый бренд.
* Изменить уровень топлива у автомобиля.
* Добавить новый цвет.
* Назначить заказу дату проката и время.
* Изменить рейтинг клиента.
* Добавление метки "забронировано".
2. Оперативные:
* Вывести все автомобили с автоматической коробкой передач.
* Вывести все машины с полным приводом.
* Вывести автомобиль с уровнем топлива больше 20%.
* Вывести все Kia.
* Вывести ярко-красные машины.
3. Аналитические:
* Высчитывание стоимости тарифа на основании рейтинга клиента.
* Высчитать процент количества автомобилей с автоматической кпп.
* Рассчитать количество синих Kia.

# Список сущностей:
1. Автомобили:
* id — int
* Название — char
* GPS координаты — char
* Номер — char
* Уровень топлива — int
* Кол-во передач — int
2. Клиенты:
* id — int
* Имя — char
* Фамилия — char
* Отчество — char
* Номер телефона — int
* Паспортные данные — char
* Фото с паспортом — char (ссылка на файл на сервере)
* Номер водительских прав — int
* Рейтинг — int
3. Заказы:
* id — int
* GPS координаты вызова — char
* Дата проката и время — date
4. Заказы:
* id — int
* Название — char
5. Тарифы:
* id — int
* Название — char
* Стоимость тарифа — date
6. Приводы:
* id — int
* Название — char
7. Бренды:
* id — int
* Название — char
8. Типы трансмиссии:
* id — int
* Название — char
9. Цвета:
* id — int
* Название — char

# Связи:
* Автомобили - один ко многим - Цвета
* Автомобили - один ко многим - Типы трансмиссии
* Автомобили - один ко многим - Бренды
* Автомобили - один ко многим - Приводы
* Автомобили - один ко многим - Тарифы
* Заказы - один ко многим - Тарифы
* Заказы - один ко многим - Города
* Заказы - один ко многим - Клиенты

# Реляционная схема:
Учёт автомобилей:
![alt tag](https://sun9-30.userapi.com/impg/8yA_ahn7WiMWbU0qy9lskfjcpXsv5QBHI6cySw/SBT2chP8G3A.jpg?size=1437x649&quality=96&sign=4ced54730ab013ddaf57afcd6a3bf5de&type=album)
# UML Use-Case диаграмма: 
![alt tag](https://sun9-20.userapi.com/impg/xSm6JcvnS8Khi4089h4X_FRRedFUsE08giTtSQ/Rpb5QyqvnBc.jpg?size=483x542&quality=96&sign=00ddf7ba4b5795e06b81b7092721460c&type=album)
