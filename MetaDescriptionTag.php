<?php
/*
 * MetaDescriptionTag.php - A MediaWiki tag extension for adding <meta> description to a page.
 * https://www.mediawiki.org/wiki/Extension:MetaDescriptionTag
 * @author Joshua C. Lerner, Fenet-
 * @version 0.4
 * @copyright Copyright (C) 2007-8 Joshua C. Lerner, Jim R. Wilson, Dror Snir
 * @license The MIT License - http://www.opensource.org/licenses/mit-license.php 
 * -----------------------------------------------------------------------
 * Description:
 *     This is a MediaWiki extension which adds support for injecting a <meta> description tag
 *     into the page header.
 * Requirements:
 *     MediaWiki 1.25.1 or higher
 *     PHP 5.x or higher
 * Installation:
 *     1. Drop this script (MetaDescriptionTag.php) in $IP/extensions, or command
 *         git clone https://github.com/wiki-chan/MetaDescriptionTag.git 
 *         Note: $IP is your MediaWiki install dir.
 *     2. Enable the extension by adding this line to your LocalSettings.php:
 *         require_once('extensions/MetaDescriptionTag.php');
 * Usage:
 *     Once installed, you may utilize MetaDescriptionTag by adding the <metadesc> tag to articles:
 *         <metadesc> Home page for the MetaDescriptionTag MediaWiki extension </metadesc>
 * Version Notes:
 *     version 0.1:
 *         Initial release.
 *     version 0.2:
 *         Change syntax to <metadesc>some content</metadesc> to support template variable substitution.
 *     version 0.3:
 *          Fix i18n to work with v1.16+, sanitize output using htmlspecialchars()
 *     version 0.4:
 *          Fix extension to work with v1.25.1+
 * 
 * -----------------------------------------------------------------------
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy 
 * of this software and associated documentation files (the "Software"), to deal 
 * in the Software without restriction, including without limitation the rights to 
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of 
 * the Software, and to permit persons to whom the Software is furnished to do 
 * so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all 
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES 
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING 
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR 
 * OTHER DEALINGS IN THE SOFTWARE. 
 * -----------------------------------------------------------------------
 */
 
if( !defined( 'MEDIAWIKI' ) ) {
        echo "This file is part of MediaWiki, it is not a valid entry point.\n";
        exit( 1 );
}
 
# Credits
$wgExtensionCredits['parserhook'][] = array(
        'name' => 'MetaDescriptionTag',
        'author' => array('Joshua C. Lerner', 'Fenet-'),
        'url' => 'https://github.com/wiki-chan/MetaDescriptionTag',
        'descriptionmsg' => 'metadescriptiontag-desc',
        'version' => '0.4',
        'license-name' => 'MIT'
);
 
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$wgAutoloadClasses['MetaDescriptionTag'] = $dir . 'MetaDescriptionTag.class.php';
//$wgExtensionMessagesFiles['MetaDescriptionTag'] = $dir . 'MetaDescriptionTag.i18n.php';
$wgMessagesDirs['MetaDescriptionTag'] = $dir . 'i18n';
$wgHooks['ParserFirstCallInit'][] = 'MetaDescriptionTag::setupMetaDescriptionTagParserHooks';
$wgHooks['OutputPageBeforeHTML'][] = 'MetaDescriptionTag::insertMetaDescription'; // Attach post-parser hook to extract metadata and alter headers
