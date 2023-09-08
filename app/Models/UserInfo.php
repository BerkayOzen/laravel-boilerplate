<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory,
        Uuid,
        SoftDeletes;

    const TABLE_NAME = 'user_infos';
    const ATTR_UUID = 'uuid';
    const ATTR_USER_ID = 'user_id';
    const ATTR_FIRST_NAME = 'first_name';
    const ATTR_LAST_NAME = 'last_name';
    const ATTR_GENDER = 'gender';
    const ATTR_BIRTHDAY = 'birthday';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $fillable = [
        self::ATTR_UUID,
        self::ATTR_USER_ID,
        self::ATTR_FIRST_NAME,
        self::ATTR_LAST_NAME,
        self::ATTR_GENDER,
        self::ATTR_BIRTHDAY,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
