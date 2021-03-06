<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/*
 * Add Field to System Categories
 */
$temporaryColumns = array(
	'tx_hwtsyscategories_selectable' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:hwt_syscategories/Resources/Private/Language/locallang_db.xlf:sys_category.tx_hwtsyscategories_selectable',
		'config' => array (
			'type' => 'check',
		)
	),

	'tx_hwtsyscategories_images' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:hwt_syscategories/Resources/Private/Language/locallang_db.xlf:sys_category.tx_hwtsyscategories_images',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'tx_hwtsyscategories_images',
			array(
				'appearance' => array(
					'headerThumbnail' => array(
						'width' => '100',
						'height' => '100',
					),
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'foreign_types' => array(
					'0' => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					),
					\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
						'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
					)
				),
				'maxitems' => 1,
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		)
	),

    'tx_hwtsyscategories_link' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:hwt_syscategories/Resources/Private/Language/locallang_db.xlf:sys_category.tx_hwtsyscategories_link',
        'config' => array(
            'type' => 'input',
            'size' => 50,
            'max' => 1024,
            'eval' => 'trim',
            'wizards' => array(
                'link' => array(
                    'type' => 'popup',
                    'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                    'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                    'module' => array(
                        'name' => 'wizard_link',
                    ),
                    'JSopenParams' => 'width=800,height=600,status=0,menubar=0,scrollbars=1'
                )
            ),
            'softref' => 'typolink'
        )
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'sys_category',
	$temporaryColumns,
	TRUE
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
	'sys_category',
	'1',
	'tx_hwtsyscategories_selectable',
	'after:hidden'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'sys_category',
	'tx_hwtsyscategories_images',
	'',
	'after:description'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'sys_category',
	'tx_hwtsyscategories_link',
	'',
	'after:tx_hwtsyscategories_images'
);