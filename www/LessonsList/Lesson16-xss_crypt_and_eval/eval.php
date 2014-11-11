<?php

require_once '../common.php';

eval('print("Eval !!!"); $files = scandir("../"); print("<pre>"); print_r($files);');

p(br(2));