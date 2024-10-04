<?php

declare(strict_types=1);

namespace SchmidtWebmedia\GridForContainer\Controller;

use SchmidtWebmedia\GridForContainer\Utility\JsonUtility;

class GridController
{
    private static ?array $GridConfiguration = null;

    public function getColumnOptions($config) : array {
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
}
