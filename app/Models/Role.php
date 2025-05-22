<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'name',
        'code',
    ];

    
    const ACCESS_ROLE_LIST = "ACCESS_ROLE_LIST";
    const ACCESS_ROLE_ADD = "ACCESS_ROLE_ADD";
    const ACCESS_ROLE_EDIT = "ACCESS_ROLE_EDIT";
    const ACCESS_ROLE_DETAIL = "ACCESS_ROLE_DETAIL";
    const ACCESS_ROLE_DELETE = "ACCESS_ROLE_DELETE";

    const ACCESS_USER_LIST = "ACCESS_USER_LIST";
    const ACCESS_USER_ADD = "ACCESS_USER_ADD";
    const ACCESS_USER_EDIT = "ACCESS_USER_EDIT";
    const ACCESS_USER_DETAIL = "ACCESS_USER_DETAIL";
    const ACCESS_USER_DELETE = "ACCESS_USER_DELETE";

    const ACCESS_DASHBOARD = "ACCESS_DASHBOARD";

    public function user() {
        return $this->hasMany(User::class);
    }

    public static function getRoleAccess()
    {
        return [
            (object)[
                "key" => self::ACCESS_ROLE_LIST,
                "label" => __("access_control.role_list"),
            ],
            (object)[
                "key" => self::ACCESS_ROLE_ADD,
                "label" => __("access_control.role_add"),
            ],
            (object)[
                "key" => self::ACCESS_ROLE_EDIT,
                "label" => __("access_control.role_edit"),
            ],
            (object)[
                "key" => self::ACCESS_ROLE_DETAIL,
                "label" => __("access_control.role_detail"),
            ],
            (object)[
                "key" => self::ACCESS_ROLE_DELETE,
                "label" => __("access_control.role_delete"),
            ],
        ];
    }

    public static function getDashboard()
    {
        return [
            (object)[
                "key" => self::ACCESS_DASHBOARD,
                "label" => __("access_control.dashboard"),
            ]
        ];
    }

    public static function getUserAccess()
    {
        return [
            (object)[
                "key" => self::ACCESS_USER_LIST,
                "label" => __("access_control.user_list"),
            ],
            (object)[
                "key" => self::ACCESS_USER_ADD,
                "label" => __("access_control.user_add"),
            ],
            (object)[
                "key" => self::ACCESS_USER_EDIT,
                "label" => __("access_control.user_edit"),
            ],
            (object)[
                "key" => self::ACCESS_USER_DETAIL,
                "label" => __("access_control.user_detail"),
            ],
            (object)[
                "key" => self::ACCESS_USER_DELETE,
                "label" => __("access_control.user_delete"),
            ],
        ];
    }

    public static function getAccessControlList()
    {
        return[
            trans("access_control.dashboard") => self::getDashboard(),
            trans("access_control.role") => self::getRoleAccess(),
            trans("access_control.user") => self::getUserAccess(),
        ];
    }


    public function checkAccess($check_access_control)
    {
        if (!Auth::user()) {
            return redirect('auth.logout');
        }

        $access_control_list = json_decode($this->access_control);
        if (!in_array($check_access_control, $access_control_list)) {
            return false;
        } else {
            return true;
        }
    }
}
