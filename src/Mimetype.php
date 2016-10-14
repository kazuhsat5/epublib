<?php

/**
 * EPUB制作ツール
 *
 * @link http://ebpaj.jp/counsel/guide 電書協 EPUB 3 制作ガイド
 * @copyright Copyright (C) 2015-2016 J-Comic Terrace Corporation. All Rights Reserved.
 */

namespace Jcomi\Epub;

/**
 * Mimetype
 *
 * @author kazuhsat <kazuhiro.sato@j-comi.co.jp>
 */
class Mimetype
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
        $this->writer->write(Constants::MIMETYPE);
    }
}
