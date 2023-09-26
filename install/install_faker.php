<?php 

try{
    $command2 = "composer require fzaninotto/faker";
    exec($command2, $output, $returnVar);
    
    echo $returnVar;
    if ($returnVar === 0) {
        header('Location:../index.php?faker_success');
        exit;
    
    } else {
        echo "Package installation failed. Check the Composer output for details.";
        header('Location:index.php?faker_failed');
        exit;
    }
}
catch(Exception $e){
    echo "Faker Installation Error. Check Your Internt." . $e->getMessage();
}

