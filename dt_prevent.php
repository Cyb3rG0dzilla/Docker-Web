$basepath = '/foo/bar/baz/';
$realBase = realpath($basepath);

$userpath = $basepath . $_GET['path'];
$realUserPath = realpath($userpath);

if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
    //Directory Traversal!
} else {
    //Good path!
}
