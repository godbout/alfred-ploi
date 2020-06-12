<?php

use Godbout\Alfred\Ploi\Workflow;

require __DIR__ . '/../vendor/autoload.php';


if (getenv('next') === 'do') {
    $result = Workflow::do();

    if (getenv('action') !== 'exit') {
        print Workflow::notify($result);
    }
} else {
    print Workflow::currentMenu();
}
