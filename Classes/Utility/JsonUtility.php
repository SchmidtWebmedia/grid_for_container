<?php

declare(strict_types=1);

namespace SchmidtWebmedia\GridForContainer\Utility;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class JsonUtility
{
    private const EXT_KEY = 'grid_for_container';

    public static function readJSON() : mixed {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        if($extensionConfiguration !== null) {
            $gridTheme = $extensionConfiguration->get(self::EXT_KEY, 'gridTheme');

            $path = null;
            switch ($gridTheme) {
                case 'bs3':
                    $path = 'EXT:grid_for_container/Resources/Private/Grid/Bootstrap3.json';
                    break;
                case 'bs45':
                    $path = 'EXT:grid_for_container/Resources/Private/Grid/Bootstrap4_5.json';
                    break;
                case 'custom':
                    $path = $extensionConfiguration->get(self::EXT_KEY, 'gridConfig');
                    break;
            }

            if($path !== null) {
                $jsonInput = file_get_contents(GeneralUtility::getFileAbsFileName($path));
                return json_decode($jsonInput, true);
            }
        }
        return null;
    }
}
