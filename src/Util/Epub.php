<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub\Util;

/**
 * Epub
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class Epub
{
    /**
     * EPUBファイルを作成する
     *
     * @return boolean
     */
    public function create()
    {
        system('zip -0 -X book.epub mimetype');
        system('zip -rg book.epub META-INF');
        system('zip -rg book.epub item');
    }
}
