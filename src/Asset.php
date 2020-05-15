<?php
/**
 * Created by PhpStorm.
 * User: helin16
 * Date: 2020-05-15
 * Time: 10:50
 */

namespace Sysbox\LaravelAssetManager;


use Sysbox\LaravelAssetManager\Observers\AssetObserver;
use Sysbox\LaravelBaseEntity\BaseModel;

class Asset extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'file_name', 'file_size', 'mime_type', 'file_path'];
    /**
     * @var array
     */
    protected $appends = ['url', 'relative_path'];
    /**
     * @var array
     */
    protected $hidden = ['type', 'file_name', 'file_path', 'type_id'];

    /**
     * The type of the asset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(AssetType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    /**
     * @param $query
     * @param $typeId
     * @return mixed
     */
    public function scopeOfTypeId($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    /**
     * @param $query
     * @param $filePath
     * @return mixed
     */
    public function scopeOfFilePath($query, $filePath)
    {
        return $query->where('file_path', $filePath);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOfImage($query)
    {
        return $query->where('mime_type', 'like', LaravelAssetManager::getMimeTypeForImage());
    }

    /**
     * Getting the url attribute.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        if (trim($this->id) === '') {
            return '';
        }
        return LaravelAssetManager::getUrlForAsset($this);
    }

    /**
     * Getting the full path of the asset.
     *
     * @return string
     */
    public function getRelativePathAttribute()
    {
        if (!$this->type instanceof AssetType) {
            return trim($this->file_path);
        }
        return trim($this->type->path . DIRECTORY_SEPARATOR . $this->file_path);
    }


    /**
     * Attaching an asset to a BaseModel.
     *
     * @param BaseModel $model
     * @param string $comments
     *
     * @return mixed
     */
    public function attachTo(BaseModel $model, $comments = '', $order = 0)
    {
        return Attachment::create([
            'model_id' => $model->id,
            'model_type' => get_class($model),
            'comments' => trim($comments),
            'asset_id' => $this->id,
            'order' => $order,
        ]);
    }

    /**
     * Register AssetObserver
     */
    public static function boot()
    {
        parent::boot();
        if (static::$byPassObserver !== true) {
            self::observe(new AssetObserver());
        }
    }
}