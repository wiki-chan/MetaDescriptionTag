# MetaDescriptionTag
A MediaWiki tag extension for adding <meta> description to a page.
This extension is forked from (Mediawiki Extension:MetaDescriptionTag)[https://www.mediawiki.org/wiki/Extension:MetaDescriptionTag]

## Description
This is a MediaWiki extension which adds support for injecting a <meta> description tag into the page header.

## Requirements
MediaWiki 1.25.1 or higher
PHP 5.x or higher

## Installation
1. Drop this script (MetaDescriptionTag.php) in $IP/extensions, or command
    git clone https://github.com/wiki-chan/MetaDescriptionTag.git 
    Note: $IP is your MediaWiki install dir.
2. Enable the extension by adding this line to your LocalSettings.php:
    require_once('extensions/MetaDescriptionTag.php');

## Usage
Once installed, you may utilize MetaDescriptionTag by adding the <metadesc> tag to articles:

```html
    <metadesc> Home page for the MetaDescriptionTag MediaWiki extension </metadesc>
```

## Version Notes
version 0.1:
    Initial release.
version 0.2:
    Change syntax to <metadesc>some content</metadesc> to support template variable substitution.
version 0.3:
     Fix i18n to work with v1.16+, sanitize output using htmlspecialchars()
version 0.4:
     Fix extension to work with v1.25.1+
