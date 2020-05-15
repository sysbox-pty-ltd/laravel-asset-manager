<?php
namespace Sysbox\LaravelAssetManager\Observers;
use Carbon\Carbon;
use Sysbox\LaravelAssetManager\AssetType;
use Sysbox\LaravelAssetManager\Exceptions\Exception;
use Sysbox\LaravelAssetManager\Facades\LaravelAssetManager;
use Sysbox\LaravelBaseEntity\BaseModel;
use Sysbox\LaravelBaseEntity\BaseModelObserver;

/**
 * Created by PhpStorm.
 * User: helin16
 * Date: 2020-05-15
 * Time: 12:32
 */

class AssetObserver extends BaseModelObserver
{
    /**
     * Watching the creating event for Asset.
     *
     * @param BaseModel $model The asset model.
     *
     * @throws Exception
     */
    public function creating(BaseModel $baseModel) {
        parent::creating($baseModel);

        if(!$baseModel->type instanceof AssetType) {
            throw new Exception('Invalid asset type[' . get_class($baseModel->type). '] signed!');
        }
        // gen file path when no path specified
        $baseModel->file_path = LaravelAssetManager::createAssetFilePathBeforeSavingToDB($baseModel);
    }
}