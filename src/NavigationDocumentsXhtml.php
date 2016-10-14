<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub;

/**
 * NavigationDocumentsXhtml
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class NavigationDocumentsXhtml
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
     * @return boolean
     */
    public function write()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops" xml:lang="ja">
    <head>
        <meta charset="UTF-8"/>
        <title>Navigation</title>
    </head>
    <body>
        <nav epub:type="toc" id="toc">
            <h1>Navigation</h1>
            <ol>

XML;

        foreach (glob(Constants::PATH_IMAGE . '/*.jpg') as $each) {
            $filename = pathinfo($each, PATHINFO_FILENAME);
            $xml .= <<<XML
                <li><a href="xhtml/{$filename}.xhtml">{$filename}</a></li>

XML;
        }

        $xml .= <<<XML
            </ol>
        </nav>
        <nav epub:type="landmarks" id="guide">
            <h1>Guide</h1>
            <ol>

XML;

        foreach (glob(Constants::PATH_IMAGE . '/*.jpg') as $each) {
            $filename = pathinfo($each, PATHINFO_FILENAME);
            $xml .= <<<XML
                <li><a epub:type="cover" href="xhtml/{$filename}.xhtml">{$filename}</a></li>

XML;
        }

            $xml .= <<<XML
            </ol>
        </nav>
    </body>
</html>
XML;

        $this->writer->write($xml);
    }
}
