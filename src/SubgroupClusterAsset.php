<?php

namespace koputo\leaflet\plugins\subgroup;

use yii\web\AssetBundle;

class SubgroupClusterAsset extends AssetBundle
{
    public $depends = [
        'dosamigos\leaflet\LeafLetAsset',
        ];

    public $css = [
    ];

    public $js = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        $this->js = [
            'js/subgroup.js',
            'js/markercluster.js',
        ];
        $this->css = ['css/MarkerCluster.css'];
    }


}