<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub;

/**
 * WriterInterface
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
interface WriterInterface
{
    /**
     * 文字列を書き込む
     *
     * @param String $str 文字列
     * @return boolean
     */
    public function write($str);
}
