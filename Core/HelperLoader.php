<?php

foreach (glob(__DIR__ . "/../helpers/*.php") as $filename)
{
    include_once $filename;
}