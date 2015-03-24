<?php

namespace Controller;
use View\View,
    User\User;
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
        $this -> request = ( empty($request) ) ? array() : $request;

        $argc = array_key_exists( 'argc', $this -> request ) ? $this -> request['argc'] : "";
        $argv = array_key_exists( 'argv', $this -> request ) ? $this -> request['argv'] : "";

        if ( array_key_exists('action', $this -> request ) &&
                is_callable( array($this, ucfirst( $this -> request['action'] ) ) ) )
        {
            $this -> {$this -> request['action']}( $argc, $argv );
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
    
    /*
     * User section
     */
    
    private function Login()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Open() )
        {
            $tpl = $User -> GetTemplate();
        }
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function Logout()
    {
        $Account = User :: Instance() -> Account();
        $Account -> Close();
        
        $tpl = $Account -> GetTemplate();
        
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function Create( $argc, $argv = "" )
    {
        $Account = User :: Instance() -> Account();
        
        if ( $Account -> Create( $argc, $argv ) ) 
        {
            $tpl = $Account -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "User_CreateAccount" : $tpl;
        View :: Instance() -> Output();
    }    
    
//    private function Select()
//    {
//        if ( ($User = ( User :: Instance() -> Account( ( new User() ) -> Account() ) ) ) )
//        {
//            $User -> Open();
//            $tpl = $User -> GetTemplate();
//        }
//
//        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
//        View :: Instance() -> Output(  );
//    }
    
    private function Authentificate()
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
        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'INSERT INTO', 'user')
//               -> addpart( 'FIELD', $user)
//               -> addpart( 'VALUES', ['?','?','?','?'] );
//        $db -> Build( $Query );      
//        $db -> param = array_values( get_object_vars( $user ) );
//        $db -> execute();        

//        $db = new \Database\Database();
//        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'UPDATE', 'user')
//               -> addpart( 'SET', ['id'=>'?', 'name'=>'?', 'family'=>'?', 'address'=>'?'])
//               -> addpart( 'WHERE', ['id'=>'4'] );
//        $db -> Build( $Query );
//        $db -> param = [1, 'User', 'Group', 'Home'];
//        $db -> execute();        
        
//        $Query = $db -> Build()
//            -> addpart( 'SELECT', '*' )
//            -> addpart( 'FROM', ['account'] );
//        $db -> apply( $Query );
//        $subquery = "(".$db -> sql.")";
        
//        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'SELECT', $user )
//               -> addpart( 'FROM', 'user' )
//               -> addpart( 'WHERE', ['id'=>'2'] )
//               -> addpart( 'LIMIT', [10] );
//        $db -> Build( $Query );
//        $res = $db -> query();
//        var_dump($res);
        
        $Account = new \User\Account();
        $Account ->setUser($user);
        $Account -> Open();
        $Account -> Create( $Account );
        //\Repositoriy\Repositoriy::Instance()->Open(  );
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