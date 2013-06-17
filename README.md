[![Build Status](https://secure.travis-ci.org/fordnox/domain-parser.png?branch=master)](http://travis-ci.org/fordnox/domain-parser)


Domain Parser
=============

Parse Top level and second level domain string from URL or string

Code Example
=============

        $parser = new Fordnox\DomainParser('example-domain.co.uk');
        print $parser->getSld(); // prints example-domain
        print $parser->getTld(); // prints co.uk