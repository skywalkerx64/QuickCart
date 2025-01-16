<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
  use SoftDeletes;

  public $table = 'permissions';


  public const ACTION_GRANT = "grant";
  public const ACTION_REVOKE = "revoke";
  public const ACTION_TOGGLE = "toggle";
  public const ACTION_ACTIVATE = "activate";
  public const ACTION_DESACTIVATE = "desactivate";

  public const MANAGE_ACTIONS = [
    self::ACTION_GRANT,
    self::ACTION_REVOKE,
    self::ACTION_TOGGLE,
    self::ACTION_ACTIVATE,
    self::ACTION_DESACTIVATE
  ];

  public $casts = [
    'default_roles' => 'array'
];

  protected $fillable = [
    'title',
    'action',
    'resource',
    'is_active',
    'description',
    'module',
    'default_roles',
  ];

  public function roles()
  {
    return $this->belongsToMany(Role::class, 'permission_role')
      ->withPivot('is_active');
  }

  protected function serializeDate(DateTimeInterface $date)
  {
    return $date->format(config('panel.datetime_format'));
  }
}
