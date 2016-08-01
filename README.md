# What's this?
A pair of command-line scripts exposing the patch_make and patch_apply functions of 
[yetanotherape/diff-match-patch](https://packagist.org/packages/yetanotherape/diff-match-patch).

Use these to see what patch this algorithm will generate given two differing files, or
whether a given patch file applies as expected to a source file.

# Usage
* You'll need to `composer install` in the root directory of the project first of all.

## patch_make.php
`php patch_make.php -a /path/to/original/sourcefile -b /path/to/modified/sourcefile`

The resulting patch is dumped to stdout; you may want to redirect to another file
for further examination or to use it with patch_apply.php.

## patch_apply.php
`php patch_apply.php --patch=/path/to/patch/file --target=/path/to/unpatched/sourcefile`

The result is dumped to stdout; you may want to redirect to another file for further 
examination.

If any of the blobs in the patch failed to apply, the script simply outputs "Patch did 
not apply successfully!" instead.
