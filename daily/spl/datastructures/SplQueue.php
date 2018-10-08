<?php

// SplQueue extends SplDoublyLinkedList implements Iterator , ArrayAccess , Countable {
    // /* 方法 */
    // __construct ( void )
    // mixed dequeue ( void )
    // void  enqueue ( mixed $value )
    // void  setIteratorMode ( int $mode )
    // /* 继承的方法 */
    // public void   SplDoublyLinkedList::add ( mixed $index , mixed $newval )
    // public mixed  SplDoublyLinkedList::bottom ( void )
    // public int    SplDoublyLinkedList::count ( void )
    // public mixed  SplDoublyLinkedList::current ( void )
    // public int    SplDoublyLinkedList::getIteratorMode ( void )
    // public bool   SplDoublyLinkedList::isEmpty ( void )
    // public mixed  SplDoublyLinkedList::key ( void )
    // public void   SplDoublyLinkedList::next ( void )
    // public bool   SplDoublyLinkedList::offsetExists ( mixed $index )
    // public mixed  SplDoublyLinkedList::offsetGet ( mixed $index )
    // public void   SplDoublyLinkedList::offsetSet ( mixed $index , mixed $newval )
    // public void   SplDoublyLinkedList::offsetUnset ( mixed $index )
    // public mixed  SplDoublyLinkedList::pop ( void )
    // public void   SplDoublyLinkedList::prev ( void )
    // public void   SplDoublyLinkedList::push ( mixed $value )
    // public void   SplDoublyLinkedList::rewind ( void )
    // public string SplDoublyLinkedList::serialize ( void )
    // public void   SplDoublyLinkedList::setIteratorMode ( int $mode )
    // public mixed  SplDoublyLinkedList::shift ( void )
    // public mixed  SplDoublyLinkedList::top ( void )
    // public void   SplDoublyLinkedList::unserialize ( string $serialized )
    // public void   SplDoublyLinkedList::unshift ( mixed $value )
    // public bool   SplDoublyLinkedList::valid ( void )
// }


// dequeue
$q = new SplQueue();
$q->setIteratorMode(splQueue::IT_MODE_DELETE);

$q->enqueue(["FooBar", "foo"]);
$q->enqueue(["FooBar", "bar"]);
$q->enqueue(["FooBar", "msg", "Hi there!"]);

print_r($q);

foreach ($q as $task) {
  if (count($task) > 2) {
    list($class, $method, $args) = $task;
    $class::$method($args);
  } else {
    list($class, $method) = $task;
    $class::$method();
  }
}