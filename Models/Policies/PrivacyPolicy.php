<?php
namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Blog\Models\Privacy as Post; 

use Modules\Xot\Models\Policies\XotBasePolicy;

class PrivacyPolicy extends XotBasePolicy{
    
}
