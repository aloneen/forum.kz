# Forum Project

This project is a forum developed in PHP and integrated with phpMyAdmin for database management. The project includes various features for managing users and content.

## Features

- **Registration**: Users can register on the forum.
- **Authentication**: Users can log in with their credentials.
- **Create Article**: Registered users can create new articles.
- **Edit Article**: Users can edit their articles.
- **Delete Article**: Users can delete their articles.
- **Comment on Article**: Users can leave comments on articles.
- **Create Avatars**: Users can upload and update their avatars.
- **Add Categories**: Users can add categories to their articles.

## Requirements

- PHP 7.4 or higher
- phpMyAdmin
- Web server (e.g., Apache or Nginx)
- MySQL

## Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/<your-github-username>/forum-project.git
    cd forum-project
    ```

2. **Configure the database connection**:
    - Update the `config.php` file with your database connection details.
    ```php
    <?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'your_password');
    define('DB_NAME', 'your_database_name');
    ?>
    ```

3. **Configure the web server**:
    - Configure your web server to use the `public` directory as the root directory of your site.

## Usage

1. Open your browser and go to your local server address (e.g., `http://localhost`).
2. Register and log in.
3. Use the interface to create, edit, delete, and comment on articles.






# Forum Project

Этот проект представляет собой форум, разработанный на PHP и интегрированный с phpMyAdmin для управления базой данных. Проект включает в себя различные функции для управления пользователями и контентом.

## Функционал

- **Регистрация**: Пользователи могут регистрироваться на форуме.
- **Авторизация**: Пользователи могут входить в систему с помощью своих учетных данных.
- **Создание статьи**: Зарегистрированные пользователи могут создавать новые статьи.
- **Редактирование статьи**: Пользователи могут редактировать свои статьи.
- **Удаление статьи**: Пользователи могут удалять свои статьи.
- **Комментирование статьи**: Пользователи могут оставлять комментарии к статьям.
- **Создание аватарок**: Пользователи могут загружать и обновлять свои аватарки.
- **Добавление категорий**: Пользователи могут добавлять категории к своим статьям.

## Требования

- PHP 7.4 или выше
- phpMyAdmin
- Веб-сервер (например, Apache или Nginx)
- MySQL

## Установка

1. **Клонируйте репозиторий**:
    ```sh
    git clone https://github.com/<ваше-имя-пользователя-на-github>/forum-project.git
    cd forum-project
    ```

2. **Настройте соединение с базой данных**:
    - Обновите файл `config.php` с вашими данными для подключения к базе данных.
    ```php
    <?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'ваш_пароль');
    define('DB_NAME', 'имя_вашей_базы_данных');
    ?>
    ```

3. **Настройте веб-сервер**:
    - Сконфигурируйте ваш веб-сервер для использования директории `public` в качестве корневой директории вашего сайта.

## Использование

1. Откройте браузер и перейдите по адресу вашего локального сервера (например, `http://localhost`).
2. Зарегистрируйтесь и войдите в систему.
3. Используйте интерфейс для создания, редактирования, удаления и комментирования статей.
 
