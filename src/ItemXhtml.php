<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub;

/**
 * ItemXhtml
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class ItemXhtml
{
    /**
     * Writer
     *
     * @var String
     */
    private $writer;

    /**
     * コンストラクタ
     *
     * @param Jcomi\Epub\Writer $writer
     * @return void
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * 書き出す
     *
     * @param String $filename
     * @return boolean
     */
    public function write($filename)
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops" xml:lang="ja">
    <head>
        <meta charset="UTF-8"/>
        <title>{$filename}</title>
    </head>
    <body>
        <div class="main">
            <p><img src="../image/{$filename}.jpg" alt=""/></p>
        </div>
    </body>
</html>
XML;

        $this->writer->write($xml);
    }
}
