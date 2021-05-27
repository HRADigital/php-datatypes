# Associative Collections

## Store / Set

In a **Set**, the order of data items does not matter (or is undefined) but duplicate data items are not permitted.
Examples of operations on **Sets** are the addition and removal of data items and searching for a data item in the
**Set**.

Some languages support **Sets** directly. In others, **Sets** can be implemented by a hash table with dummy values;
only the keys are used in representing the **Set**.

## Multisets / Bag

In a **Multiset** (or _**Bag**_), like in a **Set**, the order of data items does not matter, but in this case
duplicate data items are permitted. Examples of operations on **Multisets** are the addition and removal of data items
and determining how many duplicates of a particular data item are present in the **Multiset**.

**Multisets** can be transformed into **Lists** by the action of sorting.

## Associative arrays / Map / Dictionary / Lookup Table / Hash

In an **Associative Array** (or **Map**, **Dictionary**, **Lookup table**), like in a **Dictionary**, a _lookup_ on
a key (like a word) provides a value (like a definition). The value might be a reference to a compound data structure.
A _Hash Table_ is usually an efficient implementation, and thus this data type is often known as a "_hash_".
