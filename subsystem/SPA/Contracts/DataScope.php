<?php

namespace Subsystem\SPA\Contracts;

interface DataScope
{
    public function handle();
    public function scopes() : array;
}
