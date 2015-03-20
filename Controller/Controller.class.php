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
        User :: Instance() -> Account() -> Close();
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function Create()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Create() ) 
        {
            $tpl = $User -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output();
    }    
    
    private function Select()
    {
        if ( ($User = ( User :: Instance() -> Account( ( new User() ) -> Account() ) ) ) )
        {
            $User -> Open();
            $tpl = $User -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output(  );
    }
    
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
//        $user -> Fill( ['id'=>9, 'name'=>'User', 'family'=>'Group', 'address'=>'Home'] );
        
//        $db = new \Database\Database();
//        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'INSERT INTO', 'user')
//               -> addpart( 'FIELD', $user)
//               -> addpart( 'VALUES', ['?','?','?','?'] );
//        $db -> Build( $Query );      
//        $db -> param = array_values( get_object_vars( $user ) );
//        $db -> execute();        

//        $db = new \Database\Database();
//        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'UPDATE', 'user')
//               -> addpart( 'SET', ['id=?', 'name=?', 'family=?', 'address=?'])
//               -> addpart( 'WHERE', ['id=1'] );
//        $db -> Build( $Query );
//        $db -> param = [4, 'User', 'Group', 'Home'];
//        $db -> execute();        
        
//        $Query = $db -> Build()
//            -> addpart( 'SELECT', '*' )
//            -> addpart( 'FROM', ['account'] );
//        $db -> apply( $Query );
//        $subquery = "(".$db -> sql.")";
        
//        $Query = new \Database\QueryBuilder();
//        $Query -> addpart( 'SELECT', $user )
//               -> addpart( 'FROM', 'user' )
//               -> addpart( 'WHERE', ['id > 1', 'id < 10'] )
//               -> addpart( 'LIMIT', [10] );
//        $db -> Build( $Query );
//        $res = $db -> query();
//        var_dump($res);
        
        \Repositoriy\Repositoriy::Instance()->Open( $user );
        
        $Comments = new \Comments\Comments();
        $Comments -> AddMessage( ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true), 'text'=>'hello'] );
        $Comments -> MoveMessage();

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