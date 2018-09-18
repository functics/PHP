# PHP ARRAY NOTES

## 1.Numeric array

```php
$array = [];
$array[10] = 100;
$array[21] = 200;
$array[29] = 300;
$array[500] = 1000;
$array[1001] = 10000;
$array[71] = 1971;

foreach($array as $index => $value) {
    echo "Position " . $index . " holds the value " . $value . "\n";
}
```

**output:**

```php
Position 10 holds the value 100
Position 21 holds the value 200
Position 29 holds the value 300
Position 500 holds the value 1000
Position 1001 holds the value 10000
Position 71 holds the value 1971
```

**Couple of things to notice here:**
We are iterating the array the way we entered the data. There is no internal sorting of the indexes at all, though they are all numeric.
Another interesting fact is that the size of the array $array is only 6. It is not 1002 like C++, Java, or other languages where we need to predefine the size of the array before using it, and the max index can be n-1 where n is the size of the array.

实际上，跟关联数组一样，遍历时读取指针位置，不是按照key的大小来遍历的

## 2.Associative array

**NOTICE THIS:**

```php
$array      = [];
$array[0]   = 'test';
$array['0'] = 'test string';

echo $array[0]; // Output 'test string'
```

## Fixed size array

```php
$array = new splFixedArray(10); // 生成一个长度为10的索引数组, splFixedArray是基于sql类库的类
```

**NOTICE THIS**
If we want to access an index which is out of the range (here it is 10), it will throw an exception:
>PHP Fatal error:  Uncaught RuntimeException: Index invalid or out of range

And also can't use PHP array function because it is an `Object`;