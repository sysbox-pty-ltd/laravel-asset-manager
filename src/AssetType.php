<?php
/**
 * Created by PhpStorm.
 * User: helin16
 * Date: 2020-05-15
 * Time: 10:50
 */

namespace Sysbox\LaravelAssetManager;


use Sysbox\LaravelBaseEntity\BaseModel;
use Sysbox\LaravelAssetManager\Facades\LaravelAssetManager;

class AssetType extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'path'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assetTypes';

    /**
     * Scope of name.
     *
     * @param $query
     * @param $name
     *
     * @return mixed
     */
    public function scopeOfName($query, $name)
    {
        return $query->where('name', $name);
    }

    /**
     * temporary asset type
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeOfTmp($query) {
        return $this->scopeOfName($query, LaravelAssetManager::getTempAssetTypeName());
    }
}