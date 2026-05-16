@php($category = $category ?? null)
<div class="field">
    <label>Tên ngành</label>
    <input name="name" value="{{ old('name', $category->name ?? '') }}" required>
</div>
<div class="field">
    <label>Slug</label>
    <input name="slug" value="{{ old('slug', $category->slug ?? '') }}">
</div>
<button class="button" type="submit">Lưu</button>
