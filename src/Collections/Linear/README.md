# Linear Collections

## Lists

In a **List**, the order of data items is significant. Duplicate data items are permitted. Examples of
operations on lists are searching for a data item in the list and determining its location (if it is present),
removing a data item from the list, adding a data item to the list at a specific location, etc. If the
principal operations on the list are to be the addition of data items at one end and the removal of data items
at the other, it will generally be called a queue or **FIFO**. If the principal operations are the addition and
removal of data items at just one end, it will be called a stack or **LIFO**. In both cases, data items are maintained
within the collection in the same order (unless they are removed and re-inserted somewhere else) and so these
are special cases of the list Collection. Other specialized operations on lists include sorting, where, again,
the order of data items is of great importance.

## Stacks

A **Stack** is a **LIFO** data structure with two principal operations:
- **push**, which adds an element to the "top" of the Collection.
- **pop**, which removes the top element.

## Queues

A **Queue** is a **LIFO** data structure with two principal operations:
- **push**, which adds an element to the "top" of the Collection.
- **pop**, which removes the first element in the Collection.

## Priority queues

In a **Priority Queue**, the tracks of the minimum or maximum data item in the collection are kept, according to
some ordering criterion, and the order of the other data items does not matter. One may think of a **Priority Queue**
as a list that always keeps the minimum or maximum at the head, while the remaining elements are kept in a _bag_.
