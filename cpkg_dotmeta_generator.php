<?php
require 'vendor/autoload.php';

use Ulrichsg\Getopt;

$opt = new Getopt\Getopt(
  [
    (new Getopt\Option('a', null, Getopt\Getopt::REQUIRED_ARGUMENT))->setDescription('Path to file A'),
    (new Getopt\Option('b', null, Getopt\Getopt::REQUIRED_ARGUMENT))->setDescription('Path to file B'),
  ]
);

$opt->parse();

if (! is_readable($opt['a'])) {
  cli\err("Cannot read from \"${opt['a']}\n");
  exit(1);
}
if (! is_readable($opt['b'])) {
  cli\err("Cannot read from \"${opt['b']}\n");
  exit(1);
}

$a = file_get_contents($opt['a']);
$b = file_get_contents($opt['b']);

$hashes = [
  'initial-md5' => md5($a),
  'resulting-md5' => md5($b)
];

echo json_encode($hashes);
