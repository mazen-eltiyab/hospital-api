@extends('layouts.admin') {{-- التأكد من مطابقة اسم ملف الـ Layout الأساسي --}}

@section('title', 'Add New Service - MediCare')

@push('styles')
{{-- استدعاء Tailwind لتنسيق الفورم المودرن --}}
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* تحسينات إضافية لتنسيق الفورم */
    .form-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #edf2f7;
        padding: 32px;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.05);
    }

    .form-label {
        font-weight: 700;
        font-size: 0.9rem;
        color: #2d3e50;
        margin-bottom: 8px;
        display: block;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        outline: none;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .form-input:focus {
        border-color: #009efb;
        box-shadow: 0 0 0 4px rgba(0,158,251,0.1);
    }

    .btn-save-service {
        background-color: #00d084;
        color: white;
        padding: 12px 32px;
        border-radius: 16px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 10px 20px -8px rgba(0,208,132,0.3);
    }

    .btn-save-service:hover {
        background-color: #05b474;
        transform: translateY(-2px);
        color: white;
    }

    .btn-cancel-service {
        background-color: #f1f5f9;
        color: #475569;
        padding: 12px 32px;
        border-radius: 16px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        text-decoration: none !important;
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto p-4">
    {{-- Header with Back Button --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('services.index') }}" class="bg-white p-3 rounded-2xl shadow-sm border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Add New Service</h2>
            <p class="text-gray-500 font-medium">Create a new hospital department or service</p>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="form-card">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            
            <div class="mb-8">
                <label class="form-label">Service Name</label>
                <input type="text" name="service_name" class="form-input" placeholder="e.g., Cardiology, Neurology" value="{{ old('service_name') }}" required>
                @error('service_name') 
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> 
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="form-label">Service Status</label>
                    <select name="status" class="form-input cursor-pointer">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-8">
                <a href="{{ route('services.index') }}" class="btn-cancel-service">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn-save-service">
                    <i class="fas fa-check"></i> Save Service
                </button>
            </div>
        </form>
    </div>

    {{-- Info Hint --}}
    <p class="text-center text-gray-400 text-sm mt-8">
        <i class="fas fa-info-circle mr-1"></i> New services will be immediately available for <a href="{{ route('admin.appointments') }}" class="text-[#009efb] font-medium hover:underline">appointment booking</a>.
    </p>
</div>
@endsection

@push('scripts')
<script>
    // يمكن إضافة أي منطق JS هنا للتفاعل مع الفورم مستقبلاً
    $(document).ready(function() {
        console.log("Add Service Page Loaded");
    });
</script>
@endpush