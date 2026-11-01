<?php
namespace Behin\SimpleWorkflow\Models\Entities;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\SoftDeletes;
class Goods_out extends Model { use SoftDeletes; public $incrementing = false; protected $keyType = 'string'; public $table = 'wf_entity_goods_out'; protected $fillable = ['created_by','updated_by','contributers']; protected static function boot() { parent::boot(); static::creating(function ($model) { $model->id = $model->id ?? substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'),0,10); }); }  }
