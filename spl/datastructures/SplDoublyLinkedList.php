<?php

/**
 *  Class synopsis
 *  The SplDoublyLinkedList class provides the main functionalities of a doubly linked list.
 */
// class ClassName implements Iterator, ArrayAccess, Countable
// {
//     /** Methods **/
//     public        __construct ( void )                           // Constructs a new doubly linked list
//     public void   add ( mixed $index, mixed $newval )            // Add/insert a new value at the specified index
//     public mixed  bottom ( void )                                // Peeks at the node from the beginning of the doubly linked list
//     public int    count ( void )                                 // Counts the number of elements in the doubly linked list
//     public mixed  current ( void )                               // Return current array entry
//     public int    getIteratorMode ( void )                       // Returns the mode of iteration
//     public bool   isEmpty ( void )                               // Checks whether the doubly linked list is empty
//     public mixed  key ( void )                                   // Return current node index
//     public void   next ( void )                                  // Move to next entry
//     public bool   offsetExists ( mixed $index )                  // Returns whether the requested $index exists
//     public mixed  offsetGet( mixed $index )                      // Returns the value at the specified $index
//     public void   offsetSet ( mixed $index , mixed $newval )     // Sets the value at the specified $index to $newval
//     public void   offsetUnset ( mixed $index )                   // Unsets the value at the specified $index
//     public mixed  pop ( void )                                   // Pops a node from the end of the doubly linked list
//     public void   prev ( void )                                  // Move to previous entry
//     public void   push ( mixed $value )                          // Pushes an element at the end of the doubly linked list
//     public void   rewind ( void )                                // Rewind iterator back to the start
//     public string serialize ( void )                             // Serializes the storage
//     public void   setIteratorMode ( int $mode )                  // Sets the mode of iteration
//     public mixed  shift ( void )                                 // Shifts a node from the beginning of the doubly linked list
//     public mixed  top ( void )                                   // Peeks at the node from the end of the doubly linked list
//     public void   unserialize ( string $serialized )             // Unserializes the storage
//     public void   unshift ( mixed $value )                       // Prepends the doubly linked list with an element
//     public bool   valid ( void )                                 // Check whether the doubly linked list contains more nodes
// }

$splDll = new splDoublyLinkedList();

# add
$splDll->add(0, 'first time to write splDoublyLinkedList');

$splDll->add(1, 'just for the test 1');

$splDll->add(2, 'just for the test 2');

// $splDll->add(-1, 'just for the test');                           // wrong

# bottom
print_r($splDll->bottom());                                         // first time to write splDoublyLinkedList

# count
print_r($splDll->count());                                          // 2

# isEmpty
var_dump($splDll->isEmpty());                                       // false

# key ------> for the Iterator
print_r($splDll->key());

# offsetExists
var_dump($splDll->offsetExists(0));

# offsetGet
print_r($splDll->offsetGet(2));

# offsetSet
// $splDll->offsetSet(3, 'we don\'t talk anymore');                 // wrong -------> out of range
$splDll->offsetSet(2, 'we don\'t talk anymore');                    // we don't talk anymore
print_r($splDll->offsetGet(2));

# offsetUnset
$splDll->add(3, 'oh it such a shame');
print_r($splDll->offsetGet(3));
$splDll->offsetUnset(3);
// print_r($splDll->offsetGet(3));                                   // Offset invalid or out of range

# pop
$splDll->add(3, 'test for function pop');
print_r($splDll);
$splDll->pop();
print_r($splDll);

# push
$splDll->push('why life is so hard for me');
print_r($splDll);

# shift
$splDll->shift();
print_r($splDll);

# top
print_r($splDll->top());

# serialize
$serialize = $splDll->serialize();
print_r($serialize);                                      // i:0;:s:39:"first time to write splDoublyLinkedList";:s:19:"just for the test 1";:s:21:"we don't talk anymore";:s:26:"why life is so hard for me";

# unserialize
print_r($splDll->unserialize($serialize));

# unshift
print_r($splDll->unshift('test unshift'));

echo PHP_EOL;
###################################################Iterator################################################################

# setIteratorMode

// There are two orthogonal sets of modes that can be set:

// The direction of the iteration (either one or the other):
// SplDoublyLinkedList::IT_MODE_LIFO (Stack style)
// SplDoublyLinkedList::IT_MODE_FIFO (Queue style)
// The behavior of the iterator (either one or the other):
// SplDoublyLinkedList::IT_MODE_DELETE (Elements are deleted by the iterator)
// SplDoublyLinkedList::IT_MODE_KEEP (Elements are traversed by the iterator)
// The default mode is: SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP


# getIteratorMode         ---------> can not understand
# IT_MODE_LIFO   => int(2)
# IT_MODE_FIFO   => int(0)
# IT_MODE_DELETE => int(1)
# IT_MODE_KEEP   => int(0)
print_r($splDll->getIteratorMode());                                //


# current
print_r($splDll->current());

print_r($splDll);

# prev
print_r($splDll->prev());

# rewind ------> for the Iterator

# valid
var_dump($splDll->valid());
echo PHP_EOL;
