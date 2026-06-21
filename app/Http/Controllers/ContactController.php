<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // استدعاء موديل الرسائل عشان نكلم قاعدة البيانات
use App\Models\Service;        // استدعاء موديل الأقسام والخدمات

class ContactController extends Controller
{
    /**
     * 1. دالة عرض صفحة اتصل بنا (مع جلب الأقسام ديناميكياً)
     */
    public function index()
    {
        // جلب جميع الأقسام الفعالة من قاعدة البيانات مرتبة أبجدياً
        $services = Service::where('status', 'active')->orderBy('service_name', 'asc')->get();

        // فتح ملف الـ Blade الصحيح وتمرير الأقسام له
        return view('frontend.contact', compact('services')); 
    }

    /**
     * 2. دالة استقبال بيانات الفورم وحفظها في قاعدة البيانات
     */
    public function store(Request $request)
    {
        // خطوة التأكيد (Validation): بنجبر المستخدم يدخل بيانات صحيحة
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255', // الاسم مطلوب
            'email'      => 'required|email',          // الإيميل مطلوب وبصيغة صحيحة
            'phone'      => 'nullable|string',         // الهاتف اختياري
            'department' => 'nullable|string',         // القسم اختياري
            'message'    => 'required|string',         // نص الرسالة مطلوب
        ]);

        // حفظ البيانات المتأكدين منها في جدول قاعدة البيانات فوراً
        ContactMessage::create($validatedData);

        // ارجع للمستخدم في نفس الصفحة وقوله "رسالتك وصلت بنجاح"
        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}