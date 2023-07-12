Для работы нужно создать файл .env с переменными для отправки почты и подключения к базе данных

SMTP_PORT=465

SMTP_PASSWORD='*****'

SMTP_USERNAME='адрес почты'

SMTP_HOST='хост'

DB_HOST='database'

DB_NAME='feedback'

DB_USER='root'

DB_PASSWORD=''

и cоздать таблицу feedback с полями id,name,phone,email,message 

Выполнить команду composer install

Версия php не ниже 7.4

