<?php

function getFirstLastName($fullName)
{
    return strpos($fullName, ' ') !== false ? explode(' ', $fullName, 2) : [$fullName, ''];
}
