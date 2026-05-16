<x-app-layout>
    <x-dashboard-shell title="Thông tin công ty" subtitle="Mỗi nhà tuyển dụng quản lý một hồ sơ công ty.">
    <form class="card form" method="POST" action="{{ $company ? route('employer.company.update', $company) : route('employer.company.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($company) @method('PUT') @endif
        <div class="field"><label>Tên công ty</label><input name="name" value="{{ old('name', $company->name ?? '') }}" required></div>
        <div class="field"><label>Logo</label><input type="file" name="logo" accept="image/*"></div>
        <div class="field"><label>Mô tả</label><textarea name="description">{{ old('description', $company->description ?? '') }}</textarea></div>
        <div class="grid grid-2">
            <div class="field"><label>Địa chỉ</label><input name="address" value="{{ old('address', $company->address ?? '') }}"></div>
            <div class="field"><label>Website</label><input name="website" value="{{ old('website', $company->website ?? '') }}"></div>
            <div class="field"><label>Quy mô</label><input name="size" value="{{ old('size', $company->size ?? '') }}"></div>
        </div>
        <button class="button" type="submit">Lưu công ty</button>
    </form>
    </x-dashboard-shell>
</x-app-layout>
