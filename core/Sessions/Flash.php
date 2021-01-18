<?php 
namespace Synext\Session;

use Synext\Session\Session;

class Flash{

    /**
     * Send flash  sucesss mesaage to session
     *
     * @param string $message
     * @return void
     */

    public static function success(string $message){
        Session::check();
        $_SESSION['flash']['succes'] = $message;
    }

    /**
     * Send flash error mesaage to session
     *
     * @param string $message
     * @return void
     */
    public static function erreur(string $message){
        Session::check();
        $_SESSION['flash']['error'] = $message;
    }

    /**
     * Destroy flash mesaage 
     * @return void
     */
    public static function destroy(){
        Session::check();
        return Session::destroy('flash');
    }
}