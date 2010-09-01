<?php

class Hash {
	private $timestamp;
	private $data;

	public static function getByHash($v) {
		list($timestamp, $data, $hash) = explode("*", $v);
		return new Hash(base64_decode($data), $timestamp, $hash);
	}

	public function __construct($data, $timestamp = null, $hash = null) {
		$this->timestamp = ($timestamp !== null ? $timestamp : time());
		$this->data = $data;
		$this->hash = ($hash !== null ? $hash : $this->getHash());
	}

	public function getHash() {
		global $config;
		return hash($config["misc"]["hash"], $config["misc"]["secret"] . " " . $this->timestamp . " " . $this->data);
	}
	
	public function getData() {
		return $this->data;
	}

	public function __toString() {
		return $this->timestamp . "*" . base64_encode($this->data) . "*" . $this->hash;
	}

	public function isValid($timeout) {
		return (time() <= $this->timestamp + $timeout) && ($this->getHash() == $this->hash);
	}
}
