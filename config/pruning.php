<?php

use App\Enums\UserGroups;

return [

    /*
    |--------------------------------------------------------------------------
    | User Pruning
    |--------------------------------------------------------------------------
    | Users Account Must Be At least x Days Old
    | Users Last Login At least x Days Ago
    | Soft Delete Disabled Users After x Days (Pruned Group)
    | Groups That Can Be Auto Disabled [DEFAULT] (User, PowerUser, ExtremeUser, Pijavka)
    */
    'user_pruning' => false,
    'account_age'  => 90,
    'last_login'   => 90,
    'soft_delete'  => 120,
    'group_ids'    => [UserGroups::USER, UserGroups::POWERUSER, UserGroups::EXTREMEUSER, UserGroups::PIJAVKA],
];
