# Mello test work
Необходимо создать проект на Laravel (REST API), только Backend! Предметная область для данных на Ваше усмотрение. Особенности реализации:

1. Проект содержит базу данных из двух таблиц со связью многие ко многим;
2. Работа с базой должна осуществляться через паттерн репозиторий;
3. Необходимо реализовать простую аутентификацию через ключ (не используя доп. пакеты passport, jwt etc.);
4. API должно предоставлять доступ к данным с возможностью сортировки и поиску по нескольким полям;
5. В процессе работы с данными необходимо использовать атрибут pivot для моделей и включить его в запросы по поиску.

В качестве результата ссылка на GitLab/GitHub/Bitbucket на выбор, сам репозиторий назвать 618230

А также Postman-коллекция, README с описанием и необходимыми действиями для развертывания проекта.

### Git repository

> git clone **https://github.com/AkimSH/618230.git**

### Docker

> For deploying the project run **init.bat** file


### Postman

> Postman collection https://www.getpostman.com/collections/c94bdf463c0fa2b85a35
> When registering **/api/register** in reply You will find API_TOKEN which You can use as bearer token type
> After log out API_TOKEN will be cleared
> To renew the API_TOKEN visit **/api/login**



