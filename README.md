# TopCV Mini

Du an Laravel mo phong TopCV Mini theo tai lieu use case: ung vien tao CV va ung tuyen, nha tuyen dung quan ly cong ty/tin tuyen dung/ho so, admin quan ly du lieu nen tang.

## Tai khoan demo

Mat khau chung: `password`

| Vai tro | Email |
|---|---|
| Admin | `admin@topcv.test` |
| Ung vien | `candidate@topcv.test` |
| Nha tuyen dung | `employer@topcv.test` |

## Chay bang Docker Compose

Du an da cau hinh Laravel Sail qua `compose.yaml` de co cung moi truong PHP 8.3, MySQL 8.4 va Node trong container.

Lan dau clone ve, cai dependency bang Docker de khong phu thuoc PHP/Composer tren may:

```bash
cp .env.example .env
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan storage:link
```

Neu may da co PHP/Composer dung phien ban, co the thay lenh `docker run ... composer install` bang:

```bash
composer install
```

Mo ung dung tai:

```text
http://localhost:8000
```

Neu can build asset:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Dung container:

```bash
./vendor/bin/sail down
```

## Chay local khong Docker

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Neu khong dung Docker, ban can tu cai dung phien ban PHP theo `composer.json` va MySQL. Tao database roi doi `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=topcv_mini
DB_USERNAME=root
DB_PASSWORD=
```

Sau do chay:

```bash
php artisan migrate:fresh --seed
```

## Nghiep vu da chot

- Job cua employer tao xong hien thi ngay voi `status = active`.
- Moi employer chi quan ly mot cong ty, enforce bang unique `companies.user_id`.
- CV online luu chi tiet hoc van, kinh nghiem, ky nang, du an dang JSON array.
- Candidate khong duoc ung tuyen mot job hai lan, enforce bang unique `applications(job_id, user_id)`.
- Candidate khong duoc luu mot job hai lan, enforce bang unique `saved_jobs(user_id, job_id)`.

## Kiem tra

```bash
./vendor/bin/sail test
```
