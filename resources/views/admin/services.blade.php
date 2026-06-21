@extends('layouts.admin') {{-- التأكد من أن المسار يطابق ملف الـ Layout الأساسي --}}

@section('title', 'Services Management - MediCare')

@push('styles')
{{-- إضافة Tailwind CSS فقط لهذه الصفحة إذا لم يكن موجوداً في الـ Layout --}}
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .icon-container {
        background-color: #009efb; 
        color: white;
        width: 44px; height: 44px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-size: 20px;
        box-shadow: 0 5px 15px rgba(0, 158, 251, 0.25);
    }

    .service-card {
        background: #ffffff; border-radius: 20px; border: 1px solid #edf2f7;
        padding: 20px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; display: flex; flex-direction: column; height: 100%;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.08);
        border-color: #009efb66;
    }

    .status-badge { padding: 4px 12px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; }
    .active-style { background-color: #e6f9f1; color: #00d084; }
    .inactive-style { background-color: #fff1f1; color: #ff5c5c; }

    .btn-edit-action {
        background-color: #f8fafc; color: #64748b; padding: 10px;
        border-radius: 12px; font-weight: 700; font-size: 13px;
        display: flex; align-items: center; justify-content: center;
        gap: 6px; flex: 1; transition: 0.2s; border: 1px solid #f1f5f9; text-decoration: none !important;
    }
    .btn-edit-action:hover { background-color: #009efb; color: white; border-color: #009efb; }

    .btn-delete-action {
        width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
        background-color: #fff5f5; color: #ef4444; border-radius: 12px;
        transition: 0.2s; border: 1px solid #fee2e2;
    }
    .btn-delete-action:hover { background-color: #ef4444; color: white; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Services Management</h2>
            <p class="text-gray-500 font-medium">Manage and monitor hospital departments</p>
        </div>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <a href="{{ route('services.create') }}" class="bg-[#00d084] hover:bg-[#05b474] text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 shadow-xl shadow-green-500/20 transition-all active:scale-95 no-underline">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
    </div>

    {{-- Grid Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @isset($services)
            @forelse($services as $service)
                <div class="service-card shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="icon-container" data-service-name="{{ $service->service_name }}">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <span class="status-badge {{ ($service->status ?? 'active') == 'active' ? 'active-style' : 'inactive-style' }}">
                            {{ ucfirst($service->status ?? 'Active') }}
                        </span>
                    </div>

                    <h3 class="text-xl font-extrabold text-gray-800 mb-1">{{ $service->service_name }}</h3>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-[10px] font-bold text-blue-600">
                            <i class="fas fa-user-md"></i>
                        </span>
                        <span class="text-sm font-semibold text-gray-600">
                            {{ $service->doctors_count ?? ($service->doctors ? $service->doctors->count() : 0) }} Doctors Available
                        </span>
                    </div>

                    <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                        {{ Str::limit($service->description ?? '', 100) }}
                    </p>

                    <div class="flex gap-3 mt-auto">
                        <a href="{{ route('services.edit', $service->id) }}" class="btn-edit-action">
                            <i class="fas fa-pen-to-square"></i> Edit
                        </a>
                        <button type="button" class="btn-delete-action" data-toggle="modal" data-target="#deleteModal-{{ $service->id }}">
                            <i class="fas fa-trash-can"></i>
                        </button>
                    </div>
                </div>

                {{-- Modal Deletion (داخل اللوب لربط كل مودال بخدمة معينة) --}}
                <div class="modal fade" id="deleteModal-{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 20px; border: none;">
                            <div class="modal-header">
                                <h5 class="modal-title font-bold">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong>{{ $service->service_name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="background: #ef4444;">Delete Service</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed">
                    <i class="fas fa-folder-open text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-400 font-medium">No services found in the database.</p>
                </div>
            @endforelse
        @endisset
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconMap = {
            'cardio': 'fa-heartbeat', 'heart': 'fa-heartbeat',
            'brain': 'fa-brain', 'neuro': 'fa-brain',
            'bone': 'fa-bone', 'ortho': 'fa-bone',
            'baby': 'fa-baby-carriage', 'pediat': 'fa-baby-carriage',
            'dental': 'fa-tooth', 'tooth': 'fa-tooth',
            'eye': 'fa-eye', 'radio': 'fa-x-ray',
            'lab': 'fa-vials', 'derma': 'fa-hand-dots'
        };

        document.querySelectorAll('.icon-container').forEach(container => {
            const name = container.dataset.serviceName.toLowerCase();
            const icon = container.querySelector('i');
            let found = 'fa-stethoscope';

            for (let key in iconMap) {
                if (name.includes(key)) { found = iconMap[key]; break; }
            }
            icon.className = `fas ${found}`;
        });
    });
</script>
@endpush