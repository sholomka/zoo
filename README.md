# Проект ZOO

Этот проект представляет собой веб-приложение для расчета стоимости доставки с использованием различных перевозчиков. Он построен с использованием PHP (Symfony) для бэкенда и Vue.js для фронтенда, все контейнеризировано с использованием Docker.

## Установка и запуск проекта

Следуйте этим шагам, чтобы установить и запустить проект на вашем локальном компьютере.

### Предварительные требования

- Установленный Docker
- Установленный Docker Compose

### Клонирование репозитория

Клонируйте репозиторий с помощью следующей команды:

```bash
git clone https://github.com/sholomka/zoo.git
```

### Запуск проекта

Запустите проект с помощью Docker Compose:

```bash
docker-compose up --build
```

## Доступ к приложению
После успешного запуска контейнеров, откройте ваш веб-браузер и перейдите по адресу:

```bash
http://localhost
```

На этом адресе будет доступно ваше веб-приложение.


## Структура проекта

- `src/`
    - `Carrier/`
        - `Entity/`
            - `PackGroup.php` - Реализация перевозчика PackGroup.
            - `TransCompany.php` - Реализация перевозчика TransCompany.
        - `Factory/`
            - `CarrierFactory.php` - Фабрика для создания объектов перевозчиков.
            - `CarrierFactoryInterface.php` - Интерфейс для фабрики перевозчиков.
        - `Model/`
            - `CarrierInterface.php` - Интерфейс для всех перевозчиков.
            - `DeliveryCostRequestDto.php` - DTO для запроса расчета стоимости доставки.
        - `Service/`
            - `DeliveryCostCalculator.php` - Сервис для расчета стоимости доставки.
            - `DeliveryCostCalculatorInterface.php` - Интерфейс для сервиса расчета стоимости доставки.
    - `Controller/`
        - `DeliveryController.php` - Контроллер для обработки запросов на расчет стоимости доставки.
- `tests/`
    - `Carrier/`
        - `Service/`
            - `DeliveryCostCalculatorTest.php` - Тесты для сервиса расчета стоимости доставки.


## Тестирование
Для запуска тестов используйте следующую команду:

```bash
vendor/bin/phpunit
```