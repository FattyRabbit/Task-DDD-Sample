<?php

namespace App\Traits;


/**
 * Class Property2GetterAndSetter
 * @package App\Traits
 */
class Property2GetterAndSetter
{
    /**
     * publicのプロパーティーのsetterを対応
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value){
        if ($this->existsProperty($key)) {
            $this->{$key} = $value;
        }
        throw new \BadMethodCallException('Method "'.$key.'" does not exist.');
    }

    /**
     * publicのプロパーティーのgetterを対応
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($this->existsProperty($key)) {
            return $this->{$key};
        }
        throw new \BadMethodCallException('Method "'.$key.'" does not exist.');
    }

    /**
     * publicのプロパーティーがあるかチェック
     * @param $propertyName
     * @return bool
     */
    private function existsProperty($propertyName): bool
    {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            if ($property->getName() === $propertyName) return true;
        }
        return false;
    }
}
