<?php
namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Blog\Models\Favorite as Post;

use Modules\Xot\Models\Policies\XotBasePolicy;

class FavoritePolicy extends XotBasePolicy {

    function noMoreFavorite($user,$post){
        return true;
    }
}