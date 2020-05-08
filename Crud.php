<?php
//we create
  interface Crud{
    //all these methods have to be implemented by any classs that implents these interfaces
    public function save();
    public function readAll();
    public function readUnique();
    public function search();
    public function update();
    public function removeOne();
    public function removeAll();

    // we added these methods for lab 2
    public function valiteForm();
    public function createFormErrorSessions();
  }
  ?>
  