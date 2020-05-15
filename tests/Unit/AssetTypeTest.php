<?php
/**
 * Created by PhpStorm.
 * User: helin16
 * Date: 2020-05-15
 * Time: 12:48
 */
use Tests\TestCase;
use Sysbox\LaravelAssetManager\AssetType;
use Sysbox\LaravelAssetManager\Facades\LaravelAssetManager;

class AssetTypeTest extends TestCase
{
    /**
     * @test
     */
    public function anAssetTypeWillHaveProperFieldsAfterInitiated() {
        $assetType = new AssetType();

        $this->assertEquals('assetTypes', $assetType->getTable());
        $this->assertEquals(['name', 'path'], $assetType->getFillable());
    }

    /**
     * @test
     */
    public function anAssetTypeCanScopeOfNameSuccessfully() {
        $assetType = new AssetType();
        $expectedReturn = 'fake_scope_return';
        $name = 'fake_name';

        $mock = \Mockery::mock('TestQuery');
        $mock->shouldReceive('where')->withArgs(['name', $name])->once()->andReturn($expectedReturn);

        $actual = $assetType->scopeOfName($mock, $name);

        $this->assertEquals($expectedReturn, $actual);
    }
    /**
     * @test
     */
    public function anAssetTypeCanScopeOfTmpSuccessfully() {
        $assetType = new AssetType();
        $expectedReturn = 'fake_scope_return';
        $name = 'fake_name';

        LaravelAssetManager::shouldReceive('getTempAssetTypeName')->withNoArgs()->once()->andReturn($name);
        $mock = \Mockery::mock('TestQuery');
        $mock->shouldReceive('where')->withArgs(['name', $name])->once()->andReturn($expectedReturn);

        $actual = $assetType->scopeOfTmp($mock);

        $this->assertEquals($expectedReturn, $actual);
    }
}