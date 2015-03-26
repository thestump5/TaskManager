<?php

namespace User;
/**
 * Description of Test_AccountTest
 * @author Максим
 */

require_once '/../Model/Project/Project.class.php';

require_once '/../Model/Repositoriy/Repositoriy.class.php';

require_once '/../Model/User/Role.class.php';

require_once '/../Model/User/Account.class.php';
require_once '/../Model/User/User.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    public $Rep;
    public $User; 
    
    function getRep()
    {
        $Rep = $this -> getMock('Repositoriy\Repositoriy');
                
        $Rep -> expects( $this -> any() )
             -> method( 'Open' )
             -> with( $this->anything() )
             -> will($this->returnValue(TRUE));

        $Rep -> expects( $this -> any() )
             -> method( 'Create' )
             -> with( $this->anything(), $this->anything() )
             -> will($this->returnValue(TRUE));

        $Rep -> expects( $this -> any() )
             -> method( 'Save' )
             -> with( $this->anything() )
             -> will($this->returnValue(TRUE));

        $Rep -> expects( $this -> any() )
             -> method( 'Close' )
             -> with( $this->anything() )
             -> will($this->returnValue(TRUE));

        
        $this -> Rep = $Rep;
    }
    
    function getUser()
    {
        $User = $this -> getMockBuilder('User\User') 
                      -> getMock();
                
        $User -> expects( $this -> any() )
             -> method( 'AcceptProjectPid' )
             -> with( $this->anything() )
             -> will($this->returnValue(TRUE));
        
        $this -> User = $User;
    }
    
    //TODO: refactoring this test
    function testCanOpenAccount()
    {
        $this -> getRep();
        $this -> getUser();

        $Account = new Account( $this -> Rep );
        $Account -> setUser( $this -> User );
        
        $this -> assertTrue( $Account -> Open() );
    }    

    function testAccountIsClose()
    {
        $this -> getRep();
        $Account = new Account( $this -> Rep );
        $this -> assertTrue( $Account -> Close() );
    }    

    function testAccountIsSave()
    {
        $this -> getRep();
        $this -> getUser();

        $Account = new Account( $this -> Rep );
        $Account -> setUser( $this -> User );

        $Account -> Open();
        $this -> assertTrue( $Account -> Save() );
    }    

    function testAccountIsCreate()
    {
        $this -> getRep();

        $Account = new Account( $this -> Rep );

        $std = new \stdClass();
        $std -> id = 100;
        $std -> pw = 'pw';
        $std -> attribute = 'attr';

        $this -> assertTrue( $Account -> Create( $Account, "", $std ) );
    }    
    
    function testCanCheckEqualseAccountUser()
    {
        $this -> getRep();

        $Account = new Account( $this -> Rep );

        $this -> assertInternalType( 'bool', $Account -> Check() );
    }
    
    function testCanReturnTemplate()
    {
        $this -> getRep();

        $Account = new Account( $this -> Rep );

        $Account -> SetTemplate( "Template" );
        $this -> assertNotEmpty( $Account -> GetTemplate() );
    }

    function testCanSetTemplate()
    {
        $this -> getRep();

        $Account = new Account( $this -> Rep );

        $this -> assertNotEmpty( $Account -> SetTemplate( "Template" ) );
    }
}