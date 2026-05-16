@php($job = $job ?? null)
<div class="field"><label>Tiêu đề</label><input name="title" value="{{ old('title', $job->title ?? '') }}" required></div>
<div class="grid grid-2">
    <div class="field">
        <label>Ngành nghề</label>
        <select name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $job->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>Hình thức</label>
        <select name="working_type" required>
            @foreach (['full-time' => 'Toàn thời gian', 'part-time' => 'Bán thời gian', 'remote' => 'Từ xa', 'internship' => 'Thực tập'] as $type => $label)
                <option value="{{ $type }}" @selected(old('working_type', $job->working_type ?? '') === $type)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="field"><label>Địa điểm</label><input name="location" value="{{ old('location', $job->location ?? '') }}" required></div>
    <div class="field"><label>Kinh nghiệm</label><input name="experience_level" value="{{ old('experience_level', $job->experience_level ?? '') }}"></div>
    <div class="field"><label>Lương tối thiểu</label><input type="number" name="salary_min" value="{{ old('salary_min', $job->salary_min ?? '') }}"></div>
    <div class="field"><label>Lương tối đa</label><input type="number" name="salary_max" value="{{ old('salary_max', $job->salary_max ?? '') }}"></div>
    <div class="field"><label>Hạn nộp</label><input type="date" name="deadline" value="{{ old('deadline', $job?->deadline?->format('Y-m-d') ?? '') }}" required></div>
</div>
<div class="field"><label>Mô tả công việc</label><textarea name="description" required>{{ old('description', $job->description ?? '') }}</textarea></div>
<div class="field"><label>Yêu cầu</label><textarea name="requirements" required>{{ old('requirements', $job->requirements ?? '') }}</textarea></div>
<div class="field"><label>Quyền lợi</label><textarea name="benefits">{{ old('benefits', $job->benefits ?? '') }}</textarea></div>
<button class="button" type="submit">Lưu tin</button>
