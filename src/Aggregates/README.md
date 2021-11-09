# Aggregates

_Aggregates_ are not meant to be the same as _DDD's Root Aggregates_.

`Aggregates` are meant to **aggregate returned types** together, in order to **minimize** communication with the **Domain**.

As [Martin Fowler](https://martinfowler.com/) puts it, _**Aggregates are the basic element of transfer of data**
**storage - you request to load and save whole aggregates**_.

For more information please [read Martin Fowler's blog](https://martinfowler.com/bliki/DDD_Aggregate.html).

## When to use Aggregates

When communicating in the **Domain**, we might only need an _Entity_ or a _Collection_ returned, but in some other
cases, we might need that initial _Entity_, but also some other object (eg:. _Collection_).

In these cases, we would need to perform multiple calls to the **Domain**, and in some cases, we would need to hold
state in between calls.

**Aggregates** are objects that will encapsulate/aggregate several other objects that are meant to be **returned as a group**.
This way, we will only make one call to the **Domain**, and will only require the state to hold on that call's execution.

## How to structure an Aggregate

An **Aggregate** is a simple native object, that doesn't require to extend any base class, and should not contain any
_Business Logic_ inside.

It is a _Value Object_ whose main purposes are providing a _strong return type_, and a way to group other objects together.

The basic structure for an **Aggregate** comprises of a _construct_ with all the objects that we're trying to aggregate together,
and class attributes to hold them in state.

We should then provide *accessors* (`getters()`) for each attribute in the **Aggregate**
