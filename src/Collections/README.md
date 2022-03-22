# Collection (abstract data type)

In computer science, a **Collection** or container is a grouping of some variable number of data items
(possibly zero) that have some shared significance to the problem being solved and need to be operated
upon together in some controlled fashion. Generally, the data items will be of the same type or, in
languages supporting inheritance, derived from some common ancestor type. A **Collection** is a concept
applicable to abstract data types, and does not prescribe a specific implementation as a concrete data
structure, though often there is a conventional choice.

Examples of collections include lists, sets, multisets, trees and graphs.

Fixed-size arrays (or tables) are usually not considered a collection because they hold a fixed number
of data items, although they commonly play a role in the implementation of collections. Variable-size
arrays are generally considered collections.

More information about this ([here](https://en.wikipedia.org/wiki/Collection_(abstract_data_type)))

## Linear Collections

### Lists

In a **List**, the order of data items is significant. Duplicate data items are permitted. Examples of
operations on lists are searching for a data item in the list and determining its location (if it is present),
removing a data item from the list, adding a data item to the list at a specific location, etc. If the
principal operations on the list are to be the addition of data items at one end and the removal of data items
at the other, it will generally be called a queue or **FIFO**. If the principal operations are the addition and
removal of data items at just one end, it will be called a stack or **LIFO**. In both cases, data items are maintained
within the collection in the same order (unless they are removed and re-inserted somewhere else) and so these
are special cases of the list Collection. Other specialized operations on lists include sorting, where, again,
the order of data items is of great importance.

### Stacks

A **Stack** is a **LIFO** data structure with two principal operations:
- **push**, which adds an element to the "top" of the Collection.
- **pop**, which removes the top element.

### Queues

A **Queue** is a **LIFO** data structure with two principal operations:
- **push**, which adds an element to the "top" of the Collection.
- **pop**, which removes the first element in the Collection.

### Priority queues

In a **Priority Queue**, the tracks of the minimum or maximum data item in the collection are kept, according to
some ordering criterion, and the order of the other data items does not matter. One may think of a **Priority Queue**
as a list that always keeps the minimum or maximum at the head, while the remaining elements are kept in a _bag_.

## Associative Collections

### Store / Set

In a **Set**, the order of data items does not matter (or is undefined) but duplicate data items are not permitted.
Examples of operations on **Sets** are the addition and removal of data items and searching for a data item in the
**Set**.

Some languages support **Sets** directly. In others, **Sets** can be implemented by a hash table with dummy values;
only the keys are used in representing the **Set**.

### Multisets / Bag

In a **Multiset** (or _**Bag**_), like in a **Set**, the order of data items does not matter, but in this case
duplicate data items are permitted. Examples of operations on **Multisets** are the addition and removal of data items
and determining how many duplicates of a particular data item are present in the **Multiset**.

**Multisets** can be transformed into **Lists** by the action of sorting.

### Associative arrays / Map / Dictionary / Lookup Table / Hash

In an **Associative Array** (or **Map**, **Dictionary**, **Lookup table**), like in a **Dictionary**, a _lookup_ on
a key (like a word) provides a value (like a definition). The value might be a reference to a compound data structure.
A _Hash Table_ is usually an efficient implementation, and thus this data type is often known as a "_hash_".
