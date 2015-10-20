<?php

class DomainParserTest extends PHPUnit_Framework_TestCase
{
    public static function provider()
    {
        return array(
            array('domain.com', 'domain', 'com'),
            array('domain.co.uk', 'domain', 'co.uk'),
            array('skype://domain.com', 'domain', 'com'),
            array('ftp://domain.com', 'domain', 'com'),
            array('http://example.co/', 'example', 'co'),
            array('http://bbc.co.uk/', 'bbc', 'co.uk'),
            array('http://github.com/bootstrap/',  'github', 'com'),
            array('https://www.google.com.br', 'google', 'com.br'),
            array('https://www.net.in', 'net', 'in'),
        );
    }

    /**
     * @dataProvider provider
     */
    public function testPage($string, $expected1, $expected2)
    {
        $parser = new Fordnox\DomainParser($string);
        $this->assertEquals($expected1, $parser->getSld());
        $this->assertEquals($expected2, $parser->getTld());
    }

    public function testTuple()
    {
        $parser = new Fordnox\DomainParser('example-domain.com');
        $this->assertEquals(array('example-domain', 'com'), $parser->getSldTld());
    }

    /**
     * @expectedException Exception
     */
    public function testNullException()
    {
        $parser = new Fordnox\DomainParser(null);
        $parser->getSldTld();
    }

    /**
     * @expectedException Exception
     */
    public function testEmptyException()
    {
        $parser = new Fordnox\DomainParser('');
        $parser->getSldTld();
    }

    /**
     * @expectedException Exception
     */
    public function testException()
    {
        $parser = new Fordnox\DomainParser('domaincom');
        $parser->getSldTld();
    }

}
