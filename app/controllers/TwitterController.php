<?php

class TwitterController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
        $pseudos    = Name::all();
        return View::make('twitter', compact('pseudos'));
    }

    public function search($pseudo)
    {
        $db_name        = Name::where('screen_name', '=', $pseudo)->first();
        $pseudos        = Name::all();
        $twitter        = Tweet::where('name_id', '=', $db_name->id)->paginate(20);
        return View::make('twitter', compact('twitter', 'pseudos'))->with(['name'=>$pseudo]);

    }

    public function show()
    {
        $pseudos        = Name::all();
        $name           = Input::get('pseudo');
        $db_name        = Name::where('screen_name', '=', $name)->first();

        if(isset($db_name->screen_name) && strtolower( $name ) == strtolower( $db_name->screen_name ))
        {
            // Le pseudo existe déjà dans la BDD, on affiche directement
            $twitter = Tweet::where('name_id', '=', $db_name->id)->paginate(20);
            return View::make('twitter', compact('twitter', 'pseudos'))->with(['name'=>$name]);

        }else{

            $author = Twitter::getUserTimeline(array('screen_name'=>$name, 'count'=>1));
            if(isset($author->errors))
            {
                $erreur = 'Il n\'existe pas d\'utilisateur au nom de '.$name;
                return View::make('twitter')->with(['name'=>$name , 'erreur'=>$erreur]);

            }else{
                // Le pseudo n'existe pas dans la base de donnée, on créé une entrée et on récupère ses tweets favoris
                Name::create(array(
                    'id_str'            =>  $author[0]->user->id_str,
                    'screen_name'       =>  $author[0]->user->screen_name,
                    'name'              =>  $author[0]->user->name,
                    'profile_image_url' =>  $author[0]->user->profile_image_url
                    ));

                $name_id        = Name::where('screen_name', '=', $author[0]->user->screen_name)->first();
                $req_twitter    = Twitter::getFavorites(array('screen_name' => $name, 'count' => 200, 'format' => 'object'));
                if(isset($req_twitter->errors)){
                    echo 'Trop de requête, veuillez patienter.';
                    exit();
                }

                foreach ($req_twitter as $key => $value) {
                    Tweet::create(array(
                        'name_id'           =>  $name_id->id,
                        'id_str'            =>  $value->id_str,
                        'screen_name'       =>  $value->user->screen_name,
                        'name'              =>  $value->user->name,
                        'profile_image_url' =>  $value->user->profile_image_url,
                        'text'              =>  $value->text,
                        'date_tweet'        =>  $value->created_at
                    ));
                }
                $twitter    = Tweet::where('name_id', '=', $name_id->id)->paginate(20);
                $pseudos    = Name::all();
                return View::make('twitter', compact('twitter', 'pseudos'))->with(['name'=>$name]);
            }
        }
	}
}
