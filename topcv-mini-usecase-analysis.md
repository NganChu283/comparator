# Phân tích Actor, Use Case và Luồng thực thi hệ thống TopCV Mini

## 1. Giới thiệu hệ thống

Hệ thống được xây dựng theo mô hình tương tự TopCV ở phạm vi bài tập lớn Laravel. Mục tiêu của hệ thống là hỗ trợ:

- Ứng viên tạo hồ sơ/CV và ứng tuyển việc làm.
- Nhà tuyển dụng đăng tin tuyển dụng và quản lý ứng viên.
- Quản trị viên quản lý toàn bộ dữ liệu nền tảng.

Hệ thống có 3 nhóm người dùng chính:

1. Ứng viên
2. Nhà tuyển dụng
3. Quản trị viên

Ngoài ra còn có các actor phụ như khách vãng lai và hệ thống gửi thông báo/email.

---

# 2. Danh sách Actor

## 2.1. Khách vãng lai

### Mô tả

Khách vãng lai là người chưa đăng nhập vào hệ thống. Họ có thể truy cập các trang công khai như danh sách việc làm, chi tiết việc làm, danh sách công ty, đăng ký và đăng nhập.

### Mục tiêu

- Tìm hiểu các việc làm đang được đăng.
- Xem thông tin công ty.
- Đăng ký tài khoản ứng viên hoặc nhà tuyển dụng.
- Đăng nhập vào hệ thống.

### Quyền hạn

- Xem danh sách việc làm.
- Xem chi tiết việc làm.
- Xem danh sách công ty.
- Xem chi tiết công ty.
- Đăng ký tài khoản.
- Đăng nhập.

### Hạn chế

- Không được ứng tuyển nếu chưa đăng nhập.
- Không được tạo CV nếu chưa đăng nhập.
- Không được đăng tin tuyển dụng nếu chưa đăng nhập với vai trò nhà tuyển dụng.
- Không được truy cập dashboard nội bộ.

---

## 2.2. Ứng viên

### Mô tả

Ứng viên là người có nhu cầu tìm việc, tạo CV và ứng tuyển vào các tin tuyển dụng.

### Mục tiêu

- Tạo và quản lý CV.
- Tìm kiếm việc làm phù hợp.
- Ứng tuyển vào việc làm.
- Theo dõi trạng thái ứng tuyển.
- Lưu việc làm yêu thích.

### Quyền hạn

- Quản lý thông tin cá nhân.
- Tạo, sửa, xóa CV.
- Upload CV PDF.
- Xem danh sách việc làm.
- Tìm kiếm/lọc việc làm.
- Ứng tuyển việc làm.
- Xem lịch sử ứng tuyển.
- Lưu/bỏ lưu việc làm.
- Xem trạng thái hồ sơ ứng tuyển.

### Hạn chế

- Không được đăng tin tuyển dụng.
- Không được xem danh sách ứng viên của nhà tuyển dụng khác.
- Không được quản trị người dùng, công ty, ngành nghề.
- Không được sửa trạng thái ứng tuyển do nhà tuyển dụng quản lý.

---

## 2.3. Nhà tuyển dụng

### Mô tả

Nhà tuyển dụng là người đại diện công ty sử dụng hệ thống để đăng tin tuyển dụng, quản lý công ty và theo dõi hồ sơ ứng viên.

### Mục tiêu

- Tạo và quản lý thông tin công ty.
- Đăng tin tuyển dụng.
- Quản lý danh sách ứng viên đã ứng tuyển.
- Xem CV ứng viên.
- Cập nhật trạng thái ứng tuyển.

### Quyền hạn

- Quản lý hồ sơ công ty của mình.
- Tạo, sửa, xóa hoặc ẩn tin tuyển dụng.
- Xem danh sách ứng viên ứng tuyển vào các job thuộc công ty mình.
- Xem CV ứng viên.
- Cập nhật trạng thái ứng tuyển.
- Xem thống kê cơ bản: số job, số lượt ứng tuyển, số ứng viên phù hợp.

### Hạn chế

- Không được sửa công ty của nhà tuyển dụng khác.
- Không được sửa job không thuộc công ty mình.
- Không được xem CV của ứng viên nếu ứng viên chưa ứng tuyển vào job của mình.
- Không được quản lý tài khoản toàn hệ thống.

---

## 2.4. Quản trị viên

### Mô tả

Quản trị viên là người có quyền cao nhất trong hệ thống, chịu trách nhiệm quản lý dữ liệu, kiểm duyệt nội dung và theo dõi hoạt động tổng thể.

### Mục tiêu

- Quản lý người dùng.
- Quản lý công ty.
- Quản lý tin tuyển dụng.
- Quản lý danh mục ngành nghề.
- Theo dõi thống kê hệ thống.
- Khóa/mở tài khoản vi phạm.

### Quyền hạn

- Xem danh sách toàn bộ người dùng.
- Khóa/mở tài khoản.
- Xem, duyệt, ẩn hoặc xóa tin tuyển dụng.
- Quản lý ngành nghề.
- Quản lý địa điểm.
- Xem thống kê tổng quan.
- Quản lý trạng thái công ty/nhà tuyển dụng.

### Hạn chế

- Không trực tiếp ứng tuyển như ứng viên.
- Không nên tự ý chỉnh sửa CV cá nhân của ứng viên nếu không có yêu cầu nghiệp vụ rõ ràng.

---

## 2.5. Hệ thống Email/Thông báo

### Mô tả

Đây là actor phụ, không phải người dùng trực tiếp. Hệ thống gửi email hoặc thông báo khi có các sự kiện quan trọng.

### Nhiệm vụ

- Gửi email xác thực tài khoản.
- Gửi thông báo khi ứng viên ứng tuyển thành công.
- Gửi thông báo cho nhà tuyển dụng khi có ứng viên mới.
- Gửi thông báo khi trạng thái ứng tuyển thay đổi.

---

# 3. Danh sách Use Case tổng quát

## 3.1. Use case của Khách vãng lai

| Mã use case | Tên use case |
|---|---|
| UC-GUEST-01 | Xem trang chủ |
| UC-GUEST-02 | Xem danh sách việc làm |
| UC-GUEST-03 | Xem chi tiết việc làm |
| UC-GUEST-04 | Tìm kiếm/lọc việc làm |
| UC-GUEST-05 | Xem danh sách công ty |
| UC-GUEST-06 | Xem chi tiết công ty |
| UC-GUEST-07 | Đăng ký tài khoản |
| UC-GUEST-08 | Đăng nhập 1 |

---

## 3.2. Use case của Ứng viên

| Mã use case | Tên use case |
|---|---|
| UC-CAND-01 | Quản lý hồ sơ cá nhân |
| UC-CAND-02 | Tạo CV online |
| UC-CAND-03 | Cập nhật CV |
| UC-CAND-04 | Xóa CV |
| UC-CAND-05 | Upload CV PDF |
| UC-CAND-06 | Xem danh sách việc làm |
| UC-CAND-07 | Tìm kiếm/lọc việc làm |
| UC-CAND-08 | Xem chi tiết việc làm |
| UC-CAND-09 | Ứng tuyển việc làm |
| UC-CAND-10 | Xem lịch sử ứng tuyển |
| UC-CAND-11 | Lưu việc làm yêu thích |
| UC-CAND-12 | Bỏ lưu việc làm |
| UC-CAND-13 | Xem trạng thái ứng tuyển |

---

## 3.3. Use case của Nhà tuyển dụng

| Mã use case | Tên use case |
|---|---|
| UC-EMP-01 | Quản lý thông tin công ty |
| UC-EMP-02 | Tạo tin tuyển dụng |
| UC-EMP-03 | Cập nhật tin tuyển dụng |
| UC-EMP-04 | Xóa/ẩn tin tuyển dụng |
| UC-EMP-05 | Xem danh sách tin đã đăng |
| UC-EMP-06 | Xem danh sách ứng viên ứng tuyển |
| UC-EMP-07 | Xem chi tiết CV ứng viên |
| UC-EMP-08 | Cập nhật trạng thái ứng tuyển |
| UC-EMP-09 | Xem thống kê tuyển dụng |

---

## 3.4. Use case của Quản trị viên

| Mã use case | Tên use case |
|---|---|
| UC-ADMIN-01 | Quản lý người dùng |
| UC-ADMIN-02 | Khóa/mở tài khoản |
| UC-ADMIN-03 | Quản lý công ty |
| UC-ADMIN-04 | Duyệt công ty |
| UC-ADMIN-05 | Quản lý tin tuyển dụng |
| UC-ADMIN-06 | Duyệt/ẩn tin tuyển dụng |
| UC-ADMIN-07 | Quản lý ngành nghề |
| UC-ADMIN-08 | Quản lý địa điểm |
| UC-ADMIN-09 | Xem thống kê hệ thống |

---

# 4. Đặc tả Use Case chi tiết

---

## UC-GUEST-07: Đăng ký tài khoản

### Actor chính

Khách vãng lai

### Mục tiêu

Người dùng tạo tài khoản mới để sử dụng hệ thống.

### Tiền điều kiện

- Người dùng chưa đăng nhập.
- Email đăng ký chưa tồn tại trong hệ thống.

### Hậu điều kiện

- Tài khoản mới được tạo.
- Người dùng có thể đăng nhập.
- Tài khoản được gán vai trò tương ứng: ứng viên hoặc nhà tuyển dụng.

### Luồng chính

1. Người dùng truy cập trang đăng ký.
2. Hệ thống hiển thị form đăng ký.
3. Người dùng nhập họ tên, email, mật khẩu, xác nhận mật khẩu.
4. Người dùng chọn vai trò: ứng viên hoặc nhà tuyển dụng.
5. Người dùng nhấn nút đăng ký.
6. Hệ thống kiểm tra dữ liệu đầu vào.
7. Hệ thống kiểm tra email đã tồn tại chưa.
8. Nếu hợp lệ, hệ thống mã hóa mật khẩu.
9. Hệ thống tạo bản ghi trong bảng `users`.
10. Hệ thống chuyển người dùng đến trang đăng nhập hoặc tự động đăng nhập.
11. Hệ thống hiển thị thông báo đăng ký thành công.

### Luồng thay thế

#### A1: Email đã tồn tại

1. Hệ thống phát hiện email đã tồn tại.
2. Hệ thống không tạo tài khoản.
3. Hệ thống hiển thị lỗi: "Email đã được sử dụng."

#### A2: Mật khẩu xác nhận không khớp

1. Hệ thống kiểm tra mật khẩu và xác nhận mật khẩu.
2. Nếu không khớp, hệ thống hiển thị lỗi.
3. Người dùng nhập lại thông tin.

#### A3: Thiếu dữ liệu bắt buộc

1. Hệ thống kiểm tra các trường bắt buộc.
2. Nếu thiếu dữ liệu, hệ thống hiển thị lỗi tương ứng.

### Dữ liệu liên quan

- `users.name`
- `users.email`
- `users.password`
- `users.role`
- `users.status`

---

## UC-GUEST-08: Đăng nhập

### Actor chính

Khách vãng lai

### Mục tiêu

Người dùng đăng nhập vào hệ thống để sử dụng chức năng theo vai trò.

### Tiền điều kiện

- Người dùng đã có tài khoản.
- Tài khoản chưa bị khóa.

### Hậu điều kiện

- Người dùng được xác thực.
- Hệ thống tạo session đăng nhập.
- Người dùng được điều hướng đến dashboard phù hợp.

### Luồng chính

1. Người dùng truy cập trang đăng nhập.
2. Hệ thống hiển thị form đăng nhập.
3. Người dùng nhập email và mật khẩu.
4. Người dùng nhấn đăng nhập.
5. Hệ thống kiểm tra email có tồn tại không.
6. Hệ thống kiểm tra mật khẩu.
7. Hệ thống kiểm tra trạng thái tài khoản.
8. Nếu hợp lệ, hệ thống tạo session.
9. Hệ thống kiểm tra vai trò người dùng.
10. Nếu là ứng viên, chuyển đến dashboard ứng viên.
11. Nếu là nhà tuyển dụng, chuyển đến dashboard nhà tuyển dụng.
12. Nếu là admin, chuyển đến dashboard admin.

### Luồng thay thế

#### A1: Sai email hoặc mật khẩu

1. Hệ thống xác thực thất bại.
2. Hệ thống hiển thị thông báo: "Thông tin đăng nhập không chính xác."

#### A2: Tài khoản bị khóa

1. Hệ thống phát hiện `status = blocked`.
2. Hệ thống từ chối đăng nhập.
3. Hệ thống hiển thị thông báo: "Tài khoản của bạn đã bị khóa."

### Dữ liệu liên quan

- `users.email`
- `users.password`
- `users.role`
- `users.status`

---

## UC-CAND-02: Tạo CV online

### Actor chính

Ứng viên

### Mục tiêu

Ứng viên tạo CV trực tuyến bằng cách nhập thông tin cá nhân, học vấn, kinh nghiệm, kỹ năng và dự án.

### Tiền điều kiện

- Ứng viên đã đăng nhập.
- Người dùng có vai trò `candidate`.

### Hậu điều kiện

- CV mới được lưu trong hệ thống.
- Ứng viên có thể dùng CV này để ứng tuyển.

### Luồng chính

1. Ứng viên vào trang quản lý CV.
2. Hệ thống hiển thị danh sách CV hiện có.
3. Ứng viên chọn "Tạo CV mới".
4. Hệ thống hiển thị form tạo CV.
5. Ứng viên nhập tiêu đề CV.
6. Ứng viên nhập thông tin cá nhân: họ tên, email, số điện thoại, địa chỉ.
7. Ứng viên nhập mục tiêu nghề nghiệp.
8. Ứng viên nhập học vấn.
9. Ứng viên nhập kinh nghiệm làm việc.
10. Ứng viên nhập kỹ năng.
11. Ứng viên nhập dự án cá nhân nếu có.
12. Ứng viên nhấn lưu.
13. Hệ thống kiểm tra dữ liệu.
14. Hệ thống tạo bản ghi trong bảng `cvs`.
15. Hệ thống hiển thị thông báo tạo CV thành công.

### Luồng thay thế

#### A1: Thiếu thông tin bắt buộc

1. Hệ thống kiểm tra các trường bắt buộc như tiêu đề, họ tên, email.
2. Nếu thiếu, hệ thống hiển thị lỗi.
3. Ứng viên bổ sung thông tin và lưu lại.

#### A2: Email không đúng định dạng

1. Hệ thống kiểm tra định dạng email trong CV.
2. Nếu sai, hệ thống hiển thị lỗi.

### Dữ liệu liên quan

- `cvs.user_id`
- `cvs.title`
- `cvs.full_name`
- `cvs.email`
- `cvs.phone`
- `cvs.address`
- `cvs.objective`
- `cvs.education`
- `cvs.experience`
- `cvs.skills`
- `cvs.projects`

---

## UC-CAND-05: Upload CV PDF

### Actor chính

Ứng viên

### Mục tiêu

Ứng viên tải lên file CV có sẵn dạng PDF.

### Tiền điều kiện

- Ứng viên đã đăng nhập.
- File upload đúng định dạng được hệ thống cho phép.

### Hậu điều kiện

- File CV được lưu vào storage.
- Đường dẫn file được lưu trong database.

### Luồng chính

1. Ứng viên vào trang quản lý CV.
2. Ứng viên chọn upload CV.
3. Hệ thống hiển thị form upload.
4. Ứng viên chọn file PDF từ máy tính.
5. Ứng viên nhập tên CV.
6. Ứng viên nhấn upload.
7. Hệ thống kiểm tra định dạng file.
8. Hệ thống kiểm tra dung lượng file.
9. Hệ thống lưu file vào thư mục storage.
10. Hệ thống tạo bản ghi CV trong bảng `cvs`.
11. Hệ thống hiển thị thông báo upload thành công.

### Luồng thay thế

#### A1: File không phải PDF

1. Hệ thống phát hiện file sai định dạng.
2. Hệ thống từ chối upload.
3. Hệ thống hiển thị lỗi: "Chỉ cho phép upload file PDF."

#### A2: File vượt quá dung lượng

1. Hệ thống phát hiện file vượt quá dung lượng cho phép.
2. Hệ thống từ chối upload.
3. Hệ thống hiển thị lỗi.

### Dữ liệu liên quan

- `cvs.user_id`
- `cvs.title`
- `cvs.file_path`

---

## UC-CAND-09: Ứng tuyển việc làm

### Actor chính

Ứng viên

### Mục tiêu

Ứng viên gửi CV để ứng tuyển vào một tin tuyển dụng.

### Tiền điều kiện

- Ứng viên đã đăng nhập.
- Ứng viên có ít nhất một CV.
- Tin tuyển dụng đang hoạt động.
- Ứng viên chưa ứng tuyển job này trước đó.

### Hậu điều kiện

- Một bản ghi ứng tuyển được tạo.
- Nhà tuyển dụng có thể xem hồ sơ ứng tuyển.
- Trạng thái ứng tuyển mặc định là `pending`.

### Luồng chính

1. Ứng viên xem danh sách việc làm.
2. Ứng viên chọn một việc làm.
3. Hệ thống hiển thị chi tiết việc làm.
4. Ứng viên nhấn "Ứng tuyển".
5. Hệ thống kiểm tra trạng thái đăng nhập.
6. Hệ thống kiểm tra vai trò người dùng.
7. Hệ thống hiển thị danh sách CV của ứng viên.
8. Ứng viên chọn CV muốn dùng để ứng tuyển.
9. Ứng viên nhập thư giới thiệu nếu có.
10. Ứng viên nhấn xác nhận ứng tuyển.
11. Hệ thống kiểm tra job còn hạn hay không.
12. Hệ thống kiểm tra ứng viên đã ứng tuyển job này chưa.
13. Nếu hợp lệ, hệ thống tạo bản ghi trong bảng `applications`.
14. Hệ thống gửi thông báo cho nhà tuyển dụng.
15. Hệ thống hiển thị thông báo ứng tuyển thành công.

### Luồng thay thế

#### A1: Chưa đăng nhập

1. Người dùng nhấn "Ứng tuyển".
2. Hệ thống phát hiện chưa đăng nhập.
3. Hệ thống chuyển người dùng đến trang đăng nhập.

#### A2: Người dùng không phải ứng viên

1. Hệ thống kiểm tra vai trò.
2. Nếu vai trò không phải `candidate`, hệ thống từ chối.
3. Hệ thống hiển thị thông báo: "Chỉ ứng viên mới có thể ứng tuyển."

#### A3: Ứng viên chưa có CV

1. Hệ thống kiểm tra danh sách CV.
2. Nếu chưa có CV, hệ thống yêu cầu tạo hoặc upload CV trước.

#### A4: Đã ứng tuyển trước đó

1. Hệ thống kiểm tra bảng `applications`.
2. Nếu đã tồn tại bản ghi `job_id` và `user_id`, hệ thống không tạo mới.
3. Hệ thống hiển thị thông báo: "Bạn đã ứng tuyển công việc này."

#### A5: Job đã hết hạn

1. Hệ thống kiểm tra deadline.
2. Nếu job đã hết hạn, hệ thống từ chối ứng tuyển.
3. Hệ thống hiển thị thông báo: "Tin tuyển dụng đã hết hạn."

### Dữ liệu liên quan

- `applications.job_id`
- `applications.user_id`
- `applications.cv_id`
- `applications.cover_letter`
- `applications.status`

---

## UC-CAND-10: Xem lịch sử ứng tuyển

### Actor chính

Ứng viên

### Mục tiêu

Ứng viên xem lại các công việc đã ứng tuyển và trạng thái xử lý.

### Tiền điều kiện

- Ứng viên đã đăng nhập.

### Hậu điều kiện

- Ứng viên biết được trạng thái các hồ sơ đã gửi.

### Luồng chính

1. Ứng viên vào dashboard cá nhân.
2. Ứng viên chọn mục "Việc làm đã ứng tuyển".
3. Hệ thống truy vấn danh sách application theo `user_id`.
4. Hệ thống lấy thêm thông tin job và công ty.
5. Hệ thống hiển thị danh sách việc làm đã ứng tuyển.
6. Ứng viên xem trạng thái từng hồ sơ.

### Luồng thay thế

#### A1: Chưa có lịch sử ứng tuyển

1. Hệ thống không tìm thấy bản ghi ứng tuyển.
2. Hệ thống hiển thị thông báo: "Bạn chưa ứng tuyển công việc nào."

### Dữ liệu liên quan

- `applications`
- `jobs`
- `companies`
- `cvs`

---

## UC-CAND-11: Lưu việc làm yêu thích

### Actor chính

Ứng viên

### Mục tiêu

Ứng viên lưu lại job quan tâm để xem hoặc ứng tuyển sau.

### Tiền điều kiện

- Ứng viên đã đăng nhập.
- Job đang tồn tại.

### Hậu điều kiện

- Job được lưu vào danh sách yêu thích của ứng viên.

### Luồng chính

1. Ứng viên xem danh sách hoặc chi tiết việc làm.
2. Ứng viên nhấn "Lưu việc làm".
3. Hệ thống kiểm tra trạng thái đăng nhập.
4. Hệ thống kiểm tra job đã được lưu trước đó chưa.
5. Nếu chưa, hệ thống tạo bản ghi trong bảng `saved_jobs`.
6. Hệ thống hiển thị thông báo lưu thành công.

### Luồng thay thế

#### A1: Job đã được lưu

1. Hệ thống phát hiện đã tồn tại bản ghi trong `saved_jobs`.
2. Hệ thống không tạo mới.
3. Hệ thống hiển thị thông báo: "Việc làm này đã có trong danh sách đã lưu."

### Dữ liệu liên quan

- `saved_jobs.user_id`
- `saved_jobs.job_id`

---

## UC-EMP-01: Quản lý thông tin công ty

### Actor chính

Nhà tuyển dụng

### Mục tiêu

Nhà tuyển dụng tạo hoặc cập nhật thông tin công ty.

### Tiền điều kiện

- Nhà tuyển dụng đã đăng nhập.
- Người dùng có vai trò `employer`.

### Hậu điều kiện

- Thông tin công ty được lưu/cập nhật.
- Công ty có thể được hiển thị trên hệ thống.

### Luồng chính

1. Nhà tuyển dụng đăng nhập.
2. Nhà tuyển dụng vào dashboard.
3. Nhà tuyển dụng chọn mục "Thông tin công ty".
4. Hệ thống kiểm tra nhà tuyển dụng đã có công ty chưa.
5. Nếu chưa có, hệ thống hiển thị form tạo mới.
6. Nếu đã có, hệ thống hiển thị form cập nhật.
7. Nhà tuyển dụng nhập tên công ty, mô tả, địa chỉ, website, quy mô.
8. Nhà tuyển dụng upload logo nếu có.
9. Nhà tuyển dụng nhấn lưu.
10. Hệ thống kiểm tra dữ liệu.
11. Hệ thống lưu thông tin vào bảng `companies`.
12. Hệ thống hiển thị thông báo thành công.

### Luồng thay thế

#### A1: Thiếu tên công ty

1. Hệ thống kiểm tra trường `name`.
2. Nếu rỗng, hệ thống hiển thị lỗi.

#### A2: File logo sai định dạng

1. Hệ thống kiểm tra định dạng ảnh.
2. Nếu không hợp lệ, hệ thống từ chối upload.

### Dữ liệu liên quan

- `companies.user_id`
- `companies.name`
- `companies.logo`
- `companies.description`
- `companies.address`
- `companies.website`
- `companies.size`
- `companies.status`

---

## UC-EMP-02: Tạo tin tuyển dụng

### Actor chính

Nhà tuyển dụng

### Mục tiêu

Nhà tuyển dụng đăng một tin tuyển dụng mới.

### Tiền điều kiện

- Nhà tuyển dụng đã đăng nhập.
- Nhà tuyển dụng đã có hồ sơ công ty.
- Công ty đang ở trạng thái được phép đăng tin.

### Hậu điều kiện

- Tin tuyển dụng mới được tạo.
- Tin có thể hiển thị sau khi được duyệt hoặc hiển thị ngay tùy cấu hình hệ thống.

### Luồng chính

1. Nhà tuyển dụng vào dashboard.
2. Nhà tuyển dụng chọn "Quản lý tin tuyển dụng".
3. Nhà tuyển dụng chọn "Đăng tin mới".
4. Hệ thống hiển thị form tạo job.
5. Nhà tuyển dụng nhập tiêu đề công việc.
6. Nhà tuyển dụng chọn ngành nghề.
7. Nhà tuyển dụng nhập mô tả công việc.
8. Nhà tuyển dụng nhập yêu cầu ứng viên.
9. Nhà tuyển dụng nhập quyền lợi.
10. Nhà tuyển dụng nhập mức lương.
11. Nhà tuyển dụng nhập địa điểm làm việc.
12. Nhà tuyển dụng chọn hình thức làm việc: full-time, part-time, remote, internship.
13. Nhà tuyển dụng nhập hạn nộp hồ sơ.
14. Nhà tuyển dụng nhấn lưu.
15. Hệ thống kiểm tra dữ liệu.
16. Hệ thống tạo bản ghi trong bảng `jobs`.
17. Hệ thống hiển thị thông báo tạo tin thành công.

### Luồng thay thế

#### A1: Nhà tuyển dụng chưa có công ty

1. Hệ thống kiểm tra bảng `companies`.
2. Nếu chưa có công ty, hệ thống yêu cầu tạo thông tin công ty trước.

#### A2: Thiếu thông tin bắt buộc

1. Hệ thống kiểm tra tiêu đề, mô tả, địa điểm, hạn nộp.
2. Nếu thiếu, hệ thống hiển thị lỗi.

#### A3: Hạn nộp hồ sơ không hợp lệ

1. Hệ thống kiểm tra `deadline`.
2. Nếu deadline nhỏ hơn ngày hiện tại, hệ thống hiển thị lỗi.

### Dữ liệu liên quan

- `jobs.company_id`
- `jobs.category_id`
- `jobs.title`
- `jobs.description`
- `jobs.requirements`
- `jobs.benefits`
- `jobs.salary_min`
- `jobs.salary_max`
- `jobs.location`
- `jobs.working_type`
- `jobs.experience_level`
- `jobs.deadline`
- `jobs.status`

---

## UC-EMP-06: Xem danh sách ứng viên ứng tuyển

### Actor chính

Nhà tuyển dụng

### Mục tiêu

Nhà tuyển dụng xem danh sách ứng viên đã ứng tuyển vào một tin tuyển dụng.

### Tiền điều kiện

- Nhà tuyển dụng đã đăng nhập.
- Job thuộc công ty của nhà tuyển dụng.
- Job có thể có hoặc chưa có ứng viên ứng tuyển.

### Hậu điều kiện

- Nhà tuyển dụng xem được danh sách ứng viên.
- Nhà tuyển dụng có thể chọn xem chi tiết CV.

### Luồng chính

1. Nhà tuyển dụng vào dashboard.
2. Nhà tuyển dụng chọn "Quản lý tin tuyển dụng".
3. Hệ thống hiển thị danh sách job thuộc công ty của nhà tuyển dụng.
4. Nhà tuyển dụng chọn một job.
5. Nhà tuyển dụng chọn "Danh sách ứng viên".
6. Hệ thống kiểm tra job có thuộc công ty của nhà tuyển dụng không.
7. Hệ thống truy vấn bảng `applications` theo `job_id`.
8. Hệ thống lấy thêm thông tin ứng viên và CV.
9. Hệ thống hiển thị danh sách ứng viên đã ứng tuyển.

### Luồng thay thế

#### A1: Job không thuộc công ty của nhà tuyển dụng

1. Hệ thống kiểm tra quyền sở hữu.
2. Nếu job không thuộc công ty của nhà tuyển dụng, hệ thống từ chối truy cập.
3. Hệ thống trả về lỗi 403 hoặc thông báo không có quyền.

#### A2: Chưa có ứng viên

1. Hệ thống không tìm thấy application.
2. Hệ thống hiển thị thông báo: "Chưa có ứng viên ứng tuyển."

### Dữ liệu liên quan

- `jobs`
- `companies`
- `applications`
- `users`
- `cvs`

---

## UC-EMP-07: Xem chi tiết CV ứng viên

### Actor chính

Nhà tuyển dụng

### Mục tiêu

Nhà tuyển dụng xem chi tiết CV của ứng viên đã ứng tuyển.

### Tiền điều kiện

- Nhà tuyển dụng đã đăng nhập.
- Ứng viên đã ứng tuyển vào job thuộc công ty của nhà tuyển dụng.

### Hậu điều kiện

- Nhà tuyển dụng xem được thông tin CV.
- Hệ thống có thể cập nhật trạng thái application thành `viewed`.

### Luồng chính

1. Nhà tuyển dụng mở danh sách ứng viên ứng tuyển.
2. Nhà tuyển dụng chọn một ứng viên.
3. Hệ thống kiểm tra application có thuộc job của công ty nhà tuyển dụng không.
4. Hệ thống lấy thông tin CV từ bảng `cvs`.
5. Nếu là CV online, hệ thống hiển thị thông tin CV.
6. Nếu là file PDF, hệ thống hiển thị link xem/tải file.
7. Hệ thống có thể cập nhật trạng thái application từ `pending` sang `viewed`.
8. Hệ thống hiển thị chi tiết CV.

### Luồng thay thế

#### A1: CV đã bị xóa

1. Hệ thống không tìm thấy CV.
2. Hệ thống hiển thị thông báo: "CV không còn tồn tại."

#### A2: Không có quyền xem CV

1. Hệ thống kiểm tra quyền truy cập.
2. Nếu application không thuộc job của nhà tuyển dụng, hệ thống từ chối.

### Dữ liệu liên quan

- `applications`
- `cvs`
- `users`
- `jobs`
- `companies`

---

## UC-EMP-08: Cập nhật trạng thái ứng tuyển

### Actor chính

Nhà tuyển dụng

### Mục tiêu

Nhà tuyển dụng cập nhật trạng thái xử lý hồ sơ ứng tuyển.

### Tiền điều kiện

- Nhà tuyển dụng đã đăng nhập.
- Application thuộc job của công ty nhà tuyển dụng.

### Hậu điều kiện

- Trạng thái ứng tuyển được cập nhật.
- Ứng viên có thể xem trạng thái mới.
- Hệ thống có thể gửi thông báo cho ứng viên.

### Các trạng thái gợi ý

- `pending`: Chờ xử lý
- `viewed`: Đã xem
- `interview`: Mời phỏng vấn
- `accepted`: Phù hợp
- `rejected`: Từ chối

### Luồng chính

1. Nhà tuyển dụng mở danh sách ứng viên.
2. Nhà tuyển dụng chọn một hồ sơ ứng tuyển.
3. Nhà tuyển dụng chọn trạng thái mới.
4. Nhà tuyển dụng nhấn cập nhật.
5. Hệ thống kiểm tra quyền cập nhật.
6. Hệ thống kiểm tra trạng thái mới có hợp lệ không.
7. Hệ thống cập nhật bảng `applications`.
8. Hệ thống gửi thông báo cho ứng viên nếu cần.
9. Hệ thống hiển thị thông báo cập nhật thành công.

### Luồng thay thế

#### A1: Trạng thái không hợp lệ

1. Hệ thống phát hiện trạng thái không thuộc danh sách cho phép.
2. Hệ thống từ chối cập nhật.
3. Hệ thống hiển thị lỗi.

#### A2: Không có quyền cập nhật

1. Hệ thống kiểm tra application không thuộc job của nhà tuyển dụng.
2. Hệ thống trả về lỗi 403.

### Dữ liệu liên quan

- `applications.status`
- `applications.updated_at`

---

## UC-ADMIN-01: Quản lý người dùng

### Actor chính

Quản trị viên

### Mục tiêu

Admin xem và quản lý tài khoản người dùng trong hệ thống.

### Tiền điều kiện

- Admin đã đăng nhập.
- Người dùng có vai trò `admin`.

### Hậu điều kiện

- Admin xem được danh sách tài khoản.
- Admin có thể lọc, tìm kiếm hoặc thao tác khóa/mở tài khoản.

### Luồng chính

1. Admin đăng nhập vào hệ thống.
2. Admin truy cập dashboard quản trị.
3. Admin chọn mục "Quản lý người dùng".
4. Hệ thống truy vấn danh sách user.
5. Hệ thống hiển thị danh sách user theo phân trang.
6. Admin có thể tìm kiếm theo tên, email hoặc vai trò.
7. Admin xem chi tiết một user nếu cần.

### Luồng thay thế

#### A1: Không có người dùng phù hợp với bộ lọc

1. Hệ thống không tìm thấy dữ liệu.
2. Hệ thống hiển thị thông báo không có kết quả.

### Dữ liệu liên quan

- `users.id`
- `users.name`
- `users.email`
- `users.role`
- `users.status`
- `users.created_at`

---

## UC-ADMIN-02: Khóa/mở tài khoản

### Actor chính

Quản trị viên

### Mục tiêu

Admin khóa hoặc mở khóa tài khoản người dùng.

### Tiền điều kiện

- Admin đã đăng nhập.
- Tài khoản cần khóa/mở tồn tại.
- Admin không tự khóa chính mình.

### Hậu điều kiện

- Trạng thái tài khoản được cập nhật.
- Người dùng bị khóa không thể đăng nhập hoặc sử dụng chức năng hệ thống.

### Luồng chính

1. Admin vào trang quản lý người dùng.
2. Admin chọn một tài khoản.
3. Admin nhấn "Khóa tài khoản" hoặc "Mở khóa tài khoản".
4. Hệ thống hiển thị xác nhận.
5. Admin xác nhận thao tác.
6. Hệ thống kiểm tra quyền admin.
7. Hệ thống cập nhật trường `status` của user.
8. Hệ thống hiển thị thông báo thành công.

### Luồng thay thế

#### A1: Admin tự khóa tài khoản của mình

1. Hệ thống phát hiện user cần khóa là chính admin hiện tại.
2. Hệ thống từ chối thao tác.
3. Hệ thống hiển thị thông báo: "Không thể tự khóa tài khoản của chính mình."

### Dữ liệu liên quan

- `users.status`

---

## UC-ADMIN-05: Quản lý tin tuyển dụng

### Actor chính

Quản trị viên

### Mục tiêu

Admin quản lý toàn bộ tin tuyển dụng trên hệ thống.

### Tiền điều kiện

- Admin đã đăng nhập.

### Hậu điều kiện

- Admin xem được danh sách job.
- Admin có thể duyệt, ẩn hoặc xóa job vi phạm.

### Luồng chính

1. Admin vào dashboard.
2. Admin chọn mục "Quản lý tin tuyển dụng".
3. Hệ thống truy vấn danh sách job.
4. Hệ thống hiển thị danh sách job theo phân trang.
5. Admin tìm kiếm/lọc theo công ty, ngành nghề, trạng thái.
6. Admin xem chi tiết một job.
7. Admin chọn duyệt, ẩn hoặc xóa job.
8. Hệ thống cập nhật trạng thái job.
9. Hệ thống hiển thị thông báo thành công.

### Luồng thay thế

#### A1: Job không tồn tại

1. Hệ thống không tìm thấy job.
2. Hệ thống hiển thị thông báo lỗi.

#### A2: Job đã bị xóa trước đó

1. Hệ thống phát hiện job không còn khả dụng.
2. Hệ thống hiển thị thông báo.

### Dữ liệu liên quan

- `jobs`
- `companies`
- `categories`

---

## UC-ADMIN-07: Quản lý ngành nghề

### Actor chính

Quản trị viên

### Mục tiêu

Admin quản lý danh mục ngành nghề dùng cho tin tuyển dụng.

### Tiền điều kiện

- Admin đã đăng nhập.

### Hậu điều kiện

- Danh mục ngành nghề được thêm, sửa hoặc xóa.
- Nhà tuyển dụng có thể chọn ngành nghề khi tạo job.

### Luồng chính

1. Admin vào dashboard.
2. Admin chọn mục "Quản lý ngành nghề".
3. Hệ thống hiển thị danh sách ngành nghề.
4. Admin chọn thêm mới ngành nghề.
5. Admin nhập tên ngành nghề.
6. Hệ thống tự tạo slug hoặc admin nhập slug.
7. Admin nhấn lưu.
8. Hệ thống kiểm tra trùng tên hoặc trùng slug.
9. Hệ thống lưu vào bảng `categories`.
10. Hệ thống hiển thị thông báo thành công.

### Luồng thay thế

#### A1: Tên ngành nghề bị trùng

1. Hệ thống kiểm tra tên hoặc slug đã tồn tại.
2. Hệ thống từ chối tạo mới.
3. Hệ thống hiển thị lỗi.

#### A2: Xóa ngành nghề đang có job sử dụng

1. Admin nhấn xóa ngành nghề.
2. Hệ thống kiểm tra có job thuộc ngành nghề đó không.
3. Nếu có, hệ thống không cho xóa hoặc yêu cầu chuyển job sang ngành khác.
4. Hệ thống hiển thị cảnh báo.

### Dữ liệu liên quan

- `categories.name`
- `categories.slug`

---

# 5. Luồng thực thi tổng thể của hệ thống

## 5.1. Luồng tổng thể từ góc nhìn ứng viên

```text
Khách truy cập website
        |
        v
Xem danh sách việc làm / tìm kiếm việc làm
        |
        v
Xem chi tiết việc làm
        |
        v
Có muốn ứng tuyển không?
        |
        +-- Không --> Tiếp tục xem việc làm khác
        |
        +-- Có
              |
              v
        Đã đăng nhập chưa?
              |
              +-- Chưa --> Đăng nhập / Đăng ký
              |
              +-- Rồi
                    |
                    v
              Có phải ứng viên không?
                    |
                    +-- Không --> Từ chối ứng tuyển
                    |
                    +-- Có
                          |
                          v
                    Đã có CV chưa?
                          |
                          +-- Chưa --> Tạo CV / Upload CV
                          |
                          +-- Có
                                |
                                v
                          Chọn CV
                                |
                                v
                          Kiểm tra đã ứng tuyển chưa
                                |
                                +-- Đã ứng tuyển --> Thông báo lỗi
                                |
                                +-- Chưa
                                      |
                                      v
                                Tạo application
                                      |
                                      v
                                Thông báo ứng tuyển thành công
                                      |
                                      v
                                Nhà tuyển dụng nhận được hồ sơ
```

---

## 5.2. Luồng tổng thể từ góc nhìn nhà tuyển dụng

```text
Nhà tuyển dụng đăng nhập
        |
        v
Vào dashboard nhà tuyển dụng
        |
        v
Đã có thông tin công ty chưa?
        |
        +-- Chưa --> Tạo thông tin công ty
        |
        +-- Rồi
              |
              v
        Tạo tin tuyển dụng
              |
              v
        Hệ thống lưu job
              |
              v
        Job hiển thị trên hệ thống
              |
              v
        Ứng viên ứng tuyển
              |
              v
        Nhà tuyển dụng xem danh sách ứng viên
              |
              v
        Xem chi tiết CV
              |
              v
        Cập nhật trạng thái ứng tuyển
              |
              v
        Ứng viên xem được trạng thái mới
```

---

## 5.3. Luồng tổng thể từ góc nhìn admin

```text
Admin đăng nhập
        |
        v
Vào dashboard quản trị
        |
        v
Quản lý dữ liệu hệ thống
        |
        +-- Quản lý user
        |
        +-- Quản lý công ty
        |
        +-- Quản lý job
        |
        +-- Quản lý ngành nghề
        |
        +-- Quản lý địa điểm
        |
        v
Kiểm duyệt / khóa / ẩn / thống kê
        |
        v
Dữ liệu hệ thống được đảm bảo hợp lệ
```

---

# 6. Luồng xử lý nghiệp vụ quan trọng

## 6.1. Luồng xử lý khi ứng viên apply job

### Mô tả

Đây là luồng nghiệp vụ quan trọng nhất của hệ thống.

### Các bước xử lý backend

1. Nhận request ứng tuyển từ ứng viên.
2. Middleware kiểm tra đăng nhập.
3. Middleware kiểm tra role là `candidate`.
4. Controller nhận `job_id`, `cv_id`, `cover_letter`.
5. Kiểm tra job có tồn tại không.
6. Kiểm tra job có đang active không.
7. Kiểm tra deadline của job.
8. Kiểm tra CV có thuộc về ứng viên hiện tại không.
9. Kiểm tra ứng viên đã ứng tuyển job này chưa.
10. Nếu hợp lệ, tạo application.
11. Gán trạng thái mặc định là `pending`.
12. Gửi thông báo/email cho nhà tuyển dụng.
13. Trả response thành công.

### Pseudocode

```php
public function apply(Request $request, $jobId)
{
    $user = auth()->user();

    if ($user->role !== 'candidate') {
        abort(403);
    }

    $job = Job::where('id', $jobId)
        ->where('status', 'active')
        ->firstOrFail();

    if ($job->deadline < now()) {
        return back()->withErrors('Tin tuyển dụng đã hết hạn.');
    }

    $cv = Cv::where('id', $request->cv_id)
        ->where('user_id', $user->id)
        ->firstOrFail();

    $exists = Application::where('job_id', $job->id)
        ->where('user_id', $user->id)
        ->exists();

    if ($exists) {
        return back()->withErrors('Bạn đã ứng tuyển công việc này.');
    }

    Application::create([
        'job_id' => $job->id,
        'user_id' => $user->id,
        'cv_id' => $cv->id,
        'cover_letter' => $request->cover_letter,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Ứng tuyển thành công.');
}
```

---

## 6.2. Luồng xử lý khi nhà tuyển dụng tạo job

### Các bước xử lý backend

1. Nhận request tạo job.
2. Middleware kiểm tra đăng nhập.
3. Middleware kiểm tra role là `employer`.
4. Kiểm tra nhà tuyển dụng đã có công ty chưa.
5. Validate dữ liệu đầu vào.
6. Kiểm tra deadline hợp lệ.
7. Tạo job gắn với `company_id`.
8. Gán trạng thái mặc định.
9. Trả response thành công.

### Trạng thái job gợi ý

- `draft`: Bản nháp
- `pending`: Chờ admin duyệt
- `active`: Đang hiển thị
- `hidden`: Đã ẩn
- `expired`: Hết hạn
- `rejected`: Bị từ chối

### Pseudocode

```php
public function store(Request $request)
{
    $user = auth()->user();

    if ($user->role !== 'employer') {
        abort(403);
    }

    $company = Company::where('user_id', $user->id)->first();

    if (!$company) {
        return redirect()->route('employer.company.create')
            ->withErrors('Vui lòng tạo thông tin công ty trước.');
    }

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'requirements' => 'required|string',
        'benefits' => 'nullable|string',
        'salary_min' => 'nullable|numeric|min:0',
        'salary_max' => 'nullable|numeric|min:0',
        'location' => 'required|string|max:255',
        'working_type' => 'required|string',
        'deadline' => 'required|date|after:today',
    ]);

    $data['company_id'] = $company->id;
    $data['status'] = 'pending';

    Job::create($data);

    return redirect()->route('employer.jobs.index')
        ->with('success', 'Tạo tin tuyển dụng thành công.');
}
```

---

## 6.3. Luồng xử lý khi nhà tuyển dụng cập nhật trạng thái ứng tuyển

### Các bước xử lý backend

1. Nhà tuyển dụng gửi request cập nhật trạng thái.
2. Middleware kiểm tra đăng nhập.
3. Middleware kiểm tra role là `employer`.
4. Lấy application theo ID.
5. Kiểm tra application thuộc job của công ty nhà tuyển dụng.
6. Kiểm tra trạng thái mới hợp lệ.
7. Cập nhật application.
8. Gửi thông báo cho ứng viên.
9. Trả response thành công.

### Pseudocode

```php
public function updateStatus(Request $request, $applicationId)
{
    $user = auth()->user();

    if ($user->role !== 'employer') {
        abort(403);
    }

    $company = Company::where('user_id', $user->id)->firstOrFail();

    $application = Application::with('job')
        ->where('id', $applicationId)
        ->firstOrFail();

    if ($application->job->company_id !== $company->id) {
        abort(403);
    }

    $data = $request->validate([
        'status' => 'required|in:pending,viewed,interview,accepted,rejected',
    ]);

    $application->update([
        'status' => $data['status'],
    ]);

    return back()->with('success', 'Cập nhật trạng thái thành công.');
}
```

---

# 7. Gợi ý Middleware và phân quyền

## 7.1. Middleware đăng nhập

Dùng middleware mặc định của Laravel:

```php
Route::middleware(['auth'])->group(function () {
    // protected routes
});
```

## 7.2. Middleware kiểm tra role

Có thể tạo middleware:

```bash
php artisan make:middleware CheckRole
```

Logic:

```php
public function handle($request, Closure $next, $role)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== $role) {
        abort(403);
    }

    return $next($request);
}
```

Sử dụng:

```php
Route::middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateDashboardController::class, 'index']);
});

Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
});
```

---

# 8. Đề xuất bảng dữ liệu chính

## 8.1. users

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| name | varchar | Họ tên |
| email | varchar | Email đăng nhập |
| password | varchar | Mật khẩu đã mã hóa |
| role | enum/string | admin, employer, candidate |
| phone | varchar | Số điện thoại |
| avatar | varchar | Ảnh đại diện |
| status | enum/string | active, blocked |
| created_at | timestamp | Ngày tạo |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.2. companies

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| user_id | bigint | Nhà tuyển dụng sở hữu công ty |
| name | varchar | Tên công ty |
| logo | varchar | Logo công ty |
| description | text | Mô tả công ty |
| address | varchar | Địa chỉ |
| website | varchar | Website |
| size | varchar | Quy mô |
| status | enum/string | pending, active, blocked |
| created_at | timestamp | Ngày tạo |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.3. jobs

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| company_id | bigint | Công ty đăng tin |
| category_id | bigint | Ngành nghề |
| title | varchar | Tiêu đề job |
| description | text | Mô tả công việc |
| requirements | text | Yêu cầu ứng viên |
| benefits | text | Quyền lợi |
| salary_min | decimal | Lương tối thiểu |
| salary_max | decimal | Lương tối đa |
| location | varchar | Địa điểm |
| working_type | varchar | Hình thức làm việc |
| experience_level | varchar | Kinh nghiệm |
| deadline | date | Hạn ứng tuyển |
| status | enum/string | draft, pending, active, hidden, expired, rejected |
| created_at | timestamp | Ngày tạo |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.4. cvs

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| user_id | bigint | Ứng viên sở hữu CV |
| title | varchar | Tên CV |
| full_name | varchar | Họ tên |
| email | varchar | Email trong CV |
| phone | varchar | Số điện thoại |
| address | varchar | Địa chỉ |
| objective | text | Mục tiêu nghề nghiệp |
| education | text/json | Học vấn |
| experience | text/json | Kinh nghiệm |
| skills | text/json | Kỹ năng |
| projects | text/json | Dự án |
| file_path | varchar | Đường dẫn file PDF nếu có |
| created_at | timestamp | Ngày tạo |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.5. applications

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| job_id | bigint | Job được ứng tuyển |
| user_id | bigint | Ứng viên |
| cv_id | bigint | CV được dùng để ứng tuyển |
| cover_letter | text | Thư giới thiệu |
| status | enum/string | pending, viewed, interview, accepted, rejected |
| created_at | timestamp | Ngày ứng tuyển |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.6. saved_jobs

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| user_id | bigint | Ứng viên |
| job_id | bigint | Job được lưu |
| created_at | timestamp | Ngày lưu |
| updated_at | timestamp | Ngày cập nhật |

---

## 8.7. categories

| Trường | Kiểu dữ liệu | Mô tả |
|---|---|---|
| id | bigint | Khóa chính |
| name | varchar | Tên ngành nghề |
| slug | varchar | Slug |
| created_at | timestamp | Ngày tạo |
| updated_at | timestamp | Ngày cập nhật |

---

# 9. Quan hệ giữa các bảng

```text
users
  |-- hasOne companies
  |-- hasMany cvs
  |-- hasMany applications
  |-- hasMany saved_jobs

companies
  |-- belongsTo users
  |-- hasMany jobs

categories
  |-- hasMany jobs

jobs
  |-- belongsTo companies
  |-- belongsTo categories
  |-- hasMany applications
  |-- hasMany saved_jobs

cvs
  |-- belongsTo users
  |-- hasMany applications

applications
  |-- belongsTo users
  |-- belongsTo jobs
  |-- belongsTo cvs

saved_jobs
  |-- belongsTo users
  |-- belongsTo jobs
```

---

# 10. Gợi ý chia module Laravel

## Module Public

- Trang chủ
- Danh sách việc làm
- Chi tiết việc làm
- Danh sách công ty
- Chi tiết công ty

## Module Auth

- Đăng ký
- Đăng nhập
- Đăng xuất
- Quên mật khẩu nếu muốn mở rộng

## Module Candidate

- Dashboard ứng viên
- Quản lý hồ sơ cá nhân
- Quản lý CV
- Ứng tuyển việc làm
- Việc làm đã lưu
- Lịch sử ứng tuyển

## Module Employer

- Dashboard nhà tuyển dụng
- Quản lý công ty
- Quản lý tin tuyển dụng
- Quản lý ứng viên ứng tuyển

## Module Admin

- Dashboard admin
- Quản lý người dùng
- Quản lý công ty
- Quản lý tin tuyển dụng
- Quản lý ngành nghề
- Thống kê

---

# 11. Gợi ý route Laravel

```php
// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobPublicController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobPublicController::class, 'show'])->name('jobs.show');
Route::get('/companies', [CompanyPublicController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyPublicController::class, 'show'])->name('companies.show');

// Candidate
Route::middleware(['auth', 'role:candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/dashboard', [CandidateDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/cvs', CandidateCvController::class);
    Route::get('/applications', [CandidateApplicationController::class, 'index'])->name('applications.index');
    Route::post('/jobs/{job}/apply', [CandidateApplicationController::class, 'store'])->name('jobs.apply');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'store'])->name('jobs.save');
    Route::delete('/jobs/{job}/unsave', [SavedJobController::class, 'destroy'])->name('jobs.unsave');
});

// Employer
Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/company', EmployerCompanyController::class);
    Route::resource('/jobs', EmployerJobController::class);
    Route::get('/jobs/{job}/applications', [EmployerApplicationController::class, 'index'])->name('jobs.applications');
    Route::get('/applications/{application}', [EmployerApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.status');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', AdminUserController::class);
    Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('/companies', AdminCompanyController::class);
    Route::resource('/jobs', AdminJobController::class);
    Route::patch('/jobs/{job}/status', [AdminJobController::class, 'updateStatus'])->name('jobs.status');
    Route::resource('/categories', AdminCategoryController::class);
});
```

---

# 12. Kết luận phân tích BA

Với phạm vi bài tập lớn Laravel, hệ thống TopCV Mini nên tập trung vào 3 nghiệp vụ lõi:

1. Ứng viên tạo CV và ứng tuyển.
2. Nhà tuyển dụng đăng tin và xử lý hồ sơ.
3. Admin quản lý dữ liệu và kiểm duyệt hệ thống.

Phạm vi này vừa đủ lớn để thể hiện khả năng phân tích hệ thống, thiết kế database, phân quyền, CRUD, upload file, tìm kiếm, validate dữ liệu và xử lý nghiệp vụ thực tế.

Nếu cần mở rộng, có thể bổ sung:

- Gửi email thông báo.
- Chat giữa ứng viên và nhà tuyển dụng.
- Gợi ý việc làm theo kỹ năng.
- Xuất CV ra PDF.
- Tìm kiếm nâng cao.
- Thống kê biểu đồ cho admin và nhà tuyển dụng.
