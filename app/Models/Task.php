<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // app/Models/Task.php

    protected $fillable = ['title', 'description', 'priority', 'deadline', 'status', 'document_path', 'user_id', 'assigned_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
