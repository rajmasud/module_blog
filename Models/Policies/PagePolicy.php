<?php
namespace Modules\Blog\Models\Policies;

/*
use App\User;
use App\Post;
*/
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Page as Post;
//use Modules\Food\Models\Post;
use Modules\LU\Models\User;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PagePolicy  extends XotBasePolicy{
}
