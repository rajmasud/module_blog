<?php
namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;

//----- models------
//use Modules\Blog\Models\Post;
//use Modules\Blog\Models\PostRelatedPivot;
use Modules\Blog\Models\Privacy;
use Modules\Blog\Models\PrivacyMorph;

//------ traits ---
use Modules\Theme\Services\ThemeService;

trait PrivacyTrait{
	/* --- da fare
	public function privacy(){
        try {
            return $this->hasMany(ProfilePrivacyChrono::class, 'auth_user_id', 'auth_user_id');
        } catch (\Exception $ex) {
            $databaseManager = new DatabaseManager();
            $response = $databaseManager->migrateAndSeed();
            die("DB AGGIORNATO! RIPETERE OPERAZIONE");
        }
    }
	*/
    public function privacies(){ // controllare con linkedtrait  
        $related=Privacy::class;
        if(is_string($related)){
            $pivot=$related.'Morph';
        }else{
            $pivot=get_class($related).'Morph';
        }
        //ddd($pivot);
        $name='post';
        $pivot_table=with(new $pivot)->getTable();
        $pivot_fields=with(new $pivot)->getFillable();
        $foreignPivotKey = 'post_id';
        $relatedPivotKey = 'related_id';
        $parentKey = 'post_id';
        $relatedKey = 'post_id';
        $inverse=false;
        //$related_table=with(new $related)->getTable();
        //return $this->morphRelated($related);
        ///*
        $user=\Auth::user();
        $auth_user_id=is_object($user)?$user->auth_user_id:'NO_SET';
        return $this->morphToMany($related, $name,$pivot_table, $foreignPivotKey,
                                $relatedPivotKey, $parentKey,
                                $relatedKey, $inverse)
                    ->using($pivot)
                    ->withPivot($pivot_fields)
                    ->wherePivot('auth_user_id', $auth_user_id)
                    ->withTimestamps()
        ;
    }
    /*
    public function getFormValue($key){
        ddd($key);//firstname
    }
    */

    public function getPrivaciesAttribute(){
        return $this->getRelationValue('privacies')->keyBy('post_id');
    }
}