<?php

// register icons
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() < 13) {
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon('grid-for-container-onecol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/onecol.svg']);
    $iconRegistry->registerIcon('grid-for-container-twocol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/twocol.svg']);
    $iconRegistry->registerIcon('grid-for-container-threecol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/threecol.svg']);
    $iconRegistry->registerIcon('grid-for-container-fourthcol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/fourthcol.svg']);
    $iconRegistry->registerIcon('grid-for-container-fivecol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/fivecol.svg']);
    $iconRegistry->registerIcon('grid-for-container-sixcol', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/sixcol.svg']);
    $iconRegistry->registerIcon('grid-for-container-container', SvgIconProvider::class, ['source' => 'EXT:grid_for_container/Resources/Public/Icons/container.svg']);
}
