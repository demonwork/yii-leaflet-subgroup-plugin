<?php

namespace koputo\leaflet\plugins\subgroup;


use dosamigos\leaflet\layers\FeatureGroup;
use dosamigos\leaflet\LeafLet;
use yii\web\JsExpression;

/**
 * SubGroup
 *
 */

/**
 * @property string $events
 * @property string $name
 */
class Subgroup extends FeatureGroup
{
//    use PopupTrait;
    private $_name = null;
    private $_title = null;

    /**
     * @var array the event handlers for the underlying LeafletJs featureGroup JS plugin.
     * Please refer to the [LeafLetJs::featureGroup](http://leafletjs.com/reference.html#featuregroup)
     * js api object options for possible events.
     */
    public $clientEvents = [];

    public $markerClusterGroup;

    /**
     * @return JsExpression
     */
//    public function encode()
//    {
//        $js = [];
//        $layers = $this->getLayers();
//        $name = $this->name;
//        $map = $this->map;
//        foreach ($layers as $layer) {
//            $js[] = $layer->encode();
//        }
//
//        $initJs = "L.featureGroup.subGroup($this->markerClusterGroup)" . $this->getEvents() . ($map !== null ? ".addTo($map);" : "");
//
//        if (empty($name)) {
//            $js[] = $initJs . ($map !== null ? "" : ";");
//        } else {
//            $js[] = "var $name = $initJs" . ($map !== null ? "" : ";");
//        }
//        return new JsExpression(implode("\n", $js));
//    }

    /**
     * @return string the processed js events
     */
    protected function getEvents()
    {
        $js = [];
        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = ".on('$event', $handler)";
            }
        }
        return !empty($js) ? implode("\n", $js) : "";
    }

    /**
     * @inheritdoc
     */
//    public function oneLineEncode()
//    {
//        $map = $this->map;
//        $layers = $this->getLayers();
//        $layersJs = [];
//        /** @var \dosamigos\leaflet\layers\Layer $layer */
//        foreach ($layers as $layer) {
//            $layer->setName(null);
//            $layersJs[] = $layer->encode();
//        }
//        $js = "L.featureGroup.subGroup([" . implode(",", $layersJs) . "])" .
//            $this->getEvents() .
//            ($map !== null ? ".addTo($map);" : "");
//        return new JsExpression($js);
//    }

    /**
     * Returns the name of the layer.
     *
     * @param boolean $autoGenerate whether to generate a name if it is not set previously
     *
     * @return string name of the layer.
     */
    public function getName($autoGenerate = false)
    {
        if ($autoGenerate && $this->_name === null) {
            $this->_name = LeafLet::generateName();
        }
        return $this->_name;
    }

    /**
     * Sets the name of the layer.
     *
     * @param string $value name of the layer.
     */
    public function setName($value)
    {
        $this->_name = $value;
    }

    /**
     * Returns the name of the layer.
     *
     * @param boolean $autoGenerate whether to generate a name if it is not set previously
     *
     * @return string name of the layer.
     */
    public function getTitle($autoGenerate = false)
    {
        if ($autoGenerate && $this->_title === null) {
            $this->_title = LeafLet::generateName();
        }
        return $this->_title;
    }

    /**
     * Sets the name of the layer.
     *
     * @param string $value name of the layer.
     */
    public function setTitle($value)
    {
        $this->_title = $value;
    }
}
