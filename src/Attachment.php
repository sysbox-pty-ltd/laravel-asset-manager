<?php
/**
 * Created by PhpStorm.
 * User: helin16
 * Date: 2020-05-15
 * Time: 10:51
 */

namespace Sysbox\LaravelAssetManager;


use Sysbox\LaravelBaseEntity\BaseModel;

class Attachment extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asset_id', 'model_id', 'model_type', 'comments', 'order'];

    /**
     * @var array
     */
    protected $hidden = ['model_type', 'model_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The asset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    /**
     * Get all of the owning models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Scoping the BaseModel.
     *
     * @param $query
     * @param BaseModel $model
     *
     * @return mixed
     */
    public function scopeOfModel($query, BaseModel $model)
    {
        return $query->where(function ($que) use ($model) {
            return $que->where('model_id', $model->id)
                ->where('model_type', get_class($model));
        });
    }

    /**
     * Scoping the asset type.
     *
     * @param $query
     * @param AssetType $assetType
     *
     * @return mixed
     */
    public function scopeOfAssetType($query, AssetType $assetType)
    {
        return $query->whereHas('asset', function ($que) use ($assetType) {
            return $que->where('assets.type_id', '=', $assetType->id);
        });
    }

    /**
     * Scoping the asset.
     *
     * @param $query
     * @param Asset $asset
     *
     * @return mixed
     */
    public function scopeOfAsset($query, Asset $asset) {
        return $this->scopeOfAssetId($query, $asset->id);
    }

    /**
     * Scoping of asset id.
     *
     * @param $query
     * @param $assetId
     *
     * @return mixed
     */
    public function scopeOfAssetId($query, $assetId)
    {
        return $query->where('asset_id', $assetId);
    }

}