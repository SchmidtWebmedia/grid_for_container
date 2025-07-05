<?php

declare(strict_types=1);

namespace SchmidtWebmedia\GridForContainer\Controller;

use SchmidtWebmedia\GridForContainer\Utility\JsonUtility;

class GridController
{
    private static ?array $GridConfiguration = null;

    public function getColumnOptions(array &$config) : array {
        return $this->getColumnRatio($config);
    }

    private static function readJSON() : void {
        if(self::$GridConfiguration === null) {
            self::$GridConfiguration = JsonUtility::readJSON();
        }
    }

    private function getColumnRatio($config) : array {
        self::readJSON();
        $fieldName = $config['row']['CType'][0];
        $columnRatioList = [];

        if($fieldName === 'container') {
            return $this->getContainerRatio($config);
        }

        if(isset(self::$GridConfiguration['cols'][0][$fieldName])) {
            foreach (self::$GridConfiguration['cols'][0][$fieldName] as $key => $value) {
                $columnRatioList[] = [$value['label'], $key];
            }
        } else {
            $columnRatioList[] = ['missing config', 0];
        }

        $config['items'] = array_merge($config['items'], $columnRatioList);
        return $config;
    }

    private function getContainerRatio($config) : array {
        self::readJSON();
        $containerConfigurations = [];
        foreach (self::$GridConfiguration['container'] as $key => $value) {
            $containerConfigurations[] = [$value['label'], $key];
        }

        $config['items'] = array_merge($config['items'], $containerConfigurations);
        return $config;
    }
}
