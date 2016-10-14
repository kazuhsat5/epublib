<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub\Util;

/**
 * FileSystem
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class FileSystem
{
    /**
     * ディレクトリの作成を行う
     *
     * @param String $pathname パス名
     * @return boolean
     */
    public static function mkdir($pathname)
    {
        return mkdir($pathname, 0777, true);
    }

    /**
     * ディレクトリの削除を行う
     *
     * @param String $pathname パス名
     * @return boolean
     */
    public static function rmdir($pathname)
    {
        return system(sprintf('rm -rf %s', $pathname));
    }

    /**
     * ファイルの削除を行う
     *
     * @param String $pathname パス名
     * @return boolean
     */
    public static function rm($pathname)
    {
        return system(sprintf('rm %s', $pathname));
    }

    /**
     * ファイルのコピーを行う
     *
     * @param String $from コピー元
     * @param String $to   コピー先
     * @return boolean
     */
    public static function copy($from, $to)
    {
        return system(sprintf('cp -R %s %s', $from, $to));
    }
}
