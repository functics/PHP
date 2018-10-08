# 变量

## 不使用第三个变量交换两个变量值

### 1. 异或运算(^)

```php
$a = 3;
$b = 4;

$a = $a ^ $b;
$b = $a ^ $b;
$a = $a ^ $b;

echo $a, PHP_EOL, $b; // 4 3
```

### 2. list函数

```php
$a = 3;
$b = 4;

list($a, $b) = [$b, $a];

echo $a, PHP_EOL, $b; // 4, 3
```