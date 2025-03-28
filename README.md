# Laravel Leaderboard API
![Leaderboard](public/screenshots/leaderboard1.png)
![Leaderboard](public/screenshots/leaderboard2.png)
![Leaderboard](public/screenshots/leaderboard3.png)

## Project Overview
This is a Laravel-based leaderboard API that allows users to be added, assigned points, and displayed on a leaderboard. The system includes QR code generation for each user and an automated winner selection process.

## Installation Instructions

### Step 1: Clone the Repository
```sh
git clone git@github.com:echobash/leaderboard-api.git
cd leaderboard-api
```

### Step 2: Install Dependencies
```sh
composer install
npm install
```

### Step 3: Set Up Environment
1. Copy the `.env.example` file to `.env`:
```sh
cp .env.example .env
```
2. Configure database credentials in the `.env` file.

### Step 4: Run Migrations and Seed Database
```sh
php artisan migrate --seed
```

### Step 5: Link Storage for QR Codes
```sh
php artisan storage:link
```

### Step 6: Start the Application
```sh
php artisan serve
```
Your API will be available at `http://127.0.0.1:8000/`

---

## API Endpoints Documentation

### 1. Get Users Grouped by Score
**Endpoint:** `GET /api/users/grouped-by-score`

Returns users grouped by points with average age.

Example Response:
```json
{
  "24": {
"names": [
"Echobash",
"Anwar"
],
"average_age":35
},
  "18": {
    "names": ["Noah"],
    "average_age": 17
  }
}
```

---

## QR Code Generation
QR codes are generated using the [goqr.me API](https://goqr.me/api/) and stored in `storage/app/public/qrcodes/`.

Run the following command to link storage:
```sh
php artisan storage:link
```

---

## Unit Testing
To run unit tests:
```sh
php artisan test
```

Example Test Case (tests/Feature/UserTest.php):
```php
public function test_can_create_user() {
    $response = $this->post('/users', ['name' => 'Echobash', 'age' => 29, 'address' => 'Gurgao']);
    $response->assertStatus(302);
}
```

---

## Cron Job for Winners
### Scheduled Job
A scheduled job runs every 5 minutes to declare a winner.

### Winner Selection Logic
1. Identifies the user with the highest points.
2. Stores a record in the `winners` table if there is a single highest scorer.
3. The leaderboard will highlight the winner at the top.

To run the scheduler:
```sh
php artisan schedule:work
