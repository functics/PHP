<?php

// SplStack extends SplDoublyLinkedList implements Iterator , ArrayAccess , Countable {
//     /* 方法 */
//     __construct ( void )
//     void setIteratorMode ( int $mode )
//     /* 继承的方法 */
//     public void   SplDoublyLinkedList::add ( mixed $index , mixed $newval )
//     public mixed  SplDoublyLinkedList::bottom ( void )
//     public int    SplDoublyLinkedList::count ( void )
//     public mixed  SplDoublyLinkedList::current ( void )
//     public int    SplDoublyLinkedList::getIteratorMode ( void )
//     public bool   SplDoublyLinkedList::isEmpty ( void )
//     public mixed  SplDoublyLinkedList::key ( void )
//     public void   SplDoublyLinkedList::next ( void )
//     public bool   SplDoublyLinkedList::offsetExists ( mixed $index )
//     public mixed  SplDoublyLinkedList::offsetGet ( mixed $index )
//     public void   SplDoublyLinkedList::offsetSet ( mixed $index , mixed $newval )
//     public void   SplDoublyLinkedList::offsetUnset ( mixed $index )
//     public mixed  SplDoublyLinkedList::pop ( void )
//     public void   SplDoublyLinkedList::prev ( void )
//     public void   SplDoublyLinkedList::push ( mixed $value )
//     public void   SplDoublyLinkedList::rewind ( void )
//     public string SplDoublyLinkedList::serialize ( void )
//     public void   SplDoublyLinkedList::setIteratorMode ( int $mode )
//     public mixed  SplDoublyLinkedList::shift ( void )
//     public mixed  SplDoublyLinkedList::top ( void )
//     public void   SplDoublyLinkedList::unserialize ( string $serialized )
//     public void   SplDoublyLinkedList::unshift ( mixed $value )
//     public bool   SplDoublyLinkedList::valid ( void )
// }


// 同双链表 重写 setIteratorMode 方法
# setIteratorMode  Sets the mode of iteration

// mode
// There is only one iteration parameter you can modify.

// The behavior of the iterator (either one or the other):
// SplDoublyLinkedList::IT_MODE_DELETE (Elements are deleted by the iterator)
// SplDoublyLinkedList::IT_MODE_KEEP (Elements are traversed by the iterator)
// The default mode is 0x2 : SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_KEEP
