<?php

declare(strict_types=1);

namespace SchmidtWebmedia\GridForContainer\ViewHelpers;

use SchmidtWebmedia\GridForContainer\Utility\JsonUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class GridViewHelper extends AbstractViewHelper
{
    private static ?array $GridConfiguration = null;

    public function initializeArguments() : void {
        $this->registerArgument('type', 'string', 'container, col, row or colLabel', true);
        $this->registerArgument('layout', 'string', 'Name of CType');
        $this->registerArgument('colIndex', 'int', 'Index of Column');
        $this->registerArgument('grid_config', 'int', 'Stored Grid_config value');
    }

    /**
     * @return string
     */
    public function render() : string {
        self::readJSON();
        switch($this->arguments['type']) {
            case 'row':
                return self::$GridConfiguration['row'][0]['class'] ?? 'row';
            case 'col':
                $layout = $this->arguments['layout'];
                $ratio = $this->arguments['grid_config'];
                $index = $this->arguments['colIndex'];
                return self::$GridConfiguration['cols'][0][$layout][$ratio]['class'][$index] ?? 'col';
            case 'colLabel':
                $layout = $this->arguments['layout'];
                $ratio = $this->arguments['grid_config'];
                return self::$GridConfiguration['cols'][0][$layout][$ratio]['label'] ?? 'auto';
            case 'containerLabel':
                $ratio = $this->arguments['grid_config'];
                return self::$GridConfiguration['container'][$ratio]['label'] ?? 'Container';
            case 'container':
                $ratio = $this->arguments['grid_config'];
                return self::$GridConfiguration['container'][$ratio]['class'] ?? 'container';
        }

        return $this->arguments['type'];
    }

    private static function readJSON() : void {
        if(self::$GridConfiguration === null) {
            self::$GridConfiguration = JsonUtility::readJSON();
        }
    }
}
