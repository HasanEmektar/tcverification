# TC Verification
Laravel package for Turkish ID number validation

#INSTALL

Edit your composer
```
"require": {
        "hasanemektar/tcverification": "dev-master"
    },

```
Run command on your terminal

```
composer update
```

After installation complete edit your config/app.php

```
'providers' => [
        ...
        \HasanEmektar\tc\TCverificationProvider::class,
    ],
    
    'aliases' => [
        ...
        'tcverification' => \HasanEmektar\tc\TCverification::class,
    ],
```

#USAGE

On your controller
```
use HasanEmektar\tc\TCverification;

$request = new TCverification('TC_NUMBER','NAME','SURNAME','YEAR_of_BIRTH');
$result = $request->verify();

if($result == null)
{
    return 'Validation fail';
}
else if($result == true)
{
    return 'User is real';
}
else if($result == false)
{
    return 'User is not real';
}
```

Enjoy!


