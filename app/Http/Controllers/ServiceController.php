<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Doctor; 

class ServiceController extends Controller
{
    /**
     * 1. [أدمن] عرض قائمة كل الخدمات في لوحة التحكم
     */
    public function index()
    {
        // جلب الخدمات مع الدكاترة المرتبطين بها
        $services = Service::with('doctors')->latest()->get(); 
        return view('admin.services', compact('services')); 
    }

    /**
     * 2. [أدمن] عرض صفحة فورم إضافة خدمة جديدة
     */
    public function create()
    {
        return view('admin.add-services'); 
    }

    /**
     * 3. [أدمن] استقبال بيانات الفورم وحفظ خدمة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255|unique:services,service_name',
            'description'  => 'nullable|string',
            'status'       => 'required|in:active,inactive'
        ]);

        Service::create([
            'service_name' => $request->service_name,
            'description'  => $request->description,
            'status'       => $request->status,
        ]);

        return redirect()->route('services.index')->with('success', 'Service added successfully!');
    }

    /**
     * 4. [أدمن] عرض صفحة التعديل لخدمة معينة
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $doctors = Doctor::all(); // جلب الدكاترة لعرضهم في قائمة الاختيار عند التعديل
        
        return view('admin.edit-service', compact('service', 'doctors'));
    }

    /**
     * 5. [أدمن] حفظ التعديلات الجديدة للخدمة
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|in:active,inactive',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * 6. [أدمن] حذف الخدمة نهائياً من قاعدة البيانات
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }

    /**
     * 7. [المستخدم بره] عرض صفحة الخدمات الخارجية للمرضى (الديناميكية)
     * تم تغيير الاسم من index إلى showFrontendServices لمنع التضارب والأخطاء
     */
    public function showFrontendServices()
    {
        // جلب الخدمات الفعالة فقط لعرضها للمستخدمين بره
        $services = Service::where('status', 'active')->orderBy('service_name', 'asc')->get();
        
        return view('frontend.services', compact('services'));
    }
}