<?php
namespace models;
interface IForm
{
    public function render();
}

interface IControl
{
    public function render();
    public function getValue();
    public function getName();
    public function getTitle();
}

abstract class VControl implements IControl
{
    private $name;
    private $type;
    private $title;

    static function getClass($type)
    {
        if ($type === 'text') {
            return "TextField";
        }
        if ($type === 'select') {
            return "SelectBox";
        }
        if ($type === 'check') {
            return "CheckBox";
        }
    }

    function __construct($type, $title)
    {
        $this->name = $title;
        $this->title = $title;
        $this->type = $type;
    }
    function getValue()
    {
        return $this->type;
    }
    function getName()
    {
        return $this->name;
    }
    function getTitle()
    {
        return $this->title;
    }
    abstract function render();
}

class TextField extends VControl
{
    public function render()
    {
        return  "<div><label>".$this->getTitle()."<input style='display: flex;' type='text' name='". $this->getName()."'/></label></div>";
    }
}

class CheckBox extends VControl
{
    public function render()
    {
        return  "<div><label><input style='display: flex;' type='checkbox' name='" . $this->getName() . "'/>".$this->getTitle()."</label></div>";
    }
}

class SelectBox extends VControl
{
    public function render()
    {
        return  "<select style='display: flex;' name='" . $this->getName() . "'> <option>Пункт 1</option>
        <option>Пункт 2</option></select>";
    }
}



abstract class VForm implements IForm
{
    private $fields;
    function __construct($scheme)
    {
        $this->fields = $scheme;
    }
    abstract public function render();
}

interface ISchemeAdapter
{
    public function adaptee($scheme);
}

class SimpleSchemeAdapter implements ISchemeAdapter
{
    private function getClass($type)
    {
        if ($type === 'text') {
            return "TextField";
        }
        if ($type === 'select') {
            return "SelectBox";
        }
        if ($type === 'box') {
            return "CheckBox";
        }
    }
    public function adaptee($scheme)
    {
        $list = [];
        foreach ($scheme as $key => $control) {
            foreach ($control as $attr => $value) {
                $input = $this->getClass($attr);
                $list[] = new $input();
            }
        }
    }
}

class Form extends VForm
{
    private $fields;
    static function getSchemeAdapter()
    {
        return new SimpleSchemeAdapter();
    }
    public function render()
    {
        foreach ($this->fields as $key => $control) {
            echo "$key).$control->render().<br/>";
        }
    }
}

interface IStore
{
    static function get($uid);
    static function set($key, $value);
}

class Store implements IStore
{
    static function get($uid)
    {
        $records = \R::find('forms', ' hash = ? ', array($uid));
        return (!empty($records)) ? array_map(function ($el) {
            return $el->scheme;
        }, $records) : [];
        
    }
    static function set($key, $value)
    {
            $record = \R::dispense('forms');
            $record->hash = $key;
            $record->scheme = $value;
            \R::store($record);
        
    }
    static function remove()
    {
        \R::wipe('forms');
    }
}
