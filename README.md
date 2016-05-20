# packet



PHP 数据打包、解包工具.

### ＃composer

```json
{
    "require": {
        "fastd/packet": "~1.0"
    }
}
```

### ＃使用


```php
$data = Packet::encode($origin);
$origin = Packet::decode($data);
```

### ＃Testing

```
phpunit
```

# License MIT