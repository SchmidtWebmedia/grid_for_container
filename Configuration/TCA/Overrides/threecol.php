<?php

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
    new ContainerConfiguration(
        'threecol',
        'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:threecols.title',
        'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:threecols.description',
        [
            [
                ['name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.firstColumn', 'colPos' => 201],
                ['name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.secondColumn', 'colPos' => 202],
                ['name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.thirdColumn', 'colPos' => 203]
            ]]
        )
    )
        ->setIcon('grid-for-container-threecol')
        ->setBackendTemplate('EXT:grid_for_container/Resources/Private/Container/Templates/Backend.html')
        ->setSaveAndCloseInNewContentElementWizard(true)
);

$additionalColumns = [
    'grid_config' => [
        'label' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:grid.label.colratio',
        'config' => [
            'type' => 'select',
            'default' => '',
            'itemsProcFunc' => 'SchmidtWebmedia\\GridForContainer\\Controller\\GridController->getColumnOptions',
            'renderType' => 'selectSingle',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $additionalColumns
);

$showItem = $GLOBALS['TCA']['tt_content']['types']['threecol']['showitem'];

$GLOBALS['TCA']['tt_content']['types']['threecol']['showitem'] = '
 --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        grid_config;LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:grid.label.colratio,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';
