# volt/scanner

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


It is just an educational test project. 
It is a slightly modified example from Josh Lockhart's book __"Modern PHP" by O'Reilly (2015)__.

For original code see [a related GitHub page](https://github.com/modern-php/scanner).
You may as well look througgh [a forked version] (https://github.com/frankperez87/scanner/blob/master/src/Url/Scanner.php) for some code modifications.

This component uses PSR-4 autoload and utilizes ```Oreilly\ModernPhp\``` namespace. 
For class identification use ```\Oreilly\ModernPhp\Url\Scanner``` class name.

## Install

Via Composer

``` bash 
$ composer require volt/scanner
``` 

## Usage

****
```php
    // an array of test links
    $a_urls = array(
        'http://www.pravda.com.ua',
        'http://www.xpravda.ua',
        'http://php.net/manual/ru/wrappers.php.php',
        'http://uberhumor.com/',
        'https://github.com/frankperez87/scanner/blob/master/src/Url/Scanner.php',
        'https://www.google.com.ua/maps/'
    );
    
    $o_scanner = new \Oreilly\ModernPhp\Url\Scanner($a_urls); // instantiate the component class
    $a_invalid_urls_arrays = $o_scanner->getInvalidUrls(); // get an array with resutls of scan 
    
    $c_html_url_result = null;
    if (empty($a_invalid_urls_arrays)) {
        $c_html_url_result = "<h2>All provided URLs are valid</h2>";
    
    } else {
        $c_html_lis = null;
        
        foreach((array)$a_invalid_urls_arrays as $a_url_data){
            
            $c_url = array_key_exists('url', $a_url_data)? $a_url_data['url'] : 'N/A';
            $n_status_code = array_key_exists('status_code', $a_url_data)? 
                $a_url_data['status_code'] : 'N/A';
            
            $c_html_url = htmlspecialchars($c_url, ENT_QUOTES);
            $c_html_lis .= "<li><span>{$c_html_url}</span> Status message: <code>{$n_status_code}</code></li>";        
        }//endforeach
    
        $c_html_url_result = "<h2>The following URLs are invalid:</h2>"
            . "<ul>" . $c_html_lis . "</ul>";
    }//endif
    
    echo $c_html_url_result;
```
****

## Change log

Don't bother looking at [CHANGELOG](CHANGELOG.md) for no additional information on changes is planned to be added.

## Testing

``` bash
 $ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

Bare in mind, this is just a test project. If you discover any security related issues, please ignore them. You may as well use the issue tracker.

## Credits

- [Volodymyr Telnov][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/volt/scanner.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/volt/scanner/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/volt/scanner.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/volt/scanner.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/volt/scanner.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/volt/scanner
[link-travis]: https://travis-ci.org/volt/scanner
[link-scrutinizer]: https://scrutinizer-ci.com/g/volt/scanner/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/volt/scanner
[link-downloads]: https://packagist.org/packages/volt/scanner
[link-author]: https://github.com/voltel
[link-contributors]: ../../contributors
