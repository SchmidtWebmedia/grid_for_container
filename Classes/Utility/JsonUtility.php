<?php

declare(strict_types=1);

namespace SchmidtWebmedia\GridForContainer\Utility;

use JsonException;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class JsonUtility
{
    private const EXT_KEY = 'grid_for_container';

    private static function getLogger(): LoggerInterface {
        return GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
    }

    public static function readJSON() : ?array {
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
                $absolutePath = GeneralUtility::getFileAbsFileName($path);
                if(!file_exists($absolutePath)) {
                    self::logMessage('Grid configuration file could not be found', [
                        'path' => $path,
                        'absolutePath' => $absolutePath
                    ]);

                    return null;
                }
                try {
                    $jsonInput = file_get_contents($absolutePath);
                    return json_decode($jsonInput, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException $e) {
                    self::logMessage('Grid configuration file could not be read', [
                        'path' => $path,
                        'absolutePath' => $absolutePath,
                        'exception' => $e,
                    ]);
                    return null;
                }

            }
        }
        return null;
    }

    private static function logMessage(string $message, array $additional = []) : void {
        self::getLogger()->error($message, $additional);
    }
}
