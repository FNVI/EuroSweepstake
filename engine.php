<?php

class Sweepstakes implements Iterator{
    
    private $people = [];
    private $options = [];
    private $distribution;
    private $counter = 0;
    
    public function __construct($options = [], $people = []) {
        $this->people = $people;
        $this->options = $options;
        $this->distribution = floor(count($options)/count($people));
    }
    
    public function __toString() {
        return json_encode($this->run(),128);
    }

    public function current() {
        shuffle($this->options);
        return array_splice($this->options, rand(0,count($options)), $this->distribution);
    }

    public function key() {
        return $this->people[$this->counter];
    }

    public function next() {
        $this->counter++;
    }

    public function rewind() {
        $this->counter = 0;
    }

    public function valid() {
        return $this->counter < count($this->people);
    }
    
    public function remaining(){
        if(count($this->options)){
            return $this->options;
        }
        return null;
    }
}