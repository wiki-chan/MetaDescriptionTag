<?php

class MetaDescriptionTag {

    /**
     * Sets up the MetaDescriptionTag Parser hook and system messages
     */
    public static function setupMetaDescriptionTagParserHooks( &$parser ) {
            $parser->setHook( 'metadesc', 'MetaDescriptionTag::renderMetaDescriptionTag' );
            return true;
    }
     
    /**
     * Renders the <metadesc> tag.
     * @param String $text Incoming text - should always be null or empty (passed by value).
     * @param Array $params Attributes specified for tag - must contain 'content' (passed by value).
     * @param Parser $parser Reference to currently running parser (passed by reference).
     * @return String Always empty.
     */
    public static function renderMetaDescriptionTag( $text, $params, Parser $parser, PPFrame $frame) {
     
            // Short-circuit with error message if content is not specified.
            if ( !isset($text) ) {
                    return
                            '<div class="errorbox">'.
                            wfMsgForContent('metadescriptiontag-missing-content').
                            '</div>';
            }
     
            return '<!-- META_DESCRIPTION '.base64_encode( htmlspecialchars( $text ) ).' -->';
    }
     
    /**
     * Adds the <meta> description to document head.
     * Usage: $wgHooks['OutputPageBeforeHTML'][] = 'insertMetaDescription';
     * @param OutputPage $out Handle to an OutputPage object - presumably $wgOut (passed by reference).
     * @param String $text Output text.
     * @return Boolean Always true to allow other extensions to continue processing.
     */
    public static function insertMetaDescription( $out, $text ) {
     
            // Extract meta description
            if (preg_match_all(
                    '/<!-- META_DESCRIPTION ([0-9a-zA-Z\\+\\/]+=*) -->/m', 
                    $text, 
                    $matches)===false
            ) return true;
            $data = $matches[1];
     
            // Merge description data into OutputPage as meta tag
            foreach ($data AS $item) {
                    $content = @base64_decode($item);
                    if ($content) 
                            $out->addMeta( 'description', $content );
            }
            return true;
    }
}