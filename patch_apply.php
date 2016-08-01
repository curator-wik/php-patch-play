<?php
require 'vendor/autoload.php';

use DiffMatchPatch\DiffMatchPatch;
use Ulrichsg\Getopt;

$dmp = new DiffMatchPatch();

$opt = new Getopt\Getopt(
  [
    (new Getopt\Option('p', 'patch', Getopt\Getopt::REQUIRED_ARGUMENT))->setDescription('Path to patch file'),
    (new Getopt\Option('t', 'target', Getopt\Getopt::REQUIRED_ARGUMENT))->setDescription('File to apply patch onto'),
  ]
);

$opt->parse();

if (! is_readable($opt['patch'])) {
  cli\err("Cannot read from \"${opt['patch']}\n");
  exit(1);
}
if (! is_readable($opt['target'])) {
  cli\err("Cannot read from \"${opt['target']}\n");
  exit(1);
}

$patch = file_get_contents($opt['patch']);

list($result, $which) = $dmp->patch_apply($dmp->patch_fromText($patch), file_get_contents($opt['target']));

if (! array_reduce($which, function ($v) { return $v; }, TRUE)) {
  die ("Patch did not apply successfully!\n");
}

echo $result;
