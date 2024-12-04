<?php
$cTypes = [
    'onecol' => [
        'columns' => [
            'firstColumn'
        ],
        'title' => 'onecols',
        'label' => 'firstColumn'
    ],
    'twocol' => [
        'columns' => [
            'firstColumn',
            'secondColumn'
        ],
        'title' => 'twocols',
        'label' => 'secondColumn'
    ],
    'threecol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn'
        ],
        'title' => 'threecols',
        'label' => 'thirdColumn'
    ],
    'fourthcol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn',
            'fourthColumn'
        ],
        'title' => 'fourcols',
        'label' => 'fourthColumn'
    ],
];

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$registry = GeneralUtility::makeInstance(Registry::class);

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

ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);


foreach ($cTypes as $cType => $value) {

    $columns = [];

    for ($i = 0; $i < count($value['columns']); $i++) {
        $columns[] = [
            'name' => 'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:backend.' . $value['columns'][$i],
            'colPos' => (200 + ($i + 1))
        ];
    }

    $registry->configureContainer(
        (
            new ContainerConfiguration(
                $cType,
                'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:'.$value['title'].'.title',
                'LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:'.$value['title'].'.description',
                [
                    $columns
                ]
            )
        )
            ->setIcon('grid-for-container-'.$cType)
            ->setGridTemplate('EXT:grid_for_container/Resources/Private/Container/Templates/Grid.html')
            ->setSaveAndCloseInNewContentElementWizard(true)
    );

    $showItem = $GLOBALS['TCA']['tt_content']['types'][$cType]['showitem'];

    $GLOBALS['TCA']['tt_content']['types'][$cType]['showitem'] = '
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
}





