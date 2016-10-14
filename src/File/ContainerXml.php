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
 * ContainerXml
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class ContainerXml
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
        $xml = new \SimpleXMLElement('<container />');
        $xml->addAttribute('version', '1.0');
        $xml->addAttribute('xmlns', 'urn:oasis:names:tc:opendocument:xmlns:container');

        $rootfiles = $xml->addChild('rootfiles');

        $rootfile = $rootfiles->addChild('rootfile');
        $rootfile->addAttribute('full-path', 'item/standard.opf');
        $rootfile->addAttribute('media-type', 'application/oebps-package+xml');

        $this->writer->write($xml->asXML());
    }
}
