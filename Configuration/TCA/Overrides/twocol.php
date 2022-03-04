<?php
\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
    (
    new \B13\Container\Tca\ContainerConfiguration(
        'twocol',
        'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:twocols.title',
        'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:twocols.description',
        [
            [
                ['name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.firstColumn', 'colPos' => 201],
                ['name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.secondColumn', 'colPos' => 202]
            ]]
        )
    )
        ->setIcon('grid-for-container-twocol')
        ->setBackendTemplate('EXT:grid_for_container/Resources/Private/Container/Templates/Backend.html')
        ->setSaveAndCloseInNewContentElementWizard(false)
);

$additionalColumns = [
    'grid_config' => [
        'label' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:grid.label.colratio',
        'config' => [
            'type' => 'select',
            'default' => '',
            'itemsProcFunc' => 'SchmidtWebmedia\\GridForContainer\\Controller\\GridController->getTwoColumnOptions',
            'renderType' => 'selectSingle',
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $additionalColumns
);

$showItem = $GLOBALS['TCA']['tt_content']['types']['twocol']['showitem'];

$GLOBALS['TCA']['tt_content']['types']['twocol']['showitem'] = '
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


