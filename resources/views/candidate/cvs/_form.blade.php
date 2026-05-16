@php
    $cv = $cv ?? null;
    $type = old('type', $cv->type ?? 'online');
@endphp
<div class="field">
    <label>Tên CV</label>
    <input name="title" value="{{ old('title', $cv->title ?? '') }}" required>
</div>
<div class="field">
    <label>Loại CV</label>
    <select name="type">
        <option value="online" @selected($type === 'online')>CV online</option>
        <option value="pdf" @selected($type === 'pdf')>Tải lên PDF</option>
    </select>
</div>
<div class="field">
    <label>File PDF</label>
    <input type="file" name="file" accept="application/pdf">
    @if ($cv?->file_path)
        <p><a href="{{ Storage::url($cv->file_path) }}" target="_blank">Xem tệp hiện tại</a></p>
    @endif
</div>
<div class="grid grid-2">
    <div class="field"><label>Họ tên</label><input name="full_name" value="{{ old('full_name', $cv->full_name ?? auth()->user()->name) }}"></div>
    <div class="field"><label>Email trên CV</label><input type="email" name="email" value="{{ old('email', $cv->email ?? auth()->user()->email) }}"></div>
    <div class="field"><label>Số điện thoại</label><input name="phone" value="{{ old('phone', $cv->phone ?? '') }}"></div>
    <div class="field"><label>Địa chỉ</label><input name="address" value="{{ old('address', $cv->address ?? '') }}"></div>
</div>
<div class="field"><label>Mục tiêu nghề nghiệp</label><textarea name="objective">{{ old('objective', $cv->objective ?? '') }}</textarea></div>
<div class="field"><label>Học vấn (mỗi dòng một mục)</label><textarea name="education">{{ old('education', $cv ? implode("\n", $cv->education ?? []) : '') }}</textarea></div>
<div class="field"><label>Kinh nghiệm (mỗi dòng một mục)</label><textarea name="experience">{{ old('experience', $cv ? implode("\n", $cv->experience ?? []) : '') }}</textarea></div>
<div class="field"><label>Kỹ năng (mỗi dòng một mục)</label><textarea name="skills">{{ old('skills', $cv ? implode("\n", $cv->skills ?? []) : '') }}</textarea></div>
<div class="field"><label>Dự án (mỗi dòng một mục)</label><textarea name="projects">{{ old('projects', $cv ? implode("\n", $cv->projects ?? []) : '') }}</textarea></div>
<button class="button" type="submit">Lưu CV</button>
