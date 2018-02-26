# PSR-2: Coding Style Guide （编码风格向导）
---

[官网地址](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md#coding-style-guide)

This guide extends and expands on PSR-1, the basic coding standard.

The intent of this guide is to reduce cognitive(adj. 认识的，认知的) friction(n. 摩擦) when scanning code from different authors. It does so by enumerating(v. 枚举) a shared set of rules and expectations about how to format PHP code.

The style rules herein(n. in this document or book.) are derived(v. 派生，来源) from commonalities among the various member projects. When various authors collaborate across multiple projects, it helps to have one set of guidelines to be used among all those projects. Thus, the benefit of this guide is not in the rules themselves, but in the sharing of those rules.

这里的风格规则来源于各个成员项目之间的共同点。 当不同的作者在多个项目中合作时，有助于在所有这些项目中使用一套准则。 因此，本指南的好处不在于规则本身，而在于分享这些规则。

The key words “MUST”, “MUST NOT”, “REQUIRED”, “SHALL”, “SHALL NOT”, “SHOULD”, “SHOULD NOT”, “RECOMMENDED”, “MAY”, and “OPTIONAL” in this document are to be interpreted as described in RFC 2119.

### 1. Overview

- Code MUST follow a "coding style guide" PSR [PSR-1](http://www.php-fig.org/psr/psr-1/).
- Code MUST use 4 spaces for indenting, not tabs.
- There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.
- There MUST be one blank line after the namespace declaration, and there MUST be one blank line after the block of use declarations.
- Opening braces(括弧) for classes MUST go on the next line, and closing braces MUST go on the next line after the body.
- Opening braces for methods MUST go on the next line, and closing braces MUST go on the next line after the body.
- Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.
- Control structure keywords MUST have one space after them; method and function calls MUST NOT.
- Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.
- Opening parentheses(括号) for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.

##### 1.1 Example

This example encompasses some of the rules below as a quick overview:

```php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    public function sampleMethod($a, $b = null)
    {
        if ($a === $b) {
            bar();
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }
    }

    final public static function bar()
    {
        // method body
    }
}
```
