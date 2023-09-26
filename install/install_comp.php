<?php
try {
    $command = 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"';
    exec($command, $output, $returnVar);
    exec('php composer-setup.php');
    unlink('composer-setup.php');

    if ($returnVar === 0) {
        header('Location: ../index.php?comp_success');
        exit;
    } else {
        header('Location: ../index.php?comp_failed');
        exit;
    }
} catch (Exception $e) {
    echo 'Composer installation failed check your internet.' . $e->getMessage();
}
