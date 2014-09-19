<?php

class TwitterFav
{

    public static function updateFavoris($db_name, $pseudo){

            $twitter        = Tweet::where('name_id', '=', $db_name->id)->orderBy('id_str','desc')->first();
            $req_twitter    = Twitter::getFavorites(array(  'since_id'=>$twitter->id_str,
                                                            'screen_name' => $pseudo,
                                                            'format' => 'object'
                                                            ));
            if(isset($req_twitter->errors)){
                echo 'Trop de requete, veuillez patienter.';
                exit();
            }

            if ( !$req_twitter ){
                $t = Tweet::where('name_id', '=', $db_name->id)->orderBy('id_str','desc')->paginate(20);
                return $t;
            }else {
                echo 'pas pareil '.$twitter->id_str.' // '.$req_twitter[0]->id;;
                TwitterFav::addFavoris($req_twitter, $db_name);
                $t = Tweet::where('name_id', '=', $db_name->id)->orderBy('id_str','desc')->paginate(20);
                return $t;
            }
            return;
    }

    public static function createUser($author){
        $retour = Name::create(array(
                    'id_str'            =>  $author[0]->user->id_str,
                    'screen_name'       =>  $author[0]->user->screen_name,
                    'name'              =>  $author[0]->user->name,
                    'profile_image_url' =>  $author[0]->user->profile_image_url
                    ));
        return $retour;
    }

    public static function addFavoris($req_twitter, $name_id){
        foreach ($req_twitter as $key => $value) {
            Tweet::create(array(
                'name_id'           =>  $name_id->id,
                'id_str'            =>  $value->id,
                'screen_name'       =>  $value->user->screen_name,
                'name'              =>  $value->user->name,
                'profile_image_url' =>  $value->user->profile_image_url,
                'text'              =>  $value->text,
                'date_tweet'        =>  $value->created_at
            ));
            $max_id = $value->id;
        }
        return $max_id;
    }
}