<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub\File;

/**
 * StandardOpf
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class StandardOpf
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
<package xmlns="http://www.idpf.org/2007/opf" version="3.0" xml:lang="ja" unique-identifier="unique-id" prefix="ebpaj: http://www.ebpaj.jp/">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/">
        <dc:identifier id="unique-id">-</dc:identifier>
        <dc:language>ja</dc:language>
        <dc:title id="title">title</dc:title>
        <meta property="dcterms:modified">2016-10-01T00:00:00Z</meta>
    </metadata>
    <manifest>
        <item media-type="application/xhtml+xml" id="toc" href="navigation-documents.xhtml" properties="nav"/>
XML;

        foreach (glob(Constants::PATH_IMAGE . '/*.jpg') as $each) {
            $filename = pathinfo($each, PATHINFO_FILENAME);
            $xml .= <<<XML
        <item media-type="application/xhtml+xml" id="p-{$filename}" href="xhtml/{$filename}.xhtml"/>
        <item media-type="image/jpeg" id="{$filename}" href="image/{$filename}.jpg" />

XML;
        }

        $xml .= <<<XML
    </manifest>
    <spine>

XML;

        foreach (glob(Constants::PATH_IMAGE . '/*.jpg') as $k => $v) {
            $filename = pathinfo($each, PATHINFO_FILENAME);
            $filename = pathinfo($v, PATHINFO_FILENAME);
            $xml .= <<<XML
        <itemref idref="p-{$filename}" />

XML;
        }

        $xml .= <<<XML
    </spine>
</package>
XML;

        $this->writer->write($xml);
    }
}
