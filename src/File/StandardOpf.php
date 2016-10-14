<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub\File;

use Jcomi\Epub;

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
    public function __construct(Epub\WriterInterface $writer)
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
<package xmlns="http://www.idpf.org/2007/opf" version="3.0" xml:lang="ja" unique-identifier="unique-id" prefix="rendition: http://www.idpf.org/vocab/rendition/#">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/">
        <dc:identifier id="unique-id">-</dc:identifier>
        <dc:language>ja</dc:language>
        <dc:title id="title">title</dc:title>
        <meta property="dcterms:modified">2016-10-01T00:00:00Z</meta>
    </metadata>
    <manifest>
        <item media-type="application/xhtml+xml" id="toc" href="navigation-documents.xhtml" properties="nav"/>

XML;

        foreach (glob(Epub\Constants::PATH_IMAGE . '/*.jpg') as $k => $v) {
            $filename = pathinfo($v, PATHINFO_FILENAME);

            if ($k === 0) {
                $xml .= <<<XML
        <item media-type="application/xhtml+xml" id="p-{$filename}" href="xhtml/{$filename}.xhtml"/>
        <item media-type="image/jpeg" properties="cover" id="{$filename}" href="image/{$filename}.jpg" />

XML;
            } else {
                $xml .= <<<XML
        <item media-type="application/xhtml+xml" id="p-{$filename}" href="xhtml/{$filename}.xhtml"/>
        <item media-type="image/jpeg" id="{$filename}" href="image/{$filename}.jpg" />

XML;
            }
        }

        $xml .= <<<XML
    </manifest>
    <spine page-progression-direction ="rtl">

XML;

        foreach (glob(Epub\Constants::PATH_IMAGE . '/*.jpg') as $k => $v) {
            $filename = pathinfo($v, PATHINFO_FILENAME);
            if ($k === 0) {
                $xml .= <<<XML
        <itemref idref="p-{$filename}" properties="rendition:page-spread-center" />

XML;
            } elseif ($k % 2 && $k !== 1) {
                $xml .= <<<XML
        <itemref idref="p-{$filename}" properties="page-spread-left" />

XML;
            } else {
                $xml .= <<<XML
        <itemref idref="p-{$filename}" properties="page-spread-right" />

XML;
            }
        }

        $xml .= <<<XML
    </spine>
</package>
XML;

        $this->writer->write($xml);
    }
}
