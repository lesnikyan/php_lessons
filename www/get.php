<?php

include 'common.php';

# http://www.php.test/get.php?context[]=user&context[]=view&context[]=123
# http://www.php.test/get.php?controller=user&method=view&params[]=123
# http://www.php.test/get.php?user&view&123

p('проверка');
p($_GET);