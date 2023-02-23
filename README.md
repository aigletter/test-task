# Test project

Проект використовує розроблений мною пакет 
[aigletter/yii2-logging](https://github.com/aigletter/yii-logging).

Документацію по його конфігурації можна почитати у відповідному 
[README](https://github.com/aigletter/yii-logging/blob/master/README.mds)

### Запуск проекта

Репозиторій місти Dockerfile та файл docker-compose.yml.

Для запуску потрібно зібрати образи та запустити контейнери

Всі змінні середовища, необхідні для роботи додатка прописані в docker-compose.yml

Для зміни конфігурації потрібно лише розкоментувати відповідні рядки.

Приклади включаються 2 бази: clickhouse та db. Для зміни бази данних потрібно змінити змінну DB_CONNECTION .

Також є можливість читати змінні з файла .env. Для цього добавлений файл .env.dist

Питання і труднощі, котрі виникали в процессі роботи в окремому [файлі](https://github.com/aigletter/yii-logging/settings)