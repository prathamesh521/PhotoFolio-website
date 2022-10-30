<?php
/*
Name: Dashboard
Slug: company
Description: The settings found under "Lightspeed" have been created to work along with our "Lightspeed WordPress theme". Because of this they have not been tested with other themes and using these settings should be done with care as they could have detrimental effects on your website.
Position: 10
Theme: 
*/
$slug = AREOI__PREPEND . ( !empty( $section ) ? '-' . $section : '' )  . '-company-';

return array(
	array(
		'label' => 'Branding',
		'name' => '',
		'variable' => '',
		'row' => 'default',
		'input' => 'header',
		'default' => '',
		'description' => '',
		'allow_reset' => true,
		'options' => array()
	),
	array(
		'label' => 'Logo (Dark)',
		'name' => $slug . 'logo-dark',
		'variable' => '',
		'row' => 'default',
		'input' => 'image',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Logo (Light)',
		'name' => $slug . 'logo-light',
		'variable' => '',
		'row' => 'default',
		'input' => 'image',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Icon (Dark)',
		'name' => $slug . 'icon-dark',
		'variable' => '',
		'row' => 'default',
		'input' => 'image',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Icon (Light)',
		'name' => $slug . 'icon-light',
		'variable' => '',
		'row' => 'default',
		'input' => 'image',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Heading Font URL',
		'name' => $slug . 'heading-font-url',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => 'Enter your own font url. If filled in the font stylesheet will be added to the head section of your site. This can be used to add any Google or Typekit fonts.',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Body Font URL',
		'name' => $slug . 'body-font-url',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => 'Enter your own font url. If filled in the font stylesheet will be added to the head section of your site. This can be used to add any Google or Typekit fonts.',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Company',
		'name' => '',
		'variable' => '',
		'row' => 'default',
		'input' => 'header',
		'default' => '',
		'description' => '',
		'allow_reset' => true,
		'options' => array()
	),
	array(
		'label' => 'Company Name',
		'name' => $slug . 'name',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Company Address',
		'name' => $slug . 'address',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Company Email',
		'name' => $slug . 'email',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Company Phone',
		'name' => $slug . 'phone',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Social Media',
		'name' => '',
		'variable' => '',
		'row' => 'default',
		'input' => 'header',
		'default' => '',
		'description' => '',
		'allow_reset' => true,
		'options' => array()
	),
	array(
		'label' => 'Facebook URL',
		'name' => $slug . 'facebook',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Twitter URL',
		'name' => $slug . 'twitter',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Instagram URL',
		'name' => $slug . 'instagram',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'YouTube URL',
		'name' => $slug . 'youtube',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'LinkedIn URL',
		'name' => $slug . 'linkedin',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'TikTok URL',
		'name' => $slug . 'tiktok',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
	array(
		'label' => 'Pinterest URL',
		'name' => $slug . 'pinterest',
		'variable' => '',
		'row' => 'default',
		'input' => 'text',
		'default' => '',
		'description' => '',
		'allow_reset' => false,
		'options' => array()
	),
);