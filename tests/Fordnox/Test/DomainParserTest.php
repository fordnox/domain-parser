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

}