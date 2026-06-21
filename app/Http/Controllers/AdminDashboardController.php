<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // استدعاء موديل الرسائل للتعامل مع قاعدة البيانات

class AdminDashboardController extends Controller
{
    /**
     * عرض صفحة الرسائل للأدمن (تدعم البحث، الفلترة، والـ Pagination)
     */
    public function index(Request $request)
    {
        // بدء استعلام نظيف من جدول الرسائل
        $query = ContactMessage::query();

        // [نظام البحث]: البحث باسم المرسل أو بمحتوى الرسالة
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // [نظام الفلترة]: تصفية الرسائل حسب الحالة (مقروءة / غير مقروءة)
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'read') {
                $query->where('is_read', true);
            } elseif ($request->status == 'unread') {
                $query->where('is_read', false);
            }
        }

        // جلب الرسائل وترتيبها من الأحدث للأقدم مع تقسيمها لـ 10 رسائل في الصفحة
        $messages = $query->latest()->paginate(10);

        // [العداد الديناميكي]: حساب عدد الرسائل غير المقروءة فقط لإظهارها في الـ Badge
        $unreadCount = ContactMessage::where('is_read', false)->count();

        // تمرير البيانات إلى صفحة الـ Blade الخاصة بالأدمن
        return view('admin.messages', compact('messages', 'unreadCount'));
    }

    /**
     * فتح رسالة معينة وعرض تفاصيلها (وتغيير حالتها تلقائياً إلى مقروءة)
     */
    public function show(int $id)
    {
        // البحث عن الرسالة بالـ ID وفي حال عدم وجودها يظهر خطأ 404 تلقائياً
        $message = ContactMessage::findOrFail($id);

        // إذا كانت الرسالة غير مقروءة، قم بتحديث حالتها فوراً إلى مقروءة
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        // إعادة حساب العداد الديناميكي بعد التحديث
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.show_message', compact('message', 'unreadCount'));
    }

    /**
     * حذف الرسالة نهائياً من قاعدة البيانات
     */
    public function destroy(int $id)
    {
        // البحث عن الرسالة وحذفها
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        // إعادة التوجيه لصفحة الرسائل مع رسالة تأكيد النجاح
        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully.');
    }
}