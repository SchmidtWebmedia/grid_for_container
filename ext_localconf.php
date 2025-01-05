<?php
// register icons
use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
$iconRegistry->registerIcon(
    'grid-for-container-onecol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/onecol.svg']
);$iconRegistry->registerIcon(
    'grid-for-container-twocol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/twocol.svg']
);
$iconRegistry->registerIcon(
    'grid-for-container-threecol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/threecol.svg']
);
$iconRegistry->registerIcon(
    'grid-for-container-fourthcol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/fourthcol.svg']
);
$iconRegistry->registerIcon(
    'grid-for-container-fivecol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/fivecol.svg']
);
$iconRegistry->registerIcon(
    'grid-for-container-sixcol',
    BitmapIconProvider::class,
    ['source' => 'EXT:grid_for_container/Resources/Public/Icons/sixcol.svg']
);
