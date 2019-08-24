<?php

namespace Orca\Audience\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Orca\Audience\Models\Audience::class,
        \Orca\Audience\Models\AudienceAddress::class,
        \Orca\Audience\Models\AudienceGroup::class,
    ];
}