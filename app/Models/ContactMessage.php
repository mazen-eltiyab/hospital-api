<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // ⬇️ ضف السطر ده هنا بالظبط جوه الكلاس ⬇️
    protected $fillable = ['name', 'email', 'phone', 'department', 'message', 'is_read'];
}