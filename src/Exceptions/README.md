# Domain Exception's namespace

Domain Exceptions are predefined Exceptions that can/should be raised from within the product.

All Domain Exception's error codes, should map directly to a valid HTTP Status code, in order to facilitate contextualization and response types.

```php
try {
    // ... raised any type of domain exception.
} catch (AbstractBaseException $e) {
    return \response()->json(['error' => $e->getMessage()], $e->getCode());
}
```

All Domain Exception's also extend `AbstractBaseException` class, and therefore, the application layer can easily identify a Domain raised exception from another one.

```php
try {
    // ... raised a domain exception
} catch (AbstractBaseException $e) {
    // ... have some behavior.
} catch (\Throwable $e) {
    // ... have some OTHER behavior.
}
```

By creating and using Domain Exceptions, the application not only pinpoints what type of error occured, but also reduces the number of exceptions raised, while abstracting from any 3rd party dependency.

If in a given context, a User record is required but not found, an `UserNotFoundException` can be raised, independently of the persistence layer's type (_DB, REST API, ..._).
This Exception, will already have a predefined eror message and code, that can be used in the application layer, either for an API response, or just for logging.
