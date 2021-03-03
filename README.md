# carsharingDBMS
Список команды и роли:
1. Капралов ИВТ-365 (вторая подгруппа): 
2. Жабунин ИВТ-365 (вторая подгруппа): 
3. Добролюбов ИВТ-365 (первая подгруппа): 

Предметная область: Предметная область данного проекта — это прокат автомобилей (каршеринг). Точку зрения у нас со стороны клиента.
Каршеринг — это один из видов аренды автомобиля. В отличие от обычной аренды каршеринг предназначен для тех, кому нужна машина на очень непродолжительное время, при этом оплачивается только время пользования автомобилем, то есть сумма счета будет зависеть от того, как долго машина находилась у вас и сколько вы проехали. Получить доступ к автомобилю можно в любое время суток, а не только в рабочее время. Поскольку машины находятся на стоянках, разбросанных по всему городу, высока вероятность, что одна из них окажется в пешей доступности от вас.
Планируется создать мобильное приложение и сайт для бронирования авто. Клиенты смогут пользоваться услугами как на стационарном компьютере, так и с помощью смартфона.

Функциональные требования:
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

Список сущностей:
1. Cars:
* id — int
* name — char
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
3. Заказ:
* id — 

Реляционная схема:
![alt tag](https://sun9-52.userapi.com/impg/tD501D0oi0OACUAQdeval3IPzugMCXF33k0t9w/-BiA-aWP1s0.jpg?size=936x640&quality=96&sign=fbbe23c5c2016b6dad56cf827486f6f2&type=album)
