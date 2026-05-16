<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.companies.index', [
            'companies' => Company::with('user')
                ->when($request->q, fn ($query, $q) => $query->where('name', 'like', "%{$q}%"))
                ->latest()
                ->paginate(12)
                ->withQueryString(),
        ]);
    }

    public function updateStatus(Request $request, Company $company)
    {
        $data = $request->validate([
            'status' => ['required', 'in:active,blocked'],
        ]);

        $company->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái công ty.');
    }
}
