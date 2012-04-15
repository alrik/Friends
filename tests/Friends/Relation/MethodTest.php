<?php

class Friends_Relation_MethodTest
    extends PHPUnit_Framework_TestCase
{
    const TEST_CLASS = 'Friends_Relation_MethodTest_Test';
    const TEST_METHOD = 'test';

    private $_object;

    public function setUp()
    {
        $this->_object = new Friends_Relation_Method(
            self::TEST_CLASS, self::TEST_METHOD
        );
    }

    /**
     * @covers Friends_Relation_Method::__construct
     * @covers Friends_Relation_Method::getClass
     * @covers Friends_Relation_Method::getMethod
     */
    public function testConatinerFunctionality()
    {
        $containerClass = $this->_object->getClass();
        $containerMethod = $this->_object->getMethod();

        $this->assertEquals(
            self::TEST_CLASS, $containerClass,
            'returns class'
        );
        $this->assertEquals(
            self::TEST_METHOD, $containerMethod,
            'returns method'
        );
    }

    /**
     * @covers Friends_Relation_Method::__construct
     * @expectedException InvalidArgumentException
     */
    public function testConstructThrowsExceptionOnInvalidClass()
    {
        new Friends_Relation_Method(
            'NotExistingClass', '__construct'
        );
    }

    /**
     * @covers Friends_Relation_Method::__construct
     * @expectedException InvalidArgumentException
     */
    public function testConstructThrowsExceptionOnInvalidMethod()
    {
        new Friends_Relation_Method(
            'stdClass', 'notExistingMethod'
        );
    }

    /**
     * @covers Friends_Relation_Method
     * @covers Friends_Relation_AbstractRelation
     */
    public function testGetFriends()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers Friends_Relation_Method::isFriend
     */
    public function testIsFriendWithFriends()
    {
        $functionFriend = $this->_object->isFriend(
            new Friends_Friend_Function('test')
        );
        $classFriend = $this->_object->isFriend(
            new Friends_Friend_Class('Test')
        );
        $methodFriend = $this->_object->isFriend(
            new Friends_Friend_Method('Test', 'test')
        );

        $this->assertTrue(
            $functionFriend,
            'relation has function friend'
        );
        $this->assertTrue(
            $classFriend,
            'relation has class friend'
        );
        $this->assertTrue(
            $methodFriend,
            'relation has method friend'
        );
    }

    /**
     * @covers Friends_Relation_Method::isFriend
     */
    public function testIsFriendWithStrangers()
    {
        $functionFriend = $this->_object->isFriend(
            new Friends_Friend_Function('strager')
        );
        $classFriend = $this->_object->isFriend(
            new Friends_Friend_Class('Stranger')
        );
        $methodFriend = $this->_object->isFriend(
            new Friends_Friend_Method('Stranger', 'strager')
        );

        $this->assertFalse(
            $functionFriend,
            'relation has not stranger as function friend'
        );
        $this->assertFalse(
            $classFriend,
            'relation has not stranger as class friend'
        );
        $this->assertFalse(
            $methodFriend,
            'relation has not stranger as method friend'
        );
    }
}