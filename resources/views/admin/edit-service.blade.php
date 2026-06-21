<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preclinic - Edit Service</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* نفس ستايلات صفحة الإضافة اللي عندك */
        body { background-color: #f8fafb; font-family: 'Inter', sans-serif; }
        .page-wrapper { margin-left: 240px; padding: 90px 30px 40px; }
        .form-label { font-weight: 700; font-size: 0.9rem; color: #2d3e50; margin-bottom: 8px; display: block; }
        .form-input { width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 16px; outline: none; }
        .btn-primary { background-color: #009efb; color: white; padding: 12px 32px; border-radius: 16px; font-weight: 700; border: none; }
        .btn-secondary { background-color: #f1f5f9; color: #475569; padding: 12px 32px; border-radius: 16px; font-weight: 700; border: 1px solid #e2e8f0; text-decoration: none; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <a href="{{ route('services.index') }}" class="bg-white p-3 rounded-2xl shadow-sm border border-gray-200 hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Edit Service</h2>
                        <p class="text-gray-500 font-medium">Update details for: {{ $service->service_name }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-6">
                            <label class="form-label">Service Name</label>
                            <input type="text" name="service_name" class="form-input" value="{{ $service->service_name }}" required>
                        </div>

                        <div class="mb-6">
                            <label class="form-label">Assign Doctor</label>
                            <select name="doctor_id" class="form-input" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ $service->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-input">
                                <option value="active" {{ $service->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $service->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t pt-6">
                            <a href="{{ route('services.index') }}" class="btn-secondary">Cancel</a>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Update Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>