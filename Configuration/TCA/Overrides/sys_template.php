<?php

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() < 13) {
    ExtensionManagementUtility::addStaticFile('grid_for_container', 'Configuration/TypoScript', 'Grid for Container');
}
