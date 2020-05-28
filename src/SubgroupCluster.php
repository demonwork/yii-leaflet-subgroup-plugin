<?php

namespace koputo\leaflet\plugins\subgroup;

use dosamigos\leaflet\Plugin;
use yii\web\JsExpression;

/**
 * SubGroup provides beautiful animated SubGroup clustering functionality for Leaflet.
 *
 *
 * @property string $pluginName
 * @property string $name
 * @property array $subGroups
 */
class SubgroupCluster extends Plugin
{

    private $_subGroups = [];

    /**
     * Returns the name of the plugin
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:subgroup';
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return static the plugin
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        SubgroupClusterAsset::register($view);
        return $this;
    }

    /**
     * @param Subgroup $subGroup
     *
     * @return static the plugin
     */
    public function addSubGroup(Subgroup $subGroup)
    {
        $this->_subGroups[] = $subGroup;
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression|string
     */
    public function encode()
    {
        /** @var Subgroup[] $subGroups */
        $subGroups = $this->getSubGroups();

        $js = [];
        $options = $this->getOptions();
        $name = $this->getName(true);
        $map = $this->map;

        $js[] = "var $name = L.markerClusterGroup($options);";
        $js[] = "$name.addTo($map);";

        if ($subGroups) {
            foreach ($subGroups as $subGroup) {
                $js[] = "var {$subGroup->getName(true)} = L.featureGroup.subGroup($name);";
                foreach ($subGroup->getLayers() as $marker) {
                    $markerName = $marker->getName();
                    $marker->setName(null);
                    $js[] = "var {$markerName} = {$marker->encode()};";
                    $marker->setName($markerName);
                    $js[] = "{$markerName}.addTo({$subGroup->getName(true)});";
                }

                $js[] = "ctrlLayer.addOverlay({$subGroup->getName(true)}, '{$subGroup->getTitle(true)}');";
                $js[] = "{$subGroup->getName()}.addTo($map);";
            }
        }

        return new JsExpression(implode("\n", $js));
    }

    /**
     * @return array the markers added
     */
    public function getSubGroups()
    {
        return $this->_subGroups;
    }

}
