# TopCV Mini

Du an Laravel mo phong TopCV Mini theo tai lieu use case: ung vien tao CV va ung tuyen, nha tuyen dung quan ly cong ty/tin tuyen dung/ho so, admin quan ly du lieu nen tang.

## Tai khoan demo

Mat khau chung: `password`

| Vai tro | Email |
|---|---|
| Admin | `admin@topcv.test` |
| Ung vien | `candidate@topcv.test` |
| Nha tuyen dung | `employer@topcv.test` |

## Chay local nhanh

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Mac hien tai chua co MySQL CLI, nen `.env` dang de SQLite de demo duoc ngay. Neu dung MySQL, tao database roi doi `.env`:

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
php artisan test
```
