# Game Gallery App

Цей проєкт — веб-застосунок для управління галереєю ігор, створений на Laravel + Vue.js.

## Вимоги
- Docker та Docker Compose
- API-ключ для RWAG (необхідний для сидерів)

## Налаштування

1. **Клонувати репозиторій:**
   ```sh
   git clone https://github.com/your-repo/game-gallery.git
   cd game-gallery
   ```

2. **Створити `.env` файл:**
   ```sh
   cp .env.example .env
   ```
   В `.env` потрібно вказати `RWAG_API_KEY=your_api_key_here`

3. **Запустити Docker-контейнери:**
   ```sh
   docker-compose up -d
   ```

4. **Встановити залежності:**
   ```sh
    composer install
    npm install
   ```

5. **Згенерувати ключ застосунку:**
   ```sh
    php artisan key:generate
   ```

6. **Запустити міграції та сидери:**
   ```sh
    php artisan migrate --seed
   ```

## Запуск
### Для запуску додатку
```sh
    composer run dev
```
Застосунок буде доступний за посиланням в командній строці

## Деплой
Для продакшн-запуску використовуйте відповідні налаштування в `.env` та серверні конфігурації.


