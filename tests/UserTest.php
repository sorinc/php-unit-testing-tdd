<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;
    
    public function setUp() :void
    {
        $this->user = new \App\Models\User;
    }

    public function testThatWeCanGetTheFirstName()
    {
        $this->user->setFirstName('John');

        $this->assertEquals($this->user->getFirstName(), 'John');
    }

    public function testThatWeCanGetTheLastName()
    {
        $this->user->setLastName('Doe');

        $this->assertEquals($this->user->getLastName(), 'Doe');
    }

    public function testFullnameIsReturned()
    {
        $this->user->setFirstName('John');
        $this->user->setLastName('Doe');

        $this->assertEquals($this->user->getFullName(), 'John Doe');
    }

    public function testFirstAndLastameAreTrimmed()
    {
        $this->user->setFirstName(' John       ');
        $this->user->setLastName('    Doe');

        $this->assertEquals($this->user->getFirstName(), 'John');
        $this->assertEquals($this->user->getLastName(), 'Doe');
    }

    public function testEmailAddressCanBeSet()
    {
        $this->user->setEmail('john@doe.com');
        
        $this->assertEquals($this->user->getEmail(), 'john@doe.com');
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $this->user->setFirstName(' John       ');
        $this->user->setLastName('    Doe');
        $this->user->setEmail('john@doe.com');

        $emailVrbl = $this->user->getEmailVariables();
        
        $this->assertArrayHasKey('fullName', $emailVrbl);
        $this->assertArrayHasKey('email', $emailVrbl);

        $this->assertEquals($emailVrbl['fullName'], 'John Doe');
        $this->assertEquals($emailVrbl['email'], 'john@doe.com');
    }
}
