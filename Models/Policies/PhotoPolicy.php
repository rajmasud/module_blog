<?php
namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Photo as Post;
use Modules\LU\Models\User;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PhotoPolicy extends XotBasePolicy
{
    use HandlesAuthorization;

   
}
