<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub;

class Constants
{
    /**
     * ディレクトリパス
     *
     * @constant
     */
    const PATH_MIMETYPE   = 'mimetype';
    const PATH_META_INF   = 'META-INF';
    const PATH_ITEM       = 'item';
    const PATH_IMAGE      = self::PATH_ITEM . '/image';
    const PATH_ITEM_XHTML = self::PATH_ITEM . '/xhtml';

    /**
     * ファイルパス
     *
     * @constant
     */
    const PATH_CONTAINER_XML = self::PATH_META_INF . '/container.xml';
    const PATH_STANDARD_OPF  = self::PATH_ITEM . '/standard.opf';
    const PATH_NAV_DOC_XHTML = self::PATH_ITEM . '/navigation-documents.xhtml';

    /**
     * Mimeタイプ
     *
     * @constant
     */
    const MIMETYPE = 'application/epub+zip';
}
