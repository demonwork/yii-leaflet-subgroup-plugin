<?php

namespace koputo\leaflet\plugins\subgroup;

use yii\web\AssetBundle;

/**
 * LeafLetAsset Registers widget requires files. Please, use the following in order to override bundles for CDN:
 *
 * ```
 *  return [
 *        // ...
 *        'components' => [
 *            'bundles' => [
 *                'dosamigos\leaftlet\LeafLetAsset' => [
 *                    'sourcePath' => null,
 *                    'js' => [ 'http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js' ],
 *                    'css' => [ 'http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css' ]
 *                ]
 *            ]
 *        ]
 *    ]
 * ```
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\leaflet
 */
class SubgroupClusterAsset extends AssetBundle
{
    public $depends = ['dosamigos\leaflet\LeafLetAsset'];

    public $css = [
    ];

    public $js = [
        'yii\web\JqueryAsset',
        'subgroup.js'
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        $this->js = ['js/subgroup.js'];
    }


}