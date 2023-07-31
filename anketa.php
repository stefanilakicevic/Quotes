<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (isset($_POST['citat'])) 
    {
        $izabraniCitat = $_POST['citat'];
        echo "Izabrali ste citat sa vrednošću: $izabraniCitat";
    }
}


























?>