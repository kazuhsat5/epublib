<?php

namespace Jcomi\Epub;

use Jcomi\Epub\Util;
use Jcomi\Epub\File;

require_once __DIR__ . '/vendor/autoload.php';

// EPUB化する画像ファイルが格納されたディレクトリのパスを取得
$source = $argv[1]; # 引数指定

// ディレクトリの作成
foreach ([
    Constants::PATH_META_INF,
    Constants::PATH_ITEM,
    Constants::PATH_IMAGE,
    Constants::PATH_XHTML
] as $each) {
    Util\FileSystem::mkdir($each);
}

// EPUB元となる画像ファイルのコピーを行う
Util\FileSystem::copy($source . '/*.jpg', Constants::PATH_IMAGE); # JPEGのみ

// EPUB化に必要なファイルを生成
(new File\Mimetype(new Writer(Constants::PATH_MIMETYPE)))->write();
(new File\ContainerXml(new Writer(Constants::PATH_CONTAINER_XML)))->write();
(new File\StandardOpf(new Writer(Constants::PATH_STANDARD_OPF)))->write();
(new File\NavigationDocumentsXhtml(new Writer(Constants::PATH_NAV_DOC_XHTML)))->write();
foreach (glob(Constants::PATH_IMAGE . '/*.jpg') as $each) {
    $filename = pathinfo($each, PATHINFO_FILENAME);
    (new File\ItemXhtml(new Writer(sprintf(Constants::PATH_XHTML, $filename))))->write($filename);
}

// EPUB出力
Util\Epub::create();

// ディレクトリ・ファイルの削除
Util\FileSystem::rm(Constants::PATH_MIMETYPE);

foreach ([
    Constants::PATH_META_INF,
    Constants::PATH_ITEM
] as $each) {
    Util\FileSystem::rmdir($each);
}
