<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * 可批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'account_id',
        'category_id',
        'member_id',    
        'time',
        'note',
    ];

    /**
     * 应该被转换为原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'time' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * 获取交易所属的用户。
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取交易所属的账户。
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);    
    }
    /**
     * 获取交易所属的类别。
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 获取交易所属的成员（如果有）。
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class); 
    }

    /**
     * 获取交易所属的标签（如果有）。
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
