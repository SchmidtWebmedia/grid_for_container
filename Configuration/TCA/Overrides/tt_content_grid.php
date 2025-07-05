<?php
$cTypes = [
    'onecol' => [
        'columns' => [
            'firstColumn'
        ],
        'title' => 'onecols',
        'label' => 'firstColumn',
        'isContainer' => false
    ],
    'twocol' => [
        'columns' => [
            'firstColumn',
            'secondColumn'
        ],
        'title' => 'twocols',
        'label' => 'secondColumn',
        'isContainer' => false
    ],
    'threecol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn'
        ],
        'title' => 'threecols',
        'label' => 'thirdColumn',
        'isContainer' => false
    ],
    'fourthcol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn',
            'fourthColumn'
        ],
        'title' => 'fourcols',
        'label' => 'fourthColumn',
        'isContainer' => false
    ],
    'fivecol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn',
            'fourthColumn',
            'fifthColumn'
        ],
        'title' => 'fivecols',
        'label' => 'fifthColumn',
        'isContainer' => false
    ],
    'sixcol' => [
        'columns' => [
            'firstColumn',
            'secondColumn',
            'thirdColumn',
            'fourthColumn',
            'fifthColumn',
            'sixthColumn'
        ],
        'title' => 'sixcols',
        'label' => 'sixthColumn',
        'isContainer' => false
    ],
    'container' => [
        'columns' => [
            'container'
        ],
        'title' => 'container',
        'label' => 'container',
        'isContainer' => true
    ]
];

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$registry = GeneralUtility::makeInstance(Registry::class);
$extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
$enabledColumnsString = $extensionConfiguration->get('grid_for_container', 'enabledColumns');
$enabledColumns = explode(',', $enabledColumnsString);

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
    if(!in_array($cType, $enabledColumns)) {
        continue;
    }
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

    $labelKey = $value['isContainer']
        ? 'grid.label.container_type'
        : 'grid.label.colratio';

    $GLOBALS['TCA']['tt_content']['types'][$cType]['showitem'] = '
 --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        grid_config;LLL:EXT:grid_for_container/Resources/Private/Language/locallang.xlf:'.$labelKey.',
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
