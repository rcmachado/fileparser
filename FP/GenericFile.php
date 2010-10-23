<?php
abstract class FP_GenericFile implements Iterator {
    /**
     * @var SplFileObject
     */
    protected $fileObj;
    protected $options;

    public function __construct($filename, $options) {
        $this->fileObj = new SplFileObject($filename);
        $this->options = $options;
    }

    public function rewind() {
        $this->fileObj->rewind();
    }

    public function key() {
        return $this->fileObj->key();
    }

    public function current() {
        $line = $this->fileObj->current();
        return $this->parseLine($line);
    }

    public function next() {
        $this->fileObj->next();
    }

    public function valid() {
        return $this->fileObj->valid();
    }

    abstract protected function parseLine($line);
}
?>