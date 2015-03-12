<?php

namespace Controller;
use View\View;
use User\User;
use Project\Project;
/**
 * Description of Controller
 *
 * @author Максим
 */
class Controller 
{
    public $request = array();
    
    function __construct( &$request ) 
    {
        $this -> request = (empty($request)) ? array() : $request;
        if ( array_key_exists('action', $this -> request ) &&
                is_callable( array($this, ucfirst( $this -> request['action'] ) ) ) )
        {
            $this -> {$this -> request['action']}(  );
        }
        else if ( array_key_exists('action', $this -> request ) && 
                !is_callable( array($this, ucfirst( $this -> request['action'] ) ) ) )
        {
            $this -> __404();
        }
        else if ( is_callable( array($this, 'Index' ) ) )
        {
            $this -> Index();
        }
    }
    
    private function Index() 
    {
        View:: Instance() -> tpl = 'User_OpenAccount';
        View :: Instance() -> Output();
    }
    
    /**
     * Test function for call class method
     */
//    private function Call()
//    {
//        if ( !array_key_exists( 'method', $this -> request ) )
//            return FALSE;
//        list( $class, $method ) = explode( "::", $this -> request['method'] );
//        require_once "/../Model/$class/$class.class.php";
//        $class = "\\" . $class . "\\" . $class;
//        $c = new $class();
//        
//        $param = array_key_exists( 'param', $this -> request )
//                ? explode(",", $this -> request['param'])
//                : '';
//        call_user_func( $c->$method() );
//    }
    
    /*
     * User section
     */
    
    private function UserLogin()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Open() )
        {
            $tpl = $User -> GetTemplate();
        }
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserLogout()
    {
        User :: Instance() -> Account() -> Close();
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserCreate()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Create() ) 
        {
            $tpl = $User -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output();
    }    
    
    private function UserSelect()
    {
        if ( ($User = ( User :: Instance() -> Account( ( new User() ) -> Account() ) ) ) )
        {
            $User -> Open();
            $tpl = $User -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output(  );
    }
    
    private function UserAuthentificate()
    {
        ;
    }
    
    /**
     * Project section
     */
    
    private function ProjectOpen()
    {
        ;
    }

    private function ProjectAccept()
    {
        ;
    }
    
    private function ProjectClose()
    {
        ;
    }    

    private function ProjectSelect()
    {
        ;
    }
    
    private function ProjectLeave() //покинуть проект
    {
        ;
    }
    
    /**
     * Test section
     */
    
    private function Test()
    {
        
        $user = User::Instance();
        $user -> Fill( ['id'=>9, 'name'=>'User', 'family'=>'Group', 'address'=>'Home'] );
        
        $db = new \Database\Database();
        $Query = $db -> Build()
               //-> select( $user )
               -> addpart( 'INSERT INTO', 'user')
               -> addpart( 'FIELD', $user)
               -> addpart( 'VALUES', ['?','?','?','?'] );
        $db -> apply( $Query );      
        $db -> param = array_values( get_object_vars( $user ) );
        //$db -> execute();        

        $Query = $db -> Build()
               //-> select( $user )
               -> addpart( 'UPDATE', 'user')
               -> addpart( 'SET', ['id=?', 'name=?', 'family=?', 'address=?'])
               -> addpart( 'WHERE', ['id=10'] );
        $db -> apply( $Query );
        $db -> param = [1, 'User', 'Group', 'Home'];
        $db -> execute();        
        
        $Query = $db -> Build()
               //-> select( $user )
               -> addpart( 'SELECT', $user )
               -> addpart( 'FROM', ['user'] )
               -> addpart( 'WHERE', ['id > 0'] )
               -> addpart( 'LIMIT', [10] );
        $db -> apply( $Query );
        $res = $db -> query();
        var_dump($res);
    }
    
    /**
     * Error section
     */
    
    private function __404()
    {
        View:: Instance() -> tpl = 'Error_e404';
        View :: Instance() -> Output(  );
    }
}