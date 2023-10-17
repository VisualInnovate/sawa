<?php

namespace Modules\Evaluation\Http\Controllers\Repository;

use Modules\Evaluation\Entities\sideProfile;

class SideprofileRepository
{
    public static function getSideProfilesWithEvalautions()
    {
        return sideProfile::selectRaw("side_profiles.title side_profile_title , evaluations.title evaluation_title , side_profiles.id side_profile_id  , evaluations.id evaluation_id")
            ->leftJoin("evaluations", "side_profiles.id", '=', 'evaluations.side_profile_id')
            ->get();
    }
}
